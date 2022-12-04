<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\City;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Auth;
use Session;

class FrontendController extends Controller
{
    public function tour() {
        return view('frontend.tour');
    }

    public function tourShow($slug) {
        $tour = Package::whereSlug($slug)->first();
        return view('frontend.tour-details', compact('tour'));
    }

    public function search(Request $request) {
        $search = $request->search;
        $tours = [];
        if ($search) {
            $tours = Package::whereStatus(1)
                    ->where('name', 'like', '%' . request('search') . '%')
                    ->orWhereHas('city', function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('country', function($q1) {
                            $q1->where('name', 'like', '%' . request('search') . '%')
                               ->whereStatus(1);
                        });
                    })->get();
        }
        return view('frontend.tour-search', compact('tours','search'));
    }

    public function newsletter(Request $req) {
        $req->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($req->all());
        return redirect(url()->previous().'#newsletter');
    }

    public function searchCity($id) {
        $city = City::findOrFail($id);
        $search = $city->name??'';
        $tours = [];

        if ($search) {
            $tours = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('city', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhereHas('country', function($q1) use ($search) {
                            $q1->where('name', 'like', '%' . $search . '%')
                               ->whereStatus(1);
                        });
                    })->get();
        }
        return view('frontend.tour-search', compact('tours','search'));
    }

    public function searchCategory($id){
        $category = Category::findOrFail($id);
        $search = $category->name??'';
        $tours = [];

        if ($search) {
            $tours = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->get();
        }
        return view('frontend.tour-search', compact('tours','search'));
    }

    public function searchActivity($id){
        $activity = Activity::findOrFail($id);
        $search = $activity->name??'';
        $tours = [];

        if ($search) {
            $tours = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('activity', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->get();
        }
        return view('frontend.tour-search', compact('tours','search'));
    }

    public function cart()
    {
        if (Auth::user()) {
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
        } else {
            $cartItems = Cart::whereUserId(session()->getId())->get();
        }
        $cartAmount = Cart::cartAmount();
        return view('frontend.cart', compact('cartItems','cartAmount'));
    }

    public function cartEdit($id){
        $cart = Cart::findOrFail($id);
        $tour = Package::findOrFail($cart->package_id);
        return view('frontend.cart-edit', compact('cart','tour'));
    }

    public function cartUpdate(Request $request, $id){
        $request->validate([
            'date' => 'required|date|after:today'
        ]);

        if (array_sum($request->qtyInput) > 0){
            $data['date'] = $request->date;
            $data['qty_adult'] = $request->qtyInput[0];
            $data['qty_child'] = $request->qtyInput[1];
            $data['qty_infant'] = $request->qtyInput[2];

            Cart::whereId($id)->update($data);
            return redirect()->route('cart')->with('success','Cart item updated successfully.');
        } else {
            return redirect()->back()->with('error','Please select atleast one seat.');
        }
    }

    public function cartAdd(Request $request, $id) {
        $request->validate([
            'date' => 'required|date|after:today'
        ]);

        if (array_sum($request->qtyInput) > 0){
            if (Auth::user()) {
                $cartCount = Cart::whereUserId(Auth::user()->id)->wherePackageId($id)->count();

                if ($cartCount == 0) {
                    $data['user_id'] = Auth::user()->id;
                    $data['package_id'] = $id;
                    $data['date'] = $request->date;
                    $data['qty_adult'] = $request->qtyInput[0];
                    $data['qty_child'] = $request->qtyInput[1];
                    $data['qty_infant'] = $request->qtyInput[2];

                    Cart::create($data);
                    return redirect()->route('cart')->with('success','Tour added to cart successfully.');
                } else {
                    return redirect()->back()->with('error','Already added to cart.');
                }
            } else {
                $cartCount = Cart::whereUserId(session()->getId())->wherePackageId($id)->count();
                if ($cartCount == 0) {
                    $data['user_id'] = session()->getId();
                    $data['package_id'] = $id;
                    $data['date'] = $request->date;
                    $data['qty_adult'] = $request->qtyInput[0];
                    $data['qty_child'] = $request->qtyInput[1];
                    $data['qty_infant'] = $request->qtyInput[2];

                    Cart::create($data);
                    return redirect()->route('cart')->with('success','Tour added to cart successfully.');
                } else {
                    return redirect()->back()->with('error','Already added to cart.');
                }
            }
        } else {
            return redirect()->back()->with('error','Please select atleast one seat.');
        }
    }

    public function cartRemove($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('cart')->with('success','Removed from cart successfully.');
    }

    public function checkout() {
        $cartAmount = Cart::cartAmount();
        if ($cartAmount == 0) {
            return redirect()->route('cart')->with('failure','Add tour to cart first.');
        }
        return view('frontend.checkout', compact('cartAmount'));
    }

    public function payment(Request $request) {
        $request->validate([
            'country' => 'nullable|string|min:3',
            'city' => 'nullable|string|min:3',
            'pincode' => 'nullable|string',
            'address' => 'nullable|string|min:3'
        ]);

        if (Auth::user()) {
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
            if ($request->radio_address) {
                $orderData['user_id'] = Auth::user()->id;
                $orderData['user_address_id'] = $request->radio_address;
                $orderData['total_amount'] = Cart::cartAmount();
                $orderData['tax'] = $request->tax;
                $orderData['order_status'] = 'In Progress';
                $order = Order::create($orderData);

                foreach ($cartItems as $key => $item) {
                    $orderItemData['order_id'] = $order->id;
                    $orderItemData['package_id'] = $item->package_id;
                    $orderItemData['adult_qty'] = $item->qty_adult;
                    $orderItemData['child_qty'] = $item->qty_child;
                    $orderItemData['infant_qty'] = $item->qty_infant;
                    $orderItemData['total_price'] = Cart::itemPrice($item);
                    $orderItem = OrderItem::create($orderItemData);
                }
            } else {
                $request->validate([
                    'country' => 'required|string|min:3',
                    'city' => 'required|string|min:3',
                    'pincode' => 'required|string',
                    'address' => 'required|string|min:3'
                ]);

                $addressData['user_id'] = Auth::user()->id;
                $addressData['default'] = 0;
                $addressData['country'] = $request->country;
                $addressData['city'] = $request->city;
                $addressData['pincode'] = $request->pincode;
                $addressData['address'] = $request->address;
                $userAddress = UserAddress::create($addressData);

                $orderData['user_id'] = Auth::user()->id;
                $orderData['user_address_id'] = $userAddress->id;
                $orderData['total_amount'] = Cart::cartAmount();
                $orderData['tax'] = $request->tax;
                $orderData['order_status'] = 'In Progress';
                $order = Order::create($orderData);

                foreach ($cartItems as $key => $item) {
                    $orderItemData['order_id'] = $order->id;
                    $orderItemData['package_id'] = $item->package_id;
                    $orderItemData['adult_qty'] = $item->qty_adult;
                    $orderItemData['child_qty'] = $item->qty_child;
                    $orderItemData['infant_qty'] = $item->qty_infant;
                    $orderItemData['total_price'] = Cart::itemPrice($item);
                    $orderItem = OrderItem::create($orderItemData);
                }
            }
            $email = Auth::user()->email;
        } else {
            $request->validate([
                'country' => 'required|string|min:3',
                'city' => 'required|string|min:3',
                'pincode' => 'required|string',
                'address' => 'required|string|min:3'
            ]);

            $cartItems = Cart::whereUserId(session()->getId())->get();
            $orderData['user_id'] = session()->getId();
            $orderData['user_address_id'] = null;
            $orderData['total_amount'] = Cart::cartAmount();
            $orderData['tax'] = $request->tax;
            $orderData['order_status'] = 'In Progress';
            $order = Order::create($orderData);

            foreach ($cartItems as $key => $item) {
                $orderItemData['order_id'] = $order->id;
                $orderItemData['package_id'] = $item->package_id;
                $orderItemData['adult_qty'] = $item->qty_adult;
                $orderItemData['child_qty'] = $item->qty_child;
                $orderItemData['infant_qty'] = $item->qty_infant;
                $orderItemData['total_price'] = Cart::itemPrice($item);
                $orderItem = OrderItem::create($orderItemData);
            }
            $email = $request->email;
        }
        $cartItems->each->delete();
        // email confirmation 
        // email template here
        return view('frontend.success', compact('email'));
    }
}

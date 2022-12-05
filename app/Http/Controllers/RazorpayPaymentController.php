<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Package;
use App\Models\User;
use App\Models\City;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Auth;
use Hash;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('razorpayView');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'nullable|string|min:3',
            'city' => 'nullable|string|min:3',
            'pincode' => 'nullable|string',
            'address' => 'nullable|string|min:3'
        ]);

        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                // $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
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
                            $orderItemData['date'] = $item->date;
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
                            $orderItemData['date'] = $item->date;
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
                        'name' => 'required|string|min:3',
                        'country' => 'required|string|min:3',
                        'city' => 'required|string|min:3',
                        'pincode' => 'required|string',
                        'address' => 'required|string|min:3'
                    ]);

                    // user existance check
                    $emailCheck = User::whereEmail($request->email)->count();
                    $mobileCheck = User::whereMobile($request->mobile)->count();
                    if($emailCheck != 0){
                        return redirect()->route('checkout')->with('failure','Email is already registered. Try login');
                    }elseif($mobileCheck != 0){
                        return redirect()->route('checkout')->with('failure','Mobile is already registered. Try login');
                    }else{
                        $userData['name'] = $request->name;
                        $userData['email'] = $request->email;
                        $userData['mobile'] = $request->mobile;
                        $userData['password'] = Hash::make('test1234');
                        $user = User::create($userData);

                        // email the user after registration
                        // Email template

                        $addressData['user_id'] = $user->id;
                        $addressData['default'] = 0;
                        $addressData['country'] = $request->country;
                        $addressData['city'] = $request->city;
                        $addressData['pincode'] = $request->pincode;
                        $addressData['address'] = $request->address;
                        $userAddress = UserAddress::create($addressData);
                    }

                    $cartItems = Cart::whereUserId(session()->getId())->get();
                    $orderData['user_id'] = $user->id;
                    $orderData['user_address_id'] = $userAddress->id;
                    $orderData['total_amount'] = Cart::cartAmount();
                    $orderData['tax'] = $request->tax;
                    $orderData['order_status'] = 'In Progress';
                    $order = Order::create($orderData);

                    foreach ($cartItems as $key => $item) {
                        $orderItemData['order_id'] = $order->id;
                        $orderItemData['package_id'] = $item->package_id;
                        $orderItemData['date'] = $item->date;
                        $orderItemData['adult_qty'] = $item->qty_adult;
                        $orderItemData['child_qty'] = $item->qty_child;
                        $orderItemData['infant_qty'] = $item->qty_infant;
                        $orderItemData['total_price'] = Cart::itemPrice($item);
                        $orderItem = OrderItem::create($orderItemData);
                    }
                    $email = $request->email;
                }
                $cartItems->each->delete();
            } catch (Exception $e) {
                return redirect()->route('checkout')->with('failure',$e->getMessage());
            }
        }

        // email confirmation 
        // email template here
        return redirect()->route('success')->with('success','Order Successfull.');
    }
}

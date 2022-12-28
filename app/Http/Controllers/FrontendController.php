<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\UserAddress;
use App\Models\Amenity;
use App\Models\Activity;
use Auth;
use Hash;
use Session;

class FrontendController extends Controller
{
    public function tour() {
        $packages = Package::whereStatus(1)->get();

        $cities = City::all();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour', compact('packages','cities','activities','amenities','categories'));
    }

    public function searchAmenityFilter($id, $search)
    {
        try {
            $ifCity = City::whereName($search)->pluck('country_id')->first();
            $requests['city'] = [$ifCity];
            if (empty($ifCity)) {
                $ifCity = Country::whereName($search)->pluck('id')->first();
            }
            $cities = City::whereCountryId($ifCity)->get();
            $activities = Activity::whereStatus(1)->get();
            $amenities = Amenity::whereStatus(1)->get();
            $categories = Category::whereStatus(1)->get();
            $requests['amenity'] = [$id];

            $packages = [];
            if ($search) {
                $cityArray = $amenityArray = [];
                // CITY
                $cityId = City::whereName($search)->pluck('id')->first();
                $cityTemp = Package::whereStatus(1)->whereCityId($cityId)->pluck('id')->toArray();
                if(!empty($cityTemp)) {
                    foreach ($cityTemp as $index => $value) {
                        $cityArray[] = $value;
                    }
                }
                $tours[] = $cityArray;

                // AMENITY
                $amenityTemp = PackageAmenity::whereAmenityId($id)->pluck('package_id')->toArray();
                if(!empty($amenityTemp)) {
                    foreach ($amenityTemp as $index => $value) {
                        $amenityArray[] = $value;
                    }
                }
                $tours[]=$amenityArray;

                $toursArray = array_chunk($tours,1,1);
                $toursCount = count($toursArray);

                for ($i=0; $i < $toursCount; $i++) { 
                    $result = array_intersect($tours[$i]);
                }

                if (!empty($result)) {
                    $packages = Package::findOrFail($result);
                } else {
                    $packages = Package::whereStatus(2)->get();
                }
            }
            return view('frontend.tour-search', compact('packages','requests','search','cities','activities','amenities','categories'));
        } catch(\Exception $e){
            // dd($e->getMessage());
            $packages = Package::whereStatus(2)->get();
            return view('frontend.tour', compact('packages','requests','search','cities','activities','amenities','categories'));
        }
    }

    public function searchFilter(Request $request){
        try {
            // dd($request->all());
            $requests = $request->all();
            $search = '';
            if (!empty($request->hidden_cityOrCountry)) {
                $search = $request->hidden_cityOrCountry;
                $ifLoc = City::whereName($request->hidden_cityOrCountry)->pluck('country_id')->first();
                if(empty($request->city)){
                    $requests['city'] = [$ifLoc];
                }
                if (empty($ifLoc)) {
                    $ifLoc = Country::whereName($request->hidden_cityOrCountry)->pluck('id')->first();
                }
            }
            // Filter start

            $cityArray = $categoryArray = $activityArray = $amenityArray = [];
            if ($request->city) {
                foreach ($request->city as $key => $cityId) {
                    $cityTemp = Package::whereStatus(1)->whereCityId($cityId)->pluck('id')->toArray();
                    if(!empty($cityTemp)) {
                        foreach ($cityTemp as $index => $value) {
                            $cityArray[] = $value;
                        }
                    }
                }
                $tours[] = $cityArray;
            }

            if ($request->range) {
                $range = explode(';',$request->range);
                $rangeArray = Package::whereStatus(1)->whereBetween('adult_price',[$range[0],$range[1]])->pluck('id')->toArray();
                $tours[]=$rangeArray;
            }

            if ($request->category) {
                foreach ($request->category as $key => $categoryId) {
                    $categoryTemp = Package::whereStatus(1)->whereCategoryId($categoryId)->pluck('id')->toArray();
                    if(!empty($categoryTemp)) {
                        foreach ($categoryTemp as $index => $value) {
                            $categoryArray[] = $value;
                        }
                    }
                }
                $tours[]=$categoryArray;
            }

            if ($request->activity) {
                foreach ($request->activity as $key => $activityId) {
                    $activityTemp = Package::whereStatus(1)->whereActivityId($activityId)->pluck('id')->toArray();
                    if(!empty($activityTemp)) {
                        foreach ($activityTemp as $index => $value) {
                            $activityArray[] = $value;
                        }
                    }
                }
                $tours[]=$activityArray;
            }

            if ($request->amenity) {
                foreach ($request->amenity as $key => $amenityId) {
                    $amenityTemp = PackageAmenity::whereAmenityId($amenityId)->pluck('package_id')->toArray();
                    if(!empty($amenityTemp)) {
                        foreach ($amenityTemp as $index => $value) {
                            $amenityArray[] = $value;
                        }
                    }
                }
                $tours[]=$amenityArray;
            }

            $toursArray = array_chunk($tours,1,1);
            $toursCount = count($toursArray);

            for ($i=0; $i < $toursCount; $i++) { 
                $result = array_intersect($tours[$i]);
            }

            if (!empty($result)) {
                $packages = Package::findOrFail($result);
            } else {
                $packages = Package::whereStatus(2)->get();
            }
            // Filter ends

            if (!empty($ifLoc)) {
                $cities = City::whereCountryId($ifLoc)->get();
            }else{
                $cities = City::all();
            }
            $activities = Activity::whereStatus(1)->get();
            $amenities = Amenity::whereStatus(1)->get();
            $categories = Category::whereStatus(1)->get();
            return view('frontend.tour', compact('packages','requests','search','cities','activities','amenities','categories'));
        } catch(\Exception $e){
            // dd($e->getMessage());
            $packages = Package::whereStatus(2)->get();
            return view('frontend.tour', compact('packages','requests','search','cities','activities','amenities','categories'));
        }
    }

    public function tourShow($slug) {
        $tour = Package::whereSlug($slug)->first();
        if ($tour) {
            return view('frontend.tour-details', compact('tour'));
        }
        return view('errors.404');
    }

    public function search(Request $request) {
        try {
            if ($request->method() == 'POST') {
                $search = $request->search;
                $packages = [];
                if ($search) {
                    $exactCityName = City::whereName($search)->pluck('id')->first();
                    if ($exactCityName) {
                        $packages = Package::whereStatus(1)->whereCityId($exactCityName)->get();
                        return view('frontend.tour-location', compact('packages','search'));
                    }

                    $exactCountryName = Country::whereName($search)->pluck('name')->first();
                    if ($exactCountryName) {
                        $packages = Package::whereStatus(1)
                            ->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('city', function($q) {
                                $q->where('name', '=',request('search'))
                                    ->orWhereHas('country', function($q1) {
                                    $q1->where('name', '=', request('search'))
                                       ->whereStatus(1);
                                });
                            })->get();

                        return view('frontend.tour-location', compact('packages','search'));
                    }

                    $packages = Package::whereStatus(1)
                            ->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('city', function($q) {
                                $q->where('name', 'like', '%' . request('search') . '%')
                                    ->orWhereHas('country', function($q1) {
                                    $q1->where('name', 'like', '%' . request('search') . '%')
                                       ->whereStatus(1);
                                });
                            })->get();
                }

                $cities = City::all();
                $activities = Activity::whereStatus(1)->get();
                $amenities = Amenity::whereStatus(1)->get();
                $categories = Category::whereStatus(1)->get();
                return view('frontend.tour-search', compact('packages','search','cities','activities','amenities','categories'));
            }
            return redirect('/tours');
        } catch(\Exception $e){
            return redirect('/tours');
        }
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
        $search = $city->name;
        $packages = Package::whereStatus(1)->whereCityId($id)->get();

        return view('frontend.tour-location', compact('packages','search'));
    }

    public function searchCategory($id){
        $category = Category::findOrFail($id);
        $requests['category'] = [$category->id];
        $search = $category->name??'';
        $packages = [];

        if ($search) {
            $packages = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->get();
        }
        $cities = City::all();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour-search', compact('packages','search','requests','cities','activities','amenities','categories'));
    }

    public function searchActivity($id){
        $activity = Activity::findOrFail($id);
        $requests['activity'] = [$activity->id];
        $search = $activity->name??'';
        $packages = [];

        if ($search) {
            $packages = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('activity', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->get();
        }
        $cities = City::all();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour-search', compact('packages','search','requests','cities','activities','amenities','categories'));
    }

    public function searchAmenity($id)
    {
        $amenity = Amenity::findOrFail($id);
        $requests['amenity'] = [$amenity->id];
        $search = $amenity->name??'';

        if ($search) {
            $packages = Package::whereStatus(1)
                    ->where('name', 'like', '%' . $id . '%')
                    ->orWhereHas('amenities', function($q) use ($id) {
                        $q->where('amenity_id', '=' ,$id);
                    })->get();
        }
        $cities = City::all();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour-search', compact('packages','search','requests','cities','activities','amenities','categories'));
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
        $data = $request->all();
        return view('razorpayView',compact('data'));
    }

    public function success()
    {
        return view('frontend.success');
    }

    public function reviewSubmit(Request $request)
    {
        $order = Order::whereUserId(Auth::user()->id)->wherePackageId($request->package_id)->whereOrderStatus('Completed')->latest()->first();
        if ($order) {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $data['order_id'] = $order->id;
            $data['status'] = 0;
            Review::create($data);

            return redirect()->back()->with('success','Review successfully submitted.');
        }
        return redirect()->back();
    }
}

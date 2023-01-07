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

        $countryList = Country::whereStatus(1)->get();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour', compact('packages','countryList','activities','amenities','categories'));
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

                if($toursCount == 1){
                    $result = array_intersect($tours[0]);
                }elseif($toursCount == 2){
                    $result = array_intersect($tours[0],$tours[1]);
                }elseif($toursCount == 3){
                    $result = array_intersect($tours[0],$tours[1],$tours[2]);
                }elseif($toursCount == 4){
                    $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3]);
                }elseif($toursCount == 5){
                    $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4]);
                }elseif($toursCount == 6){
                    $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4],$tours[5]);
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
            dd($request->all());
            $requests = $request->all();
            $search = '';
            // Filter start

            $countryArray = $categoryArray = $activityArray = $amenityArray = [];
            if ($request->country) {
                foreach ($request->country as $key => $countryId) {
                    $countryTemp = Package::whereStatus(1)
                            ->WhereHas('city.country', function($q) use($countryId) {
                                $q->whereId($countryId);
                            })->pluck('id')->toArray();
                    if(!empty($countryTemp)) {
                        foreach ($countryTemp as $index => $value) {
                            $countryArray[] = $value;
                        }
                    }
                }
                $tours[] = $countryArray;
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

            if($toursCount == 1){
                $result = array_intersect($tours[0]);
            }elseif($toursCount == 2){
                $result = array_intersect($tours[0],$tours[1]);
            }elseif($toursCount == 3){
                $result = array_intersect($tours[0],$tours[1],$tours[2]);
            }elseif($toursCount == 4){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3]);
            }elseif($toursCount == 5){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4]);
            }elseif($toursCount == 6){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4],$tours[5]);
            }

            if (!empty($result)) {
                $packages = Package::findOrFail($result);
            } else {
                $packages = Package::whereStatus(2)->get();
            }
            // Filter ends

            $countryList = Country::whereStatus(1)->get();
            $activities = Activity::whereStatus(1)->get();
            $amenities = Amenity::whereStatus(1)->get();
            $categories = Category::whereStatus(1)->get();
            return view('frontend.tour', compact('packages','requests','search','countryList','activities','amenities','categories'));
        } catch(\Exception $e){
            // dd($e->getMessage());
            $packages = Package::whereStatus(2)->get();
            return view('frontend.tour', compact('packages','requests','search','countryList','activities','amenities','categories'));
        }
    }

    // city popup filter
    public function searchCityLocationFilter($id, Request $request){
        try {
            $requests = $request->all();
            // Filter start

            $cityArray = $categoryArray = $activityArray = $amenityArray = [];
            if ($id) {
                $cityTemp = Package::whereStatus(1)->whereCityId($id)->pluck('id')->toArray();
                if(!empty($cityTemp)) {
                    foreach ($cityTemp as $index => $value) {
                        $cityArray[] = $value;
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
                $reqCategory = explode(',',$request->category);
                foreach ($reqCategory as $key => $categoryId) {
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
                $reqActivity = explode(',',$request->activity);
                foreach ($reqActivity as $key => $activityId) {
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
                $reqAmenity = explode(',',$request->amenity);
                foreach ($reqAmenity as $key => $amenityId) {
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

            if($toursCount == 1){
                $result = array_intersect($tours[0]);
            }elseif($toursCount == 2){
                $result = array_intersect($tours[0],$tours[1]);
            }elseif($toursCount == 3){
                $result = array_intersect($tours[0],$tours[1],$tours[2]);
            }elseif($toursCount == 4){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3]);
            }elseif($toursCount == 5){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4]);
            }elseif($toursCount == 6){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4],$tours[5]);
            }

            if (!empty($result)) {
                $packages = Package::findOrFail($result);
            } else {
                $packages = Package::whereStatus(2)->get();
            }
            // Filter ends

            foreach ($packages as $key => $package) {
                $packages[$key]['name'] = dynamicLang(\Illuminate\Support\Str::limit($package->name ?? '',25,' ...'));
                $packages[$key]['rating'] = $package->rating;
                $packages[$key]['currency_symbol'] = Session::get('currency_symbol')??'₹';
                $packages[$key]['adult_price'] = switchCurrency($package->adult_price);
                $packages[$key]['new_price'] = switchCurrency($package->adult_price-($package->adult_price*$package->discount)/100);
                $packages[$key]['category'] = $package->category;
                $packages[$key]['reviews_count'] = $package->reviews;

                if(Auth::user()){
                    if(Auth::user()->wishlist->count() > 0){
                        foreach (Auth::user()->wishlist as $key => $wishlist) {
                            if ($wishlist->package_id == $package->id) {
                                $packages[$key]['wishlist'] = 'added';
                            }else{
                                $packages[$key]['wishlist'] = 'not_added';
                            }
                        }
                    }else{
                        $packages[$key]['wishlist'] = 'not_added';
                    }
                }else{
                    $packages[$key]['wishlist'] = 'not_added';
                }
            }
            return response()->json([
                'status'=>'ok',
                'message'=>'success',
                'packages'=> $packages
            ]);
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    // done
    public function searchCountryLocationFilter($id, Request $request){
        try {
            $requests = $request->all();
            // Filter start

            $countryArray = $categoryArray = $activityArray = $amenityArray = [];
            if ($id) {
                $countryTemp = Package::whereStatus(1)
                            ->WhereHas('city.country', function($q) use($id) {
                                $q->whereId($id);
                            })->pluck('id')->toArray();
                if(!empty($countryTemp)) {
                    foreach ($countryTemp as $index => $value) {
                        $countryArray[] = $value;
                    }
                }
                $tours[] = $countryArray;
            }

            if ($request->range) {
                $range = explode(';',$request->range);
                $rangeArray = Package::whereStatus(1)->whereBetween('adult_price',[$range[0],$range[1]])->pluck('id')->toArray();
                $tours[]=$rangeArray;
            }

            if ($request->category) {
                $reqCategory = explode(',',$request->category);
                foreach ($reqCategory as $key => $categoryId) {
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
                $reqActivity = explode(',',$request->activity);
                foreach ($reqActivity as $key => $activityId) {
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
                $reqAmenity = explode(',',$request->amenity);
                foreach ($reqAmenity as $key => $amenityId) {
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

            if($toursCount == 1){
                $result = array_intersect($tours[0]);
            }elseif($toursCount == 2){
                $result = array_intersect($tours[0],$tours[1]);
            }elseif($toursCount == 3){
                $result = array_intersect($tours[0],$tours[1],$tours[2]);
            }elseif($toursCount == 4){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3]);
            }elseif($toursCount == 5){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4]);
            }elseif($toursCount == 6){
                $result = array_intersect($tours[0],$tours[1],$tours[2],$tours[3],$tours[4],$tours[5]);
            }

            if (!empty($result)) {
                $packages = Package::findOrFail($result);
            } else {
                $packages = Package::whereStatus(2)->get();
            }
            // Filter ends

            foreach ($packages as $key => $package) {
                $packages[$key]['name'] = dynamicLang(\Illuminate\Support\Str::limit($package->name ?? '',25,' ...'));
                $packages[$key]['rating'] = $package->rating;
                $packages[$key]['currency_symbol'] = Session::get('currency_symbol')??'₹';
                $packages[$key]['adult_price'] = switchCurrency($package->adult_price);
                $packages[$key]['new_price'] = switchCurrency($package->adult_price-($package->adult_price*$package->discount)/100);
                $packages[$key]['category'] = $package->category;
                $packages[$key]['reviews_count'] = $package->reviews;

                if(Auth::user()){
                    if(Auth::user()->wishlist->count() > 0){
                        foreach (Auth::user()->wishlist as $key => $wishlist) {
                            if ($wishlist->package_id == $package->id) {
                                $packages[$key]['wishlist'] = 'added';
                            }else{
                                $packages[$key]['wishlist'] = 'not_added';
                            }
                        }
                    }else{
                        $packages[$key]['wishlist'] = 'not_added';
                    }
                }else{
                    $packages[$key]['wishlist'] = 'not_added';
                }
            }
            return response()->json([
                'status'=>'ok',
                'message'=>'success',
                'packages'=> $packages
            ]);
        } catch(\Exception $e){
            dd($e->getMessage());
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
                    $exactCityId = City::whereName($search)->pluck('id')->first();
                    if ($exactCityId) {
                        return redirect()->route('search.city',['id' => $exactCityId]);
                    }

                    $exactCountryId = Country::whereName($search)->pluck('id')->first();
                    if ($exactCountryId) {
                        return redirect()->route('search.country',['id' => $exactCountryId]);
                    }

                    return redirect()->route('search.term',['search' => $search]);
                }
            }
            return redirect('/tours');
        } catch(\Exception $e){
            dd($e->getMessage());
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
        $searchType = 'city';
        $packages = Package::whereStatus(1)->whereCityId($id)->get();
        return view('frontend.tour-location', compact('packages','search','searchType','id'));
    }

    public function searchCityAmenity($id, $aminityIds)
    {
        $amenityId = explode(',',$aminityIds);
        $packages = Package::whereStatus(1)
                            ->whereCityId($id)
                            ->WhereHas('amenities', function($q) use($amenityId) {
                                $q->whereIn('amenity_id', $amenityId);
                            })
                            ->with('category')
                            ->withCount('reviews')
                            ->get();

        foreach ($packages as $key => $package) {
            $packages[$key]['name'] = dynamicLang(\Illuminate\Support\Str::limit($package->name ?? '',25,' ...'));
            $packages[$key]['rating'] = $package->rating;
            $packages[$key]['currency_symbol'] = Session::get('currency_symbol')??'₹';
            $packages[$key]['adult_price'] = switchCurrency($package->adult_price);
            $packages[$key]['new_price'] = switchCurrency($package->adult_price-($package->adult_price*$package->discount)/100);

            if(Auth::user()){
                if(Auth::user()->wishlist->count() > 0){
                    foreach (Auth::user()->wishlist as $key => $wishlist) {
                        if ($wishlist->package_id == $package->id) {
                            $packages[$key]['wishlist'] = 'added';
                        }else{
                            $packages[$key]['wishlist'] = 'not_added';
                        }
                    }
                }else{
                    $packages[$key]['wishlist'] = 'not_added';
                }
            }else{
                $packages[$key]['wishlist'] = 'not_added';
            }
        }

        return response()->json([
            'status'=>'ok',
            'message'=>'success',
            'packages'=> $packages,
            'amenityId'=>$amenityId
        ]);
    }

    public function searchCountryAmenity($id, $aminityIds)
    {
        $amenityId = explode(',',$aminityIds);
        $packages = Package::whereStatus(1)
                            ->WhereHas('city.country', function($q) use($id) {
                                $q->whereId($id);
                            })
                            ->WhereHas('amenities', function($q) use($amenityId) {
                                $q->whereIn('amenity_id', $amenityId);
                            })
                            ->with('category')
                            ->withCount('reviews')
                            ->get();

        foreach ($packages as $key => $package) {
            $packages[$key]['name'] = dynamicLang(\Illuminate\Support\Str::limit($package->name ?? '',25,' ...'));
            $packages[$key]['rating'] = $package->rating;
            $packages[$key]['currency_symbol'] = Session::get('currency_symbol')??'₹';
            $packages[$key]['adult_price'] = switchCurrency($package->adult_price);
            $packages[$key]['new_price'] = switchCurrency($package->adult_price-($package->adult_price*$package->discount)/100);

            if(Auth::user()){
                if(Auth::user()->wishlist->count() > 0){
                    foreach (Auth::user()->wishlist as $key => $wishlist) {
                        if ($wishlist->package_id == $package->id) {
                            $packages[$key]['wishlist'] = 'added';
                        }else{
                            $packages[$key]['wishlist'] = 'not_added';
                        }
                    }
                }else{
                    $packages[$key]['wishlist'] = 'not_added';
                }
            }else{
                $packages[$key]['wishlist'] = 'not_added';
            }
        }

        return response()->json([
            'status'=>'ok',
            'message'=>'success',
            'packages'=> $packages,
            'amenityId'=>$amenityId
        ]);
    }

    public function searchCountry($id) {
        $country = Country::findOrFail($id);
        $search = $country->name;
        $searchType = 'country';
        $packages = Package::whereStatus(1)
                            ->WhereHas('city.country', function($q) use($country) {
                                $q->whereId($country->id);
                            })->get();
        return view('frontend.tour-location', compact('packages','search','searchType','id'));
    }

    public function searchTerm($search) {
        $packages = Package::whereStatus(1)
                            ->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('city', function($q) {
                                $q->where('name', 'like', '%' . request('search') . '%')
                                    ->orWhereHas('country', function($q1) {
                                    $q1->where('name', 'like', '%' . request('search') . '%')
                                       ->whereStatus(1);
                                });
                            })->get();

        $countryList = Country::whereStatus(1)->get();
        $activities = Activity::whereStatus(1)->get();
        $amenities = Amenity::whereStatus(1)->get();
        $categories = Category::whereStatus(1)->get();
        return view('frontend.tour-search', compact('packages','search','countryList','activities','amenities','categories'));
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

        $date = $request['date'];
        $request['date'] = date("Y-m-d", strtotime($date));

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
        if (Auth::user()) {
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
        } else {
            $cartItems = Cart::whereUserId(session()->getId())->get();
        }
        return view('frontend.checkout', compact('cartAmount','cartItems'));
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

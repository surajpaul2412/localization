<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\City;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Cart;
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
            return view('frontend.cart', compact('cartItems'));
        } else {
            $cartItems = Cart::whereUserId(session()->getId())->get();
            return view('frontend.cart', compact('cartItems'));
        }
        return redirect()->back();
    }

    public function cartAdd($id){
        if (Auth::user()) {
            $data['user_id'] = Auth::user()->id;
            $data['package_id'] = $id;

            Cart::create($data);
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
            return view('frontend.cart', compact('cartItems'));
        } else {
            $data['user_id'] = session()->getId();
            $data['package_id'] = $id;

            Cart::create($data);
            $cartItems = Cart::whereUserId(session()->getId())->get();
            return view('frontend.cart', compact('cartItems'));
        }
        
        
    }

    public function cartRemove($id){
        Cart::findOrFail($id)->delete();
        if (Auth::user()) {            
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
            return view('frontend.cart', compact('cartItems'))->with('success','Removed from Cart.');
        } else {
            $cartItems = Cart::whereUserId(session()->getId())->get();
            return view('frontend.cart', compact('cartItems'))->with('success','Removed from Cart.');
        }
    }
}

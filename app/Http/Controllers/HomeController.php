<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\WishList;
use App\Models\Package;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function success()
    {
        return view('frontend.success');
    }

    public function wishlist()
    {
        if (Auth::user()) {
            $userWishlistItems = WishList::userWishListItems();
            return view('frontend.wishlist', compact('userWishlistItems'));
        }
        return redirect()->back();
    }

    public function wishlistAdd($productId) {
        if (Auth::user()) {
            $tour = Package::findOrFail($productId);
            // wishlist exists check
            $wishlist = WishList::whereUserId(Auth::user()->id)->wherePackageId($productId)->first();
            if (isset($wishlist)) {
                return redirect()->back()->with('failure','Tour already added to wishlist.');
            }
            WishList::create(['user_id'=>Auth::user()->id, 'package_id'=>$tour->id]);
            return redirect()->back()->with('success','Tour added successfully.');
        }
        return redirect()->back();
    }

    public function wishlistRemove($id){
        $wishlist = WishList::findOrFail($id)->delete();
        $userWishlistItems = WishList::userWishListItems();
        return view('frontend.wishlist', compact('userWishlistItems'));
    }

    public function cart()
    {
        if (Auth::user()) {
            return view('frontend.cart');
        }
        return redirect()->back();
    }

    public function checkout()
    {
        if (Auth::user()) {
            return view('frontend.checkout');
        }
        return redirect()->back();
    }
}

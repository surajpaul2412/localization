<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Wishlist;
use App\Models\Package;
use App\Models\Cart;
use Auth;
use Session;

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
            $userWishlistItems = Wishlist::userWishlistItems();
            return view('frontend.wishlist', compact('userWishlistItems'));
        }
        return redirect()->back();
    }

    public function wishlistAdd($productId) {
        if (Auth::user()) {
            $tour = Package::findOrFail($productId);
            // wishlist exists check
            $wishlist = Wishlist::whereUserId(Auth::user()->id)->wherePackageId($productId)->first();
            if (isset($wishlist)) {
                return redirect()->back()->with('failure','Tour already added to wishlist.');
            }
            Wishlist::create(['user_id'=>Auth::user()->id, 'package_id'=>$tour->id]);
            return redirect()->back()->with('success','Tour added successfully.');
        }
        return redirect()->back();
    }

    public function wishlistRemove($id){
        $wishlist = Wishlist::findOrFail($id)->delete();
        return redirect()->route('wishlist')->with('success','Removed from wishlist successfully.');
    }

    public function wishlistMoveToCart($id){
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist) {
            $cartCount = Cart::whereUserId($wishlist->user_id)->wherePackageId($wishlist->package_id)->count();
            if ($cartCount == 0) {
                $data['user_id'] = $wishlist->user_id;
                $data['package_id'] = $wishlist->package_id;
                
                Cart::create($data);
                $wishlist->delete();
            } else {
                return redirect()->route('wishlist')->with('failure','Already added in the Cart.');
            }
        }
        return redirect()->route('wishlist')->with('success','Moved into Cart Successfully.');
    }

    public function cartMoveToWishlist($id){
        $cart = Cart::findOrFail($id);
        if ($cart){
            $wishlistCount = Wishlist::whereUserId($cart->user_id)->wherePackageId($cart->package_id)->count();
            if($wishlistCount != 1){
                $data['user_id'] = $cart->user_id;
                $data['package_id'] = $cart->package_id;
                Wishlist::create($data);
            }
        }
        $cart->delete();
        return redirect()->route('cart')->with('success','Moved to Wishlist Successfully.');
    }
}

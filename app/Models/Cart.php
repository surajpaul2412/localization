<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','package_id','date','qty_adult','qty_child','qty_infant'
    ];

    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id','id');
    }

    public static function cartAmount(){
        if (Auth::user()) {
            $cartItems = Cart::whereUserId(Auth::user()->id)->get();
        } else {
            $cartItems = Cart::whereUserId(session()->getId())->get();
        }

        $totAmt = 0;$finalAmt = 0;
        foreach ($cartItems as $key => $item) {
            $package = Package::findOrFail($item->package_id);

            $adultPrice = ($package->adult_price*$item->qty_adult);
            $childPrice = ($package->child_price*$item->qty_child);
            $infantPrice = ($package->infant_price*$item->qty_infant);

            $totAmt = $totAmt + ($adultPrice + $childPrice + $infantPrice);
            $finalAmt = $totAmt - ($totAmt*$package->discount)/100;
        }
        return $finalAmt;
    }

    public static function itemPrice($item){
        $package = Package::findOrFail($item->package_id);
        $totAmt = ($package->adult_price*$item->qty_adult)+($package->child_price*$item->qty_child)+($package->infant_price*$item->qty_infant);
        $finalAmt = $totAmt - ($totAmt*$package->discount)/100;
        return $finalAmt;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','package_id'
    ];

    public static function userWishlistItems(){
        $userWishlistItems = Wishlist::with(['package'=>function($query){
            $query->select('id','name','slug','category_id','adult_price','child_price','infant_price','discount','capacity','duration','avatar','city_id','activity_id','description','status','meta_title','meta_keywords','meta_description','highlights','full_description','includes','meeting_point','important_information','seal','icon','created_at','updated_at');
        }])->where('user_id', Auth::user()->id)->orderBy('id','asc')->get()->toArray();
        return $userWishlistItems;
    }

    public function package(){
        return $this->belongsTo('App\Models\Package','package_id');
    }
}

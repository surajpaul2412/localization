<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no','user_id','package_id','user_address_id','date','adult_qty','child_qty','infant_qty','price','tax','order_status','razorpay_payment_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\UserAddress','user_address_id','id');
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\Orderstatus','order_id','id');
    }
}

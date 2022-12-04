<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','user_address_id','total_amount','tax','order_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\UserAddress','user_address_id');
    }
}

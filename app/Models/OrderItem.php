<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id','package_id','date','adult_qty','child_qty','infant_qty','total_price'
    ];

    use HasFactory;
}

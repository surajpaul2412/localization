<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','package_id'
    ];

    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id','id');
    }
}

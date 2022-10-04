<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','city_id','description','icon','avatar','meta_title','meta_keywords','meta_description','status'
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}

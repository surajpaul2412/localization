<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email','phone','address','facebook','twitter','instagram','linkedin','sys_email','meta_title','meta_description','meta_keywords'
    ];
}

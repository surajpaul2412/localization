<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','category_id','price','capacity','avatar','city_id','destination_id','duration','departure','return','description','status','meta_title','meta_keywords','meta_description'
    ];

    public static function createPackage($data) {
        dd($data);

        return Package::create([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'slug'=>$data['slug'],
            'slug'=>$data['slug'],
            'slug'=>$data['slug'],
            'slug'=>$data['slug'],
        ]);
    }
}

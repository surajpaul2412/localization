<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','category_id','price','capacity','avatar','city_id','destination_id','duration','departure','return','description','status','meta_title','meta_keywords','meta_description','highlights','full_description','includes','meeting_point','important_information'
    ];

    public static function createPackage($data) {
        $image = $data['avatar'];
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
            $image_name = 'uploads/avatar/'.$image_name;
        }

        return Package::create([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'price'=>$data['price'],
            'capacity'=>$data['capacity'],
            'city_id'=>$data['city'],
            'destination_id'=>$data['destination'],
            'duration'=>$data['duration'],
            'departure'=>$data['departure'],
            'return'=>$data['return'],
            'category_id'=>$data['category'],
            'description'=>$data['description'],
            'meta_title'=>$data['meta_title'],
            'meta_keywords'=>$data['meta_keywords'],
            'meta_description'=>$data['meta_description'],
            'avatar'=>$image_name,
            'highlights'=>$data['highlights'],
            'full_description'=>$data['full_description'],
            'includes'=>$data['includes'],
            'meeting_point'=>$data['meeting_point'],
            'important_information'=>$data['important_information'],
        ]);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function destination()
    {
        return $this->belongsTo('App\Models\Destination');
    }

    public function amenities()
    {
        return $this->hasMany('App\Models\PackageAmenity');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\PackageGallery');
    }
}

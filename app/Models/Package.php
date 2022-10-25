<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','category_id','adult_price','child_price','infant_price','capacity','duration','avatar','city_id','activity_id','description','status','meta_title','meta_keywords','meta_description','highlights','full_description','includes','meeting_point','important_information','seal','icon'
    ];

    public static function createPackage($data) {
        if (!empty($data['avatar'])) {
            $image = $data['avatar'];
            if($image != ''){
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/tour'), $image_name);
                $image_name = 'uploads/tour/'.$image_name;
            }
        }
        
        if (!empty($data['icon'])) {
            $icon = $data['icon'];
            if($icon != ''){
                $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('uploads/tour'), $icon_name);
                $icon_name = 'uploads/tour/'.$icon_name;
            }
        }

        return Package::create([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'adult_price'=>$data['adult_price'],
            'child_price'=>$data['child_price'],
            'infant_price'=>$data['infant_price'],
            'capacity'=>$data['capacity'],
            'duration'=>$data['duration'],
            'category_id'=>$data['category'],
            'city_id'=>$data['city'],
            'activity_id'=>$data['activity'],
            'description'=>$data['description'],
            'meta_title'=>$data['meta_title'],
            'meta_keywords'=>$data['meta_keywords'],
            'meta_description'=>$data['meta_description'],
            'icon'=>$icon_name??'uploads/tour/default-icon.jpg',
            'avatar'=>$image_name??'uploads/tour/default-avatar.jpg',
            'highlights'=>$data['highlights'],
            'full_description'=>$data['full_description'],
            'includes'=>$data['includes'],
            'meeting_point'=>$data['meeting_point'],
            'important_information'=>$data['important_information'],
            'status'=>$data['status']??1,
            'seal'=>$data['seal']??0,
        ]);
    }

    public function updatePackage($data, $id) {
        $icon_name = $data['hidden_icon'];
        if(!empty($data['icon'])){
            if (Package::findOrFail($id)->icon != 'uploads/tour/default-icon.jpg') {
                if(File::exists(Package::findOrFail($id)->icon)) {
                    File::delete(Package::findOrFail($id)->icon);
                }
            }
            $icon = $data['icon'];
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/tour'), $icon_name);
            $icon_name = 'uploads/tour/'.$icon_name;
        }

        $image_name = $data['hidden_avatar'];
        if(!empty($data['avatar'])){
            if (Package::findOrFail($id)->avatar != 'uploads/tour/default-avatar.jpg') {
                if(File::exists(Package::findOrFail($id)->avatar)) {
                    File::delete(Package::findOrFail($id)->avatar);
                }
            }
            $image = $data['avatar'];
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/tour'), $image_name);
            $image_name = 'uploads/tour/'.$image_name;
        }

        return Package::whereId($id)->update([
            'name'=>$data['name'],
            'slug'=>$data['slug'],
            'adult_price'=>$data['adult_price'],
            'child_price'=>$data['child_price'],
            'infant_price'=>$data['infant_price'],
            'capacity'=>$data['capacity'],
            'duration'=>$data['duration'],
            'category_id'=>$data['category'],
            'city_id'=>$data['city'],
            'activity_id'=>$data['activity'],
            'description'=>$data['description'],
            'meta_title'=>$data['meta_title']??null,
            'meta_keywords'=>$data['meta_keywords']??null,
            'meta_description'=>$data['meta_description']??null,
            'icon'=>$icon_name,
            'avatar'=>$image_name,
            'highlights'=>$data['highlights']??null,
            'full_description'=>$data['full_description']??null,
            'includes'=>$data['includes']??null,
            'meeting_point'=>$data['meeting_point']??null,
            'important_information'=>$data['important_information']??null,
            'status'=>$data['status']??Package::findOrFail($id)->status,
            'seal'=>$data['seal']??Package::findOrFail($id)->seal,
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

    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
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

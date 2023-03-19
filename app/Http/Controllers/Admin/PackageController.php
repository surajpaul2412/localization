<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\Country;
use App\Models\Amenity;
use App\Models\Activity;
use App\Models\PackageAmenity;
use App\Models\PackageGallery;
use File;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereStatus(1)->get();
        $countries = Country::whereStatus(1)->get();
        $activities = Activity::whereStatus(1)->get();
        $amenities =  Amenity::whereStatus(1)->get();
        return view('admin.package.create', compact('categories','countries','amenities','activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:2|max:255|unique:categories,slug',
            'adult_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'child_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'infant_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'capacity' => 'required|numeric|min:0',
            'hr' => 'required',
            'min' => 'required',
            'category' => 'required|integer',
            'city' => 'required|integer',
            'activity' => 'required|integer',
            'amenity' => 'required',
            'discount' => 'nullable|min:0|max:100',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'full_description' => 'nullable|string',
            'includes' => 'nullable|string',
            'meeting_point' => 'nullable|string',
            'important_information' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'nullable',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        // Add Package
        $package = Package::createPackage($request->all());

        // Add package Amenity
        $amenityData['package_id'] = $package->id;
        foreach ($request->get('amenity') as $key => $value) {
            $amenityData['amenity_id'] = $value;
            $packageAmenity = PackageAmenity::create($amenityData);
        }

        // Add packaage gallery
        $galleryData['package_id'] = $package->id;
        if($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $image = $value;
                if($image != ''){
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/avatar'), $image_name);
                    $image_name = 'uploads/avatar/'.$image_name;
                }

                $galleryData['image'] = $image_name;
                $packageGallery = PackageGallery::create($galleryData);
            }
        }

        return redirect('/admin/tours')->with('success','Tour added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $categories = Category::whereStatus(1)->get();
        $countries = Country::whereStatus(1)->get();
        $amenities =  Amenity::whereStatus(1)->get();
        $activities = Activity::whereStatus(1)->get();
        return view('admin.package.edit', compact('categories','countries','amenities','package','activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:2|max:255',
            'adult_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'child_price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'infant_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric|min:0',
            'capacity' => 'required|numeric|min:0',
            'hr' => 'required',
            'min' => 'required',
            'category' => 'required|integer',
            'city' => 'required|integer',
            'activity' => 'required|integer',
            'amenity' => 'required',
            'discount' => 'nullable|min:0|max:100',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'highlights' => 'nullable|string',
            'full_description' => 'nullable|string',
            'includes' => 'nullable|string',
            'meeting_point' => 'nullable|string',
            'important_information' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_icon' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_avatar' => 'required|string',
            'images' => 'nullable',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
            'gallery_images'=>'nullable',
            'gallery_images.*'=>'nullable|string'
        ]);
        $package = Package::findOrFail($id);

        // Updating Amenities
        $package->amenities->each->delete();
        $amenityData['package_id'] = $package->id;
        foreach ($request->get('amenity') as $key => $value) {
            $amenityData['amenity_id'] = $value;
            $packageAmenity = PackageAmenity::create($amenityData);
        }

        // Updating Gallery
        $package->gallery->each->delete();
        $galleryData['package_id'] = $package->id;
        if (!empty($request->gallery_images)) {
            foreach ($request->gallery_images as $key => $value) {
                $galleryData['image'] = $value;
                $packageGallery = PackageGallery::create($galleryData);
            }
        }
        if($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $value) {
                $image = $value;
                if($image != ''){
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/tour'), $image_name);
                    $image_name = 'uploads/tour/'.$image_name;
                }

                $galleryData['image'] = $image_name;
                $packageGallery = PackageGallery::create($galleryData);
            }
        }

        // Update Package
        $package->updatePackage($request->all(), $package->id);
        return redirect('admin/tours')->with('success', 'Tour has been successfully updated.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->amenities->each->delete();
        $package->gallery->each->delete();
        if ($package->avatar != 'uploads/tour/default-avatar.jpg') {
            if(File::exists($package->avatar)) {
                File::delete($package->avatar);
            }
        }
        if ($package->icon != 'uploads/tour/default-icon.jpg') {
            if(File::exists($package->icon)) {
                File::delete($package->icon);
            }
        }
        $package->delete();
        return redirect('/admin/tours')->with('success','Tour deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $package = Package::findOrFail($id);
        $package->update(['status'=>1]);
        return redirect('/admin/tours')->with('success', 'Tour has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $package = Package::findOrFail($id);
        $package->update(['status'=>0]);
        return redirect('/admin/tours')->with('success', 'Tour has been successfully deactivated.');
    }
}

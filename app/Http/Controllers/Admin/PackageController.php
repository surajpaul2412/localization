<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use App\Models\PackageGallery;

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
        $destinations = Destination::whereStatus(1)->get();
        $amenities =  Amenity::whereStatus(1)->get();
        return view('admin.package.create', compact('categories','countries','destinations','amenities'));
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
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|min:1',
            'capacity' => 'required|numeric|min:0',
            'city' => 'required|integer',
            'destination' => 'required|integer',
            'duration' => 'required|integer',
            'departure' => 'required|date_format:Y-m-d\TH:i|after:now',
            'return' => 'required|date_format:Y-m-d\TH:i|after:departure',
            'category' => 'required|integer',
            'amenity' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
            'highlights' => 'nullable|string',
            'full_description' => 'nullable|string',
            'includes' => 'nullable|string',
            'meeting_point' => 'nullable|string',
            'important_information' => 'nullable|string',
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

        return redirect('/admin/packages')->with('success','Package added successfully.');
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
        $destinations = Destination::whereStatus(1)->get();
        $amenities =  Amenity::whereStatus(1)->get();
        return view('admin.package.edit', compact('categories','countries','destinations','amenities','package'));
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
        dd("under dev");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::findOrFail($id)->delete();
        return redirect('/admin/packages')->with('success','Package deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $package = Package::findOrFail($id);
        $package->update(['status'=>1]);
        return redirect('/admin/packages')->with('success', 'Package has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $package = Package::findOrFail($id);
        $package->update(['status'=>0]);
        return redirect('/admin/packages')->with('success', 'Package has been successfully deactivated.');
    }
}

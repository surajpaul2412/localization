<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Amenity;

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
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string'
        ]);
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
        return view('admin.packages.edit', compact('categories','countries','destinations','amenities'));
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
        //
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

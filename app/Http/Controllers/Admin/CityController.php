<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use File;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::all();
        return view('admin.city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return view('admin.city.create', compact('country'));
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
            'country_id' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/city'), $image_name);
            $image_name = 'uploads/city/'.$image_name;
        }

        $data = $request->all();
        $data['avatar'] = $image_name??'uploads/city/default.jpg';
        City::create($data);
        return redirect('/admin/city')->with('success','City created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::all();
        $city = City::findOrFail($id);
        return view('admin.city.edit', compact('city','country'));
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
            'country_id' => 'required|integer',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $city = City::findOrFail($id);

        $image_name = $request->hidden_avatar;
        $image = $request->file('avatar');
        if($image != ''){
            if ($city->avatar != 'uploads/city/default.jpg') {
                if(File::exists($city->avatar)) {
                    File::delete($city->avatar);
                }
            }
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/city'), $image_name);
            $image_name = 'uploads/city/'.$image_name;
        }

        $data = $request->all();
        $data['avatar'] = $image_name;
        $city->update($data);
        return redirect('admin/city')->with('success', 'City name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packages = Package::whereCityId($id)->get();
        foreach ($packages as $key => $value) {
            Package::whereId($value->id)->update(['city_id'=>null]);
        }
        City::findOrFail($id)->delete();
        return redirect('/admin/city')->with('success','City deleted successfully.');
    }
}

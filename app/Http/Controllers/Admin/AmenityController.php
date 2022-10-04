<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = Amenity::all();
        return view('admin.amenity.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenity.create');
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string'
        ]);

        $icon = $request->file('icon');
        if($icon != ''){
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/avatar'), $icon_name);
            $icon_name = 'uploads/avatar/'.$icon_name;
        }

        $data = $request->all();
        $data['status'] = 1;
        $data['icon'] = $icon_name;
        Amenity::create($data);
        return redirect('/admin/amenities')->with('success','Amenity created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('admin.amenity.edit', compact('amenity'));
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
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_icon' => 'required|string',
            'description' => 'required|string'
        ]);

        $icon_name = $request->hidden_icon;
        $icon = $request->file('icon');
        if($icon != ''){
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/avatar'), $icon_name);
            $icon_name = 'uploads/avatar/'.$icon_name;
        }

        $amenity = Amenity::findOrFail($id);
        $data = $request->all();
        $data['icon'] = $icon_name;
        $amenity->update($data);
        return redirect('admin/amenities')->with('success', 'Amenity name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Amenity::findOrFail($id)->delete();
        return redirect('/admin/amenities')->with('success','Amenity deleted successfully.');
    }

    // Acttive Page
    public function activate($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->update(['status'=>1]);
        return redirect('/admin/amenities')->with('success', 'Amenity has been successfully activated.');
    }

    // Deactivate Page
    public function deactivate($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->update(['status'=>0]);
        return redirect('/admin/amenities')->with('success', 'Amenity has been successfully deactivated.');
    }
}

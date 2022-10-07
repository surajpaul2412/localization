<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\City;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.destinations.create', compact('cities'));
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
            'city_id' => 'required|integer',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string'
        ]);

        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
            $image_name = 'uploads/avatar/'.$image_name;
        }

        $icon = $request->file('icon');
        if($icon != ''){
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/avatar'), $icon_name);
            $icon_name = 'uploads/avatar/'.$icon_name;
        }

        $data = $request->all();
        $data['icon'] = $icon_name;
        $data['avatar'] = $image_name;
        $data['status'] = 1;
        Destination::create($data);
        return redirect('/admin/destinations')->with('success','Destination created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $cities = City::all();
        return view('admin.destinations.edit', compact('cities','destination'));
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
            'city_id' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_icon' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_avatar' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string'
        ]);

        $icon_name = $request->hidden_icon;
        $icon = $request->file('icon');
        if($icon != ''){
            $icon_name = rand() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/avatar'), $icon_name);
            $icon_name = 'uploads/avatar/'.$icon_name;
        }

        $image_name = $request->hidden_avatar;
        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
            $image_name = 'uploads/avatar/'.$image_name;
        }

        $destination = Destination::findOrFail($id);
        $data = $request->all();
        $data['icon'] = $icon_name;
        $data['avatar'] = $image_name;
        $destination->update($data);
        return redirect('admin/destinations')->with('success', 'Destination name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Destination::findOrFail($id)->delete();
        return redirect('/admin/destinations')->with('success','Destination deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->update(['status'=>1]);
        return redirect('/admin/destinations')->with('success', 'Destination has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->update(['status'=>0]);
        return redirect('/admin/destinations')->with('success', 'Destination has been successfully deactivated.');
    }
}

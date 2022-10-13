<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\City;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activities.create');
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

        $data = $request->all();
        $data['avatar'] = $image_name;
        $data['status'] = 1;
        Activity::create($data);
        return redirect('/admin/activities')->with('success','Activity created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('admin.activities.edit', compact('activity'));
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_avatar' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string'
        ]);

        $image_name = $request->hidden_avatar;
        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
            $image_name = 'uploads/avatar/'.$image_name;
        }

        $activity = Activity::findOrFail($id);
        $data = $request->all();
        $data['avatar'] = $image_name;
        $activity->update($data);
        return redirect('admin/activities')->with('success', 'Activity name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        return redirect('/admin/activities')->with('success','Activity deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['status'=>1]);
        return redirect('/admin/activities')->with('success', 'Activity has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['status'=>0]);
        return redirect('/admin/activities')->with('success', 'Activity has been successfully deactivated.');
    }
}

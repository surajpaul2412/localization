<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'heading' => 'nullable|string|min:3|max:255',
            'content' => 'nullable|string|min:3|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'mobile' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = $request->file('image');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $image_name);
            $image_name = 'uploads/banners/'.$image_name;
        }

        $mobile = $request->file('mobile');
        if($mobile != ''){
            $mobile_name = rand() . '.' . $mobile->getClientOriginalExtension();
            $mobile->move(public_path('uploads/banners'), $mobile_name);
            $mobile_name = 'uploads/banners/'.$mobile_name;
        }

        $data = $request->all();
        $data['status'] = 1;
        $data['image'] = $image_name;
        $data['mobile'] = $mobile_name;
        Banner::create($data);
        return redirect('/admin/banner')->with('success','Banner created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
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
            'heading' => 'nullable|string|min:3|max:255',
            'content' => 'nullable|string|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'hidden_image'=>'required|string',
            'mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'hidden_mobile'=>'required|string'
        ]);
        $banner = Banner::findOrFail($id);

        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '') {
            if(File::exists($banner->image)) {
                File::delete($banner->image);
            }
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $image_name);
            $image_name = 'uploads/banners/'.$image_name;
        }

        $mobile_name = $request->hidden_mobile;
        $mobile = $request->file('mobile');
        if($mobile != '') {
            if(File::exists($banner->mobile)) {
                File::delete($banner->mobile);
            }
            $mobile_name = rand() . '.' . $mobile->getClientOriginalExtension();
            $mobile->move(public_path('uploads/banners'), $mobile_name);
            $mobile_name = 'uploads/banners/'.$mobile_name;
        }

        $data = $request->all();
        $data['image'] = $image_name;
        $data['mobile'] = $mobile_name;
        $banner->update($data);
        return redirect('admin/banner')->with('success', 'Banner has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image != 'uploads/banners/default-avatar.jpg') {
            if(File::exists($banner->image)) {
                File::delete($banner->image);
            }
            if(File::exists($banner->mobile)) {
                File::delete($banner->mobile);
            }
        }
        $banner->delete();
        return redirect('/admin/banner')->with('success','Banner deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['status'=>1]);
        return redirect('/admin/banner')->with('success', 'Banner has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['status'=>0]);
        return redirect('/admin/banner')->with('success', 'Banner has been successfully deactivated.');
    }
}

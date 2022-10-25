<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country' => 'required|string|min:2|max:255',
            'stars' => 'required|integer',
            'description' => 'required|string'
        ]);

        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonials'), $image_name);
            $image_name = 'uploads/testimonials/'.$image_name;
        }

        $data = $request->all();
        $data['status'] = 1;
        $data['avatar'] = $image_name??'uploads/testimonials/default.jpg';
        Testimonial::create($data);
        return redirect('/admin/testimonials')->with('success','Testimonial created successfully.');
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
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
            'hidden_avatar' => 'nullable|string',
            'country' => 'required|string|min:2|max:255',
            'stars' => 'required|integer',
            'description' => 'required|string'
        ]);
        $testimonial = Testimonial::findOrFail($id);

        // save avatar
        $image_name = $request->hidden_avatar;
        $image = $request->file('avatar');
        if($image != '') {
            if ($testimonial->avatar != 'uploads/testimonials/default.jpg') {
                if(File::exists($testimonial->avatar)) {
                    File::delete($testimonial->avatar);
                }
            }
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonials'), $image_name);
            $image_name = 'uploads/testimonials/'.$image_name;
        }

        $data = $request->all();
        $data['avatar'] = $image_name;
        $testimonial->update($data);
        return redirect('admin/testimonials')->with('success', 'Testimonial has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->avatar != 'uploads/testimonials/default.jpg') {
            if(File::exists($testimonial->avatar)) {
                File::delete($testimonial->avatar);
            }
        }
        $testimonial->delete();
        return redirect('/admin/testimonials')->with('success','Testimonial deleted successfully.');
    }

    // Acttive Page
    public function activate($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status'=>1]);
        return redirect('/admin/testimonials')->with('success', 'Testimonial has been successfully activated.');
    }

    // Deactivate Page
    public function deactivate($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status'=>0]);
        return redirect('/admin/testimonials')->with('success', 'Testimonial has been successfully deactivated.');
    }
}

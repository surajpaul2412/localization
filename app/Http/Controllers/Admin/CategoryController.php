<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $data['status'] = 1;
        $data['icon'] = $icon_name;
        $data['avatar'] = $image_name;
        Category::create($data);
        return redirect('/admin/category')->with('success','Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
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

        $category = Category::findOrFail($id);
        $data = $request->all();
        $data['icon'] = $icon_name;
        $data['avatar'] = $image_name;
        $category->update($data);
        return redirect('admin/category')->with('success', 'Category name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('/admin/category')->with('success','Category deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status'=>1]);
        return redirect('/admin/category')->with('success', 'Category has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status'=>0]);
        return redirect('/admin/category')->with('success', 'Category has been successfully deactivated.');
    }
}

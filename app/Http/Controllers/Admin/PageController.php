<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
            'slug' => 'required|string|min:2|max:255|unique:pages,slug',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_description' => 'required|string'
        ]);

        $data = $request->all();
        $data['status'] = 1;
        Page::create($data);
        return redirect('/admin/pages')->with('success','Page created successfully.');
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
        $page = Page::findOrFail($id);
        return view('admin.page.edit', compact($page));
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
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_description' => 'required|string'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return redirect('/admin/pages')->with('success','Page deleted successfully.');
    }

    // Acttive Page
    public function activate($id)
    {
        $page = Page::findOrFail($id);
        $page->update(['status'=>1]);
        return redirect('/admin/pages')->with('success', 'Page has been successfully activated.');
    }

    // Deactivate Page
    public function deactivate($id)
    {
        $page = Page::findOrFail($id);
        $page->update(['status'=>0]);
        return redirect('/admin/pages')->with('success', 'Page has been successfully deactivated.');
    }
}

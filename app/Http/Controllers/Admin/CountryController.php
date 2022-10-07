<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country::all();
        return view('admin.country.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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
            'name' => 'required|string|min:3|max:255'
        ]);

        $data = $request->all();
        $data['status'] = 1;
        Country::create($data);
        return redirect('/admin/country')->with('success','Country created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
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
            'name' => 'required|string|min:3|max:255'
        ]);

        $country = Country::findOrFail($id);
        $data = $request->all();
        $country->update($data);
        return redirect('admin/country')->with('success', 'Country name has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::findOrFail($id)->delete();
        return redirect('/admin/country')->with('success','Country deleted successfully.');
    }

    // Acttive
    public function activate($id)
    {
        $country = Country::findOrFail($id);
        $country->update(['status'=>1]);
        return redirect('/admin/country')->with('success', 'Country has been successfully activated.');
    }

    // Deactivate
    public function deactivate($id)
    {
        $country = Country::findOrFail($id);
        $country->update(['status'=>0]);
        return redirect('/admin/country')->with('success', 'Country has been successfully deactivated.');
    }
}

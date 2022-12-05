<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = UserAddress::whereUserId(Auth::user()->id)->get();
        return view('customer.address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.address.create');
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
            'default' => 'nullable',
            'country' => 'required|string|min:2|max:255',
            'city' => 'required|min:3|string|max:255',
            'pincode' => 'required|min:3',
            'address' => 'required|string'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['default'] = $request->default??0;
        UserAddress::create($data);
        return redirect('/customer/address')->with('success','Address added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = UserAddress::findOrFail($id);
        return view('customer.address.edit', compact('address'));
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
            'default' => 'nullable',
            'country' => 'required|string|min:2|max:255',
            'city' => 'required|min:3|string|max:255',
            'pincode' => 'required|min:3',
            'address' => 'required|string'
        ]);

        $address = UserAddress::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['default'] = $request->default??0;
        $address->update($data);
        return redirect('customer/address')->with('success', 'Address has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserAddress::findOrFail($id)->delete();
        return redirect('/customer/address')->with('success','Address deleted successfully.');
    }

    // Default
    public function default($id)
    {
        $allAddress = UserAddress::whereUserId(Auth::user()->id)->get();
        foreach ($allAddress as $key => $value) {
            $valAdd = UserAddress::findOrFail($value->id);
            $valAdd->update(['default'=>0]);
        }
        $address = UserAddress::findOrFail($id);
        $address->update(['default'=>1]);
        return redirect('/customer/address')->with('success', 'Default address updated.');
    }
}

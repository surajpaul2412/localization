<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        $users = User::where('role_id','!=',1)->get();
        return view('admin.user.index', compact('users'));
    }

    // Activate User
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status'=>1]);
        return redirect('/admin/users')->with('success', 'Your user has been successfully activated.');
    }

    // Deactivate User
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status'=>0]);
        return redirect('/admin/users')->with('success', 'Your user has been successfully deactivated.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
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
            'email' => 'required|email|min:3|max:255',
            'mobile' => 'required',
            'avatar'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hidden_avatar'=> 'nullable|string',
            'dob'=> 'nullable|date_format:Y-m-d|before:today',
            'gender'=> 'nullable|in:male,female',
            'status'=>'nullable',
            'password'=>'nullable',
        ]);

        // dd($request->all());

        // save avatar
        $image_name = $request->hidden_avatar;
        $image = $request->file('avatar');
        if($image != ''){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar'), $image_name);
            $image_name = 'uploads/avatar/'.$image_name;
        }

        if (empty($request->dob)) {
            $request['dob'] = User::findOrFail($id)->dob;
        }
        if (empty($request->gender)) {
            $request['gender'] = User::findOrFail($id)->gender;
        }
        if (empty($request->status)) {
            $request['status'] = User::findOrFail($id)->status;
        }

        if ($request->password) {
            dd("pass check");
        }
        
        User::whereId($id)->update(['name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile,'avatar'=>$image_name,'dob'=>$request->dob,'gender'=>$request->gender,'status'=>$request->status]);
        return redirect()->back()->with('success', 'User profile has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

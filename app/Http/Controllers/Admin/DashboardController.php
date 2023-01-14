<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexLang()
    {
        $setting = Setting::all();
        return view('admin.language', compact('setting'));
    }

    public function updateLang(Request $req)
    {
        Setting::findOrFail(1)->update(['language'=>$req->language]);
        return redirect('/admin/language')->with('success','Language Updated successfully.');
    }
    
    public function indexCurr()
    {
        $setting = Setting::all();
        return view('admin.currency', compact('setting'));
    }

    public function updateCurr(Request $req)
    {
        Setting::findOrFail(1)->update(['currency'=>$req->currency]);
        return redirect('/admin/currency')->with('success','Currency Updated successfully.');
    }

    
}

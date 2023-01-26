<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Newsletter;
use App\Models\Currency;
use App\Models\language;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexLang()
    {
        $languages = language::all();
        return view('admin.language', compact('languages'));
    }

    public function subscribers()
    {
        $subscribers = Newsletter::all();
        return view('admin.subscribers', compact('subscribers'));
    }

    // Curr default
    public function langdefault($id)
    {
        DB::table('languages')->update(array('default' => 0));
        $language = Language::findOrFail($id);
        $language->update(['default'=>1]);
        return redirect('/admin/language')->with('success', 'Language has been successfully set default.');
    }

    // Acttive Page
    public function langactivate($id)
    {
        $language = Language::findOrFail($id);
        $language->update(['status'=>1]);
        return redirect('/admin/language')->with('success', 'Language has been successfully activated.');
    }

    // Deactivate Page
    public function langdeactivate($id)
    {
        $language = Language::findOrFail($id);
        $language->update(['status'=>0]);
        return redirect('/admin/language')->with('success', 'Language has been successfully deactivated.');
    }

    public function indexCurr()
    {
        $currency = Currency::all();
        return view('admin.currency', compact('currency'));
    }

    // Curr default
    public function default($id)
    {
        DB::table('currencies')->update(array('default' => 0));
        $currency = Currency::findOrFail($id);
        $currency->update(['default'=>1]);
        return redirect('/admin/currency')->with('success', 'Currency has been successfully set default.');
    }

    // Acttive Page
    public function activate($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->update(['status'=>1]);
        return redirect('/admin/currency')->with('success', 'Currency has been successfully activated.');
    }

    // Deactivate Page
    public function deactivate($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->update(['status'=>0]);
        return redirect('/admin/currency')->with('success', 'Currency has been successfully deactivated.');
    }
}

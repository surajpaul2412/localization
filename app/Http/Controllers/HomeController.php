<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function newsletter(Request $req) {
        $req->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $data = $req->all();
        Newsletter::create($data);
        return redirect(url()->previous().'#newsletter');
    }
}

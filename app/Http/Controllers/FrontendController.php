<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Package;

class FrontendController extends Controller
{
    public function tour() {
        return view('frontend.tour');
    }

    public function tourShow($id) {
        $tour = Package::findOrFail($id);
        return view('frontend.tour-details', compact('tour'));
    }
}

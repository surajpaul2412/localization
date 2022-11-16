<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Package;
use App\Models\City;

class FrontendController extends Controller
{
    public function tour() {
        return view('frontend.tour');
    }

    public function tourShow($slug) {
        $tour = Package::whereSlug($slug)->first();
        return view('frontend.tour-details', compact('tour'));
    }

    public function search(Request $request) {
        // $tours = Package::
        $query = Package::query();
        if (request('search')) {
            $query
                ->where('name', 'like', '%' . request('search') . '%')
                ->whereStatus(1);
        }
        $tours = $query->withQueryString();
        dd($tours);
        return view('frontend.tour-search', compact('tours'));
    }
}

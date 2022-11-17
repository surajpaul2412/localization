<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $search = $request->search;
        $tours = [];
        if ($search) {
            $tours = Package::whereStatus(1)
                    ->where('name', 'like', '%' . request('search') . '%')
                    ->orWhereHas('city', function($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                            ->orWhereHas('country', function($q1) {
                            $q1->where('name', 'like', '%' . request('search') . '%')
                               ->whereStatus(1);
                        });
                    })->get();
        }
        return view('frontend.tour-search', compact('tours','search'));
    }
}

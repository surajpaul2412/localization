<?php

namespace App\Http\Livewire;
use Auth;
use DB;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $data = 0;
        if (Auth::user()) {
            $data = DB::table('carts')->whereUserId(Auth::user()->id)->count();
            return view('livewire.cart', ['data'=>$data]);
        }
        return view('livewire.cart', ['data'=>$data]);
    }
}

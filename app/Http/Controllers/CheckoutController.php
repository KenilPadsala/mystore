<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // Your logic here
        $cities = City::all();
        $states = State::all();
        return view('checkout', compact('cities', 'states'));
    }
}

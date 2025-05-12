<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $user_carts = auth()->user()->carts;
        $total_price = auth()->user()->total_cart_value;
        $cities = City::all();
        $states = State::all();
        $user_addresses = $user->addresses;
        return view('checkout', compact('total_price', 'user_carts','user_addresses','cities', 'states'));
    }
}

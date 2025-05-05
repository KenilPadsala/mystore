<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        UserCart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'quantity' => 1,
        ]);

        return redirect()->route('home')->with('success', 'Product added to cart successfully');
    }
    function getCart()
    {


        $products = Product::orderByDesc('id')->paginate(10);
        $total = Product::count();

        return response()->json([
            'status' => true,
            'message' => 'Product list retrieved successfully',
            'data' => $products
        ]);

    }


}

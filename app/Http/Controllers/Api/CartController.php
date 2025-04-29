<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    function addToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->name,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['status' => true, 'message' => 'Product added to cart successfully', 'data' => $cart]);
    }

    function getCart(){


        $products = Product::orderByDesc('id')->paginate(10);  
        $total = Product::count();

        return response()->json([
            'status' => true,
            'message' => 'Product list retrieved successfully',
            'data' => $products
        ]);

    }


}

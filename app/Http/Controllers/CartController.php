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
        $userId = auth()->user()->id;

        // Check if the product already exists in the user's cart
        $cartItem = UserCart::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            // If it exists, increment the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If it does not exist, create a new entry
            UserCart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function removeFromCart(Request $request, $id)
    {
        $userId = auth()->user()->id;

        // Check if the product exists in the user's cart
        $cartItem = UserCart::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            // If quantity is greater than 1, decrement it
            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
                $cartItem->save();
            } else {
                // If quantity is 1 or less, remove the item from cart
                $cartItem->delete();
            }

            return redirect()->back()->with('success', 'Product removed from cart successfully');
        }

        return redirect()->back()->with('error', 'Product not found in cart');
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

    function carts()
    {
        $carts = auth()->user()->carts()->with('product')->get();
        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->quantity;
        }
        return view('carts', compact('carts', 'total_price'));
    }
}

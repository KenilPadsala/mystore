<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        // $product = Product::find(56);

        // dd($product->in_stock);

        dd(auth()->user()->carts->sum('quantity') ?? 0);
    }
}

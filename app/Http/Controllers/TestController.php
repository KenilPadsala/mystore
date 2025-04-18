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
        $product = Product::find(5053);
        // dd($product->category->name);

        // $category = Category::find(3);

        // foreach ($category->products as $product) {
        //     echo $product->name . "<br>";
        //     echo $product->category->name . "<br>";
        //     echo $product->price . "<br>";
        //     echo $product->description . "<br>";
        //     echo $product->stock . "<br>";
        // }

        $categories = Category::all();
        foreach ($categories as $category) {
            echo $category->name . "<br>";
            echo "---------------------------------------------------";
            echo "<br>";
            foreach ($category->products as $product) {
                echo $product->name . "<br>";
                echo $product->price . "<br>";
                echo $product->description . "<br>";
                echo $product->stock . "<br>";
            }

            echo "<br>";
            echo "---------------------------------------------------";
            echo "<br>";
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function home(Request $request)
    {
        $category = $request->input('category');

        if($category) {
            $products = Product::where('category_id', $category)->paginate(20);
        } else {
            $products = Product::paginate(20);
        }

        $categories = Category::all();
        return view('home', ['products' => $products, 'categories' => $categories]);
    }

    function list()
    {
        return view("users.list");
    }

    function add()
    {
        return view("users.add");
    }

    function update()
    {

    }

    function delete()
    {

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function home()
    {
        $products = Product::paginate(20);
        return view('home', ['products' => $products]);
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

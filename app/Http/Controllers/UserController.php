<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function home()
    {
        return view('home');
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

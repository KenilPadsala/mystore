<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
            } else {
                return redirect()->route('home')->with('success', 'Logged in successfully.');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegisterForm()
    {

        if (Auth::check()) {
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}

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
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials.',
                ], 401);
            }
    
            return back()->withErrors(['email' => 'Invalid Credentials.']);
        }
    
        $user = Auth::user();
    
        if ($request->wantsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully.',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ]);
        }
    
        // Normal web redirect
        $redirect = $user->role === 'admin' ? route('admin.dashboard') : route('home');
    
        return redirect()->to($redirect)->with('success', 'Logged in successfully.');
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

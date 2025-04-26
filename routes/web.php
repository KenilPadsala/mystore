<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;    
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;   

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/test', TestController::class);

Route::prefix('admin')->middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::resource('products', ProductController::class); //resource
    Route::resource('categories', CategoryController::class); //resource
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'checkRole:user'])->group(function () {

    Route::get("home", [UserController::class, 'home'])->name('home')->middleware('auth');
    
});

Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
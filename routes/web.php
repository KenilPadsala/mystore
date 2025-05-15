<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;    
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/test', TestController::class);

Route::prefix('admin')->middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::resource('products', ProductController::class); //resource
    Route::resource('categories', CategoryController::class); //resource
    Route::resource('orders', OrderController::class)->names('admin.orders');
    Route::get('/orders', [OrderController::class, 'orders'])->name('admin.orders');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'checkRole:user'])->group(function () {

    Route::get("home", [UserController::class, 'home'])->name('home')->middleware('auth');
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-to-cart');
    Route::get('carts', [CartController::class, 'carts'])->name('carts');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/new-order', [OrderController::class, 'newOrder'])->name('new-order');
    Route::post('addresses', [UserAddressController::class, 'store']);
    Route::get('remove-address/{id}', action: [UserAddressController::class, 'remove'])->name('remove-address');
    Route::get('order', [OrderController::class, 'order'])->name('order');
    Route::get('my-orders', [OrderController::class, 'myOrders'])->name('my-orders');
});



// Forgot password form
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Send reset email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset password form
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Update password
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
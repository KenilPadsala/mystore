<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\UserCart;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $orders = Order::with("items.product")->all();
    return view('admin.orders.index', compact('orders'));
}

public function newOrder(Request $request)
{
    $user = auth()->user();

    // Check if a new address is being added
    if ($request->filled('full_name') && $request->filled('address1')) {
        $validatedAddress = $request->validate([
            'full_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'area' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15',
        ]);

        $newAddress = UserAddress::create(array_merge($validatedAddress, [
            'user_id' => $user->id,
        ]));

        $addressId = $newAddress->id;
    } else {
        $request->validate([
            'address' => 'required|exists:user_addresses,id',
        ]);

        $addressId = $request->address;
    }

    // Calculate the total price
    $total_price = $user->carts->sum(function ($cart) {
        return $cart->product->price * $cart->quantity;
    });

    // Create the order
    $order = Order::create([
        'user_id' => $user->id,
        'address_id' => $addressId,
        'total_amount' => $total_price,
    ]);

    // Create order items
    foreach ($user->carts as $cart) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'price' => $cart->product->price,
        ]);
    }

    // Clear the user's cart
    UserCart::where('user_id', $user->id)->delete();

    // Send order notification
    $user->notify(new OrderNotification($order));

    return redirect()->route('my-orders')->with('success', 'Order placed successfully!');
}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

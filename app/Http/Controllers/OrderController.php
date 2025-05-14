<?php

namespace App\Http\Controllers;

use App\Models\Order_List;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\OrderItem;
use App\Models\UserAddress;

class OrderController extends Controller
{
    function newOrder(Request $request)
    {
        $user = auth()->user();

        // Check if a new address is being added
        if ($request->filled('full_name') && $request->filled('address1')) {
            // Validate the new address fields
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

            // Create a new address
            $newAddress = UserAddress::create(array_merge($validatedAddress, [
                'user_id' => $user->id,
            ]));

            $addressId = $newAddress->id;
        } else {
            // Validate the selected address
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

        // $user->notify(OrderNotification::class);

        // Clear the user's cart
        UserCart::where('user_id', $user->id)->delete();
        $user->notify(new OrderNotification($order));
        return redirect()->route('my-orders')->with('success', 'Order placed successfully!');
    }

    public function myOrders()
    {
        $user = auth()->user();
        $orders = $user->orders()->orderByDesc('id')->with('items.product')->paginate(20);

        // dd($orders);

        return view('orders', compact('orders'));

    }

    public function orders()
    {
        $orders = Order::paginate(10);
        return view('admin.orders', compact('orders'));
    }



}

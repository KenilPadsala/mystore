<?php

namespace App\Http\Controllers;

use App\Models\Order_List;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // List all orders for the authenticated user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('items')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // Place an order from user's cart
    public function store(Request $request)
    {
        $user = auth()->user();
        $cartItems = UserCart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            // Calculate total amount
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            // Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => strtoupper(Str::random(10)),
                'status' => 'pending',
                'total_amount' => $total,
                'shipping_address' => $request->input('shipping_address'),
                'payment_status' => 'pending',
                'payment_method' => $request->input('payment_method', 'cash'),
                'placed_at' => now(),
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                Order_List::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'total' => $item->product->price * $item->quantity,
                ]);
            }

            // Clear user's cart
            UserCart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    // View a single order
    public function show($id)
    {
        $order = Order::with('items')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('orders.show', compact('order'));
    }
}

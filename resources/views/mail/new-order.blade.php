<x-mail-layout title="Order Confirmation">
    <p>Thank you for your order!</p>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>

    <h3>Order Items</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px;">
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p style="text-align: right; font-weight: bold; margin-top: 20px;">
        Total Amount: ₹{{ number_format($order->total_amount, 2) }}
    </p>
</x-mail-layout>
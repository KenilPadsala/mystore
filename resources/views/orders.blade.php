<x-app-layout>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="mb-4 text-center">My Orders</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                You have no orders yet.
            </div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Items</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($order->items as $item)
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>₹{{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
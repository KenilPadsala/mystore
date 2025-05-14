<x-admin-layout>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4 text-center">Orders</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                No orders found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Order Items</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    <strong>{{ $order->user->name }}</strong><br>
                                    <small>{{ $order->user->email }}</small>
                                </td>
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
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                @if($orders->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif
                    @if($orders->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">Next</a></li>
                    @endif
            </div>
        @endif
    </div>
</x-admin-layout>
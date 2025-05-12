<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @if($carts->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No items in the cart</td>
                        </tr>

                    @else

                    @foreach ($carts as $item)
                        <tr>
                            <td> <img width="60" class="rounded" src="{{ $item->product->image_url }}" alt="">
                                {{ $item->product->name }}</td>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('remove-to-cart', ['id' => $item->product->id]) }}"> - </a>
                                {{ $item->quantity }}
                                <a class="btn btn-primary" href="{{ route('add-to-cart', ['id' => $item->product->id]) }}">
                                    + </a>
                            </td>

                            <td>
                                ₹{{ $item->product->good_price }}
                            </td>
                            <td>
                                ₹{{ number_format($item->product->price * $item->quantity) }}
                            </td>


                        </tr>


                    @endforeach

                    <tr>
                        <td>Total </td>
                        <td> </td>
                        <td> </td>
                        <td> ₹{{ number_format($total_price) }} </td>
                    </tr>
                    <tr>
                        <td>Checkout </td>
                        <td> </td>
                        <td> </td>
                        <td> <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a> </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
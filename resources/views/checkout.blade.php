<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Checkout</h2>

        <!-- Note about payment method -->
        <div class="alert alert-info text-center">
            <strong>Note:</strong> We are currently processing <strong>Cash on Delivery (COD)</strong> orders as the
            payment method.
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('new-order') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Left Section: Addresses -->
                <div class="col-md-8">
                    <!-- Existing Addresses -->
                    <h4>Select an Existing Address</h4>
                    @if ($user_addresses->isEmpty())
                        <p>No saved addresses. Please add a new address below.</p>
                    @else
                        @foreach ($user_addresses as $address)
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address"
                                                id="address_{{ $address->id }}" value="{{ $address->id }}">
                                            <label class="form-check-label" for="address_{{ $address->id }}">
                                                <strong>{{ $address->full_name }}</strong><br>
                                                {{ $address->address1 }}, {{ $address->address2 }}<br>
                                                {{ $address->area }}, {{ $address->city }}, {{ $address->state }}<br>
                                                Pincode: {{ $address->pincode }}<br>
                                                Mobile: {{ $address->mobile_no }}
                                            </label>
                                        </div>
                                    </div>
                                    <div>

                                        <a href="{{ url('remove-address/' . $address->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to remove this address?');">x</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- New Address Form -->
                    <h4 class="mt-4">Add a New Address</h4>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="a_fullname" name="full_name"
                                        placeholder="Enter your full name">
                                </div>

                                <!-- Mobile Number -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_mobile_number" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="a_mobile_number" name="mobile_no"
                                        placeholder="Enter your mobile number">
                                </div>

                                <!-- Address Line 1 -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_address1" class="form-label">Address Line 1</label>
                                    <input type="text" class="form-control" id="a_address1" name="address1"
                                        placeholder="Enter your address line 1">
                                </div>

                                <!-- Address Line 2 -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_address2" class="form-label">Address Line 2</label>
                                    <input type="text" class="form-control" id="a_address2" name="address2"
                                        placeholder="Enter your address line 2">
                                </div>

                                <!-- Area -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_area" class="form-label">Area</label>
                                    <input type="text" class="form-control" id="a_area" name="area"
                                        placeholder="Enter your area">
                                </div>

                                <!-- Pincode -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_pincode" class="form-label">Pincode</label>
                                    <input type="text" class="form-control" id="a_pincode" name="pincode"
                                        placeholder="Enter your pincode">
                                </div>

                                <!-- Landmark -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_landmark" class="form-label">Landmark</label>
                                    <input type="text" class="form-control" id="a_landmark" name="landmark"
                                        placeholder="Enter a landmark">
                                </div>

                                <!-- City -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="a_city" name="city"
                                        placeholder="Enter your city">
                                </div>

                                <!-- State -->
                                <div class="col-md-6 mb-3">
                                    <label for="a_state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="a_state" name="state"
                                        placeholder="Enter your state">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Order Summary -->
                <div class="col-md-4">
                    <h4>Order Summary</h4>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group mb-3">
                                @foreach ($user_carts as $cart)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $cart->product->image_url }}" alt="{{ $cart->product->name }}"
                                                class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                            {{ $cart->product->name }} (x{{ $cart->quantity }})
                                        </div>
                                        <span>₹{{ number_format($cart->product->price * $cart->quantity, 2) }}</span>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Total</strong>
                                    <strong>₹{{ number_format($total_price, 2) }}</strong>
                                </li>
                            </ul>
                            <button type="submit" class="btn btn-primary w-100">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
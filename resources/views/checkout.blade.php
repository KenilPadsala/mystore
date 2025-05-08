<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Checkout</h2>
        <div class="row">
            <div class="col-md-8 mb-4">
                <form action="/addresses" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label for="a_fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="a_fullname" name="full_name"
                                placeholder="Enter your full name" required>
                        </div>

                        <!-- Address Line 1 -->
                        <div class="col-md-6 mb-3">
                            <label for="a_address1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="a_address1" name="address1"
                                placeholder="Enter your address line 1" required>
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
                                placeholder="Enter your area" required>
                        </div>

                        <!-- Pincode -->
                        <div class="col-md-6 mb-3">
                            <label for="a_pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="a_pincode" name="pincode"
                                placeholder="Enter your pincode" required>
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
                            <select class="form-select" name="city" id="">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                         

                        </div>

                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="a_state" class="form-label">State</label>
                            <select  class="form-select" name="state" id="">
                                <option value="">Select State</option>
                                @foreach ($states as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mobile Number -->
                        <div class="col-md-6 mb-3">
                            <label for="a_mobile_number" class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" id="a_mobile_number" name="mobile_no"
                                placeholder="Enter your mobile number" required>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Summary</h5>
                        <p>Total Item: {{ auth()->user()->carts->sum('quantity') }} </p>
                        <p>Total Amount: {{number_format(auth()->user()->total_cart_value)  }} </p>
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-app-layout>
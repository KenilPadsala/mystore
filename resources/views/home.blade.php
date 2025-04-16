<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="py-5">
        <div class="container px-4 mt-5">
            <div class="row gx-4 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                @foreach ($products as $product)  
                <div class="col-md-12 mb-5">
                    <div class="card h-100 w-100" style="box-shadow: 0 3px 20px rgba(0,0,0,.102); ">
                        <!-- Product image-->
                        <img class="card-img-top" name="image" src="{{ asset('storage/' . $product->image) }}" alt=""></td>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder" name="name">{{$product->name}}</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <div class="fw-bolder" name="price">₹{{ $product->price }}</div>

                                <!-- Product description-->
                                <!-- <div class="fw-bolder" name="description">{{ $product->description }} Kg</div> -->
                                <!-- Product stock-->
                                <!-- <div class="fw-bolder" name="stock">{{ $product->stock }} Kgs</div> -->
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" style="box-shadow: 0 3px 20px rgba(0,0,0,.133);" name="description" href="#">ADD TO CART </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>

</x-app-layout>
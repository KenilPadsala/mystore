<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('home')}}"> All </a>
                    </li>

                    @foreach ($categories as $category)

                        <li class=" nav-item">
                                <a class="nav-link" aria-current="page"
                                    href="{{route('home')}}?category={{ $category->id }}"> {{ $category->name }}</a>
                        </li>

                    @endforeach

                </ul>

            </div>
        </div>
    </nav>
    <section class="py-5">
        <div class="container px-4 mt-5">
            <div class="row gx-4 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @foreach ($products as $product)
                    <div class="col-md-12 mb-5">
                        <div class="card h-100 w-100" style="box-shadow: 0 3px 20px rgba(0,0,0,.102); ">
                            <!-- Product image-->
                            <img class="card-img-top" name="image" src="{{ $product->image_url }}" alt="">
                            </td>
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
                                <div class="text-center">
                                    @if($product->stock > 0)
                                    <a href="{{ route('add-to-cart', ['id' => $product->id]) }}" class="btn btn-outline-dark mt-auto"
                                        style="box-shadow: 0 3px 20px rgba(0,0,0,.133); transition: all .4s ease-in-out; transform: perspective(1000px);" name="description" href="#">ADD TO
                                        CART </a>
                                        @else
                                        <a class="btn btn-outline-dark mt-auto"
                                        style="box-shadow: 0 3px 20px rgba(0,0,0,.133); transition: all .4s ease-in-out; transform: perspective(1000px);"  href="#"> Out Of Stock </a>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                   
                @endforeach
                <ul class="pagination">
                    @if($products->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                    </li>
                    @endif 
                    @if($products->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

</x-app-layout>
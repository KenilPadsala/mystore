<x-app-layout>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


<ul class="nav nav-pills justify-content-center mb-4 overflow-auto flex-nowrap" style="white-space: nowrap;">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">All</a>
    </li>
    @foreach ($categories as $category)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}?category={{ $category->id }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
    
    <section class="py-5">
        <div class="container px-4 mt-5">
            <div class="row gx-4 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">

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
                                        <a href="{{ route('add-to-cart', ['id' => $product->id]) }}"
                                            class="btn btn-outline-dark mt-auto"
                                            style="box-shadow: 0 3px 20px rgba(0,0,0,.133); transition: all .4s ease-in-out; transform: perspective(1000px);"
                                            name="description" href="#">ADD TO
                                            CART </a>
                                    @else
                                        <a class="btn btn-outline-dark mt-auto"
                                            style="box-shadow: 0 3px 20px rgba(0,0,0,.133); transition: all .4s ease-in-out; transform: perspective(1000px);"
                                            href="#"> Out Of Stock </a>
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
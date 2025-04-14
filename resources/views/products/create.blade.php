<x-admin-layout title="Create Products">

    <!-- <img src="{{asset('images/123.jpg')}}" alt="" width="400px"> -->

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 mx-auto">

                <h2>Add Product</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route("products.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name">
                    </div>

                    <div class="form-group mb-2">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                    </div>

                    <div class="form-group mb-2">
                        <label for="price">Product Price</label>
                        <input type="number" name="price" class="form-control" id="price"
                            placeholder="Enter Product Price">
                    </div>

                    <div class="form-group mb-2">
                        <label for="description">Product Description</label>
                        <input type="text" name="description" class="form-control" id="description"
                            placeholder="Enter Product Description">
                    </div>

                    <div class="form-group mb-2">
                        <label for="stock">Product Stock</label>
                        <input type="text" name="stock" class="form-control" id="stock"
                            placeholder="Enter Product Stock">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>

<x-admin-layout title="Edit Products">

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route("products.update", $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-2">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}"
                            placeholder="Enter product Name">
                    </div>

                    <!-- <div class="form-group mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" width="200" height="200">
                    </div> -->
                    <!-- <div class="form-group mb-2">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                    </div> -->

                    <div class="form-group mb-2">
                        <label for="image">Product Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}"
                            placeholder="Enter product Price">
                    </div>

                    <div class="form-group mb-2">
                        <label for="image">Product Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{ $product->description }}"
                            placeholder="Enter product Description">
                    </div>

                    <div class="form-group mb-2">
                        <label for="image">Product Stock</label>
                        <input type="text" name="stock" class="form-control" id="stock" value="{{ $product->stock }}"
                            placeholder="Enter product Stock">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
<x-admin-layout title="Edit Categories">


    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 mx-auto">
                <h2>Edit Category</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route("categories.update", $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-2">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}"
                            placeholder="Enter Category Name">

                    </div>

                    <div class="form-group mb-2">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="" width="200" height="200">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
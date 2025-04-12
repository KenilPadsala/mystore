<x-admin-layout title="Create Categories">

    <!-- <img src="{{asset('images/123.jpg')}}" alt="" width="400px"> -->

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 mx-auto">

                <h2>Add Category</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route("categories.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name">
                        
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>

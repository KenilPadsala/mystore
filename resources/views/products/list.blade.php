<x-admin-layout>

   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
         Products
      </h1>
      <a href="{{ route('products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
         Add New product
      </a>

   </div>

   <div class="container">


      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
     @endif

      <table class="table">
         <thead>
            <tr>
               <th scope="col">ID</th>
               <th scope="col">Name</th>
               <th scope="col">Image</th>
               <th scope="col">Price</th>
               <th scope="col">Description</th>
               <th scope="col">Stock</th>
               <th scope="col">Created Date</th>
               <th scope="col">Updated Date</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($products as $key => $product)
            <tr>
               <th scope="row">{{$page*$products->count()-$products->count()+$key+1}}</th>
               <td>{{$product->name}}</td>
               <td><img src="{{ asset('storage/' . $product->image) }}" alt="" width="100" height="100"></td>
               <td>{{$product->price}}</td>
               <td>{{$product->description}}Kg</td>
               <td>{{$product->stock}}Kgs</td>
               <td>{{ $product->created_at }}</td>
               <td>{{ $product->updated_at }}</td>
               <td class="d-flex" style="height: 55px;">
                 <a class="btn btn-info me-2 " href="{{ route('products.edit', $product->id) }}">Edit</a>

                 <form action="{{ route('products.destroy', $product->id) }}" method="post">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-danger">Delete</button>
                 </form>
               </td>
            </tr>
         @endforeach

         </tbody>


         
      </table>
      <ul class="pagination">
            <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a></li>
            <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a></li>
         </ul>
   </div>
</x-admin-layout>
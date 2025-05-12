<x-admin-layout>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
      Categories
    </h1>
    <a href="{{ route('categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      Add New Category
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
          <th scope="col">Number of Products</th>
          <th scope="col">Created Date</th>
          <th scope="col">Updated Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $key => $category)
      <tr>
        <th scope="row">{{$key + 1}}</th>
        <td>{{$category->name}}</td>
        <td>{{$category->products->count()}}</td>
        <td>{{ $category->created_at }}</td>
        <td>{{ $category->updated_at }}</td>
        <td class="d-flex">
        <a class="btn btn-info me-2" href="{{ route('categories.edit', $category->id) }}">Edit</a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </td>
        <td>

        </td>
      </tr>
    @endforeach

      </tbody>
    </table>
  </div>
</x-admin-layout>
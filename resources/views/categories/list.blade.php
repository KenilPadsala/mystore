<x-admin-layout>

  <div class="container">
    <div class="row my-3">
      <div class="col-md-4">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('categories.create') }}">
          Add New Category</a>
      </div>
    </div>

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
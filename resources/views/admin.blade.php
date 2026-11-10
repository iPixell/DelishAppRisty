<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
  </head>
  <body>
    @include('template.nav')
    <div class="container pt-5">
      
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold m-0">Product List</h3>
        <a class="btn btn-success" href="{{ route('add') }}">Add new product +</a>
      </div>
      <table class="table table-striped table-hover table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Image</th>
          <th class="text-center">Name</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td class="text-center"><img src="{{ asset('storage/'.$item->img) }}" width=65></td>
          <td class="text-center">{{ $item->name }}</td>
          <td class="text-center">{{ $item->price }}</td>
          <td class="text-center">{{ $item->qty }}</td>
          <td class="d-flex justify-content-center gap-2">
                            <form action="{{ route('delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE') <!-- Atau sesuaikan jika pakai POST biasa -->
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-warning" href="{{ route('edit', $item->id) }}">Edit</a>
                        </td>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
      {{ $data->links() }}
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
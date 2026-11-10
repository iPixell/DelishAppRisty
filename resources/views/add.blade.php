<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
  </head>
  <body class="d-flex justify-content-center align-items-center min-vh-100">
    <form class="form-group card p-5 rounded-4" action="{{ route('postadd') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="fw-bold text-center mb-4">Add Product</h3>
      <div class="mb-3">
        <label class="fw-bold">Product Name</label>
        <input type="text" name="name" class="form-control border-dark" />
      </div>
      <div class="mb-3">
        <label class="fw-bold">Price</label>
        <input type="number" name="price" class="form-control border-dark" />
      </div>
      <div class="mb-3">
        <label class="fw-bold">Quantity</label>
        <input type="number" name="qty" class="form-control border-dark" />
      </div>
      <div class="mb-3">
        <label class="fw-bold">Image</label>
        <input type="file" name="img" class="form-control border-dark" />
      </div>
       <div class="mb-3">
         <label class="">Category</label>
         <select class="form-control border-dark" name="category_id">
           @foreach ($category as $c)
            <option value="{{ $c->id }}">{{ $c->name }} </option>
           @endforeach
         </select>
       </div>
      <button type="submit" class="btn btn-primary">Add</button>
      <a class="btn btn-secondary mt-3" href="{{ route('admin') }}">Cancel</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
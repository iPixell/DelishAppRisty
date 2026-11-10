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
   <div class="container mt-5">
  <h5>Cart</h5>
  <hr>

  <form action="{{ route('checkout') }}" method="POST">
    @csrf

    @foreach ($data as $item)
      <div class="card mt-3">
        <div class="row">
          <div class="col-2 p-4">
            <img src="{{ asset('storage/'.$item->img) }}" class="img-thumbnail">
          </div>
          <div class="col-8">
            <div class="card-body">
              <h3>{{ $item->name }}</h3>
              <p>Price: Rp{{ number_format($item->price) }}</p>

              <input type="number" name="qty[{{ $item->id }}]" class="form-control"
                value="{{ $item->jumlah }}" min="1">

              <p class="text-success mt-2">Subtotal: Rp{{ number_format($item->subtotal) }}</p>
              <a href="{{ route('removecart', $item->id) }}" class="btn btn-danger">Remove</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <h5 class="mt-3">Total: Rp{{ number_format($total) }}</h5>
    <button type="submit" class="btn btn-primary mt-2">Checkout</button>
  </form>
   </div>
  </body>
</html>
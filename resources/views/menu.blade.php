<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Menu</title>
  </head>
  <body>
    @include('template.nav')
    <div class="container">
      <div class="row">
        @foreach ($data as $item)
        <div class="col-3 mt-5">
          <div class="card p-3">
            <img class="card-img-top" src="{{ asset('storage/'.$item->img) }}" />
            <div class="card-body">
              <h4 class="card-title fw-bold">{{ $item->name }}</h4>
              <p class="card-text">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
            </div>
            <form action="{{ route('addcart') }}" method="POST">
              @csrf
              <input type="hidden" name="menu_id" value="{{ $item->id }}">
              <button class="btn btn-primary">Add to Cart</button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </body>
</html>
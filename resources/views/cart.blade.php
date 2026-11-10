<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  @include('template.nav')
  <div class="container mt-5">
    <h5>Cart</h5>
    <hr />
    @if(session('status'))
      <div class="alert alert-danger">{{ session('status') }}</div>
    @endif
    <form action="{{ route('checkout') }}" method="POST">
      @csrf
      @foreach ($data as $item)
      <div class="card mt-3 p-3">
        <div class="d-flex gap-3 align-items-center">
          <img src="{{ asset('storage/'.$item->img) }}" class="img-thumbnail" style="width: 120px" />
          <div>
            <h3>{{ $item->name }}</h3>
            <p>Price: Rp{{ number_format($item->price) }}</p>
            <input type="number" name="qty[{{ $item->id }}]" class="form-control" value="{{ $item->jumlah }}" min="1" />
            <p class="text-success mt-2">Subtotal: Rp{{ number_format($item->subtotal) }}</p>
            <a href="{{ route('removecart', $item->id) }}" class="btn btn-danger">Remove</a>
          </div>
        </div>
      </div>
      @endforeach
      @if($data->isNotEmpty())
        <h5 class="mt-3">Total: Rp{{ number_format($total) }}</h5>
        <select name="payment_method" class="form-select mt-2">
          <option>COD</option>
          <option>Transfer</option>
        </select>
        <p class="mt-2">Transfer to: <b>BSI 1234567890</b></p>
        <button type="submit" class="btn btn-success">Checkout</button>
      @endif
    </form>
  </div>
</body>
</html>
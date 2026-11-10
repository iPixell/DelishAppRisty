<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Order History</title>
</head>
<body>
  @include('template.nav')
  <div class="container mt-5">
    <h3>Order History</h3>
    @foreach ($data as $item)
      <div class="card p-3 mt-3">
        <h5>Order #{{ $item->id }}</h5>
        @foreach ($item->items as $detail)
          <div>{{ $detail->menu->name }} - {{ $detail->qty }} x Rp{{ number_format($detail->price) }}</div>
        @endforeach
        <h5>Total: Rp{{ number_format($item->total) }}</h5>
        <p class="text-success">Order successful</p>
      </div>
    @endforeach
  </div>
</body>
</html>
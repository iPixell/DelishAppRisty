<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
  </head>
  <body class="d-flex justify-content-center align-items-center min-vh-100">
    <form class="card shadow-sm p-5 form-group rounded-4" action="{{ route('postlogin') }}" method="POST" accept-charset="utf-8">
      @csrf
      <h3 class="fw-bold text-center mb-4">Login</h3>
      <div class="mb-3">
        <label class="fw-bold">Email</label>
        <input type="email" name="email" class="border-dark form-control" />
      </div>
      <div>
        <label class="fw-bold">Password</label>
        <input type="password" name="password" class="border-dark form-control" />
      </div>
      @if (Session::has('status'))
        <span class="text-danger">{{Session::get('status')}}</span>
      @endif
      <button type="submit" class="btn btn-primary mt-3">Login</button>
      <span class="small text-center mt-2">Don't have an account?
        <a class="text-decoration-none fw-bold" href="{{ route('register') }}">Sign in</a>
      </span>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
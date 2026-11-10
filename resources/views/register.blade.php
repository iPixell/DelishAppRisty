<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
  </head>
  <body class="d-flex justify-content-center align-items-center min-vh-100">
    <form class="card shadow-sm p-5 form-group rounded-4" action="{{ route('postregister') }}" method="POST" accept-charset="utf-8">
      @csrf
      <h3 class="fw-bold text-center mb-4">Register</h3>
      <div class="mb-3">
        <label class="fw-bold">Nama</label>
        <input type="text" name="name" class="border-dark form-control" />
      </div>
      <div class="mb-3">
        <label class="fw-bold">Email</label>
        <input type="email" name="email" class="border-dark form-control" />
      </div>
      <div class="mb-3">
        <label class="fw-bold">Password</label>
        <input type="password" name="password" class="border-dark form-control" />
      </div>
      <button type="submit" class="btn btn-success">Sign in</button>
      <span class="small text-center mt-2">Have an account?
        <a class="text-success text-decoration-none fw-bold" href="{{ route('login') }}">Login</a>
      </span>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
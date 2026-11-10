<nav class="nav bg-dark d-flex align-items-center px-4 py-2 gap-4">
  <a href="#" class="text-decoration-none text-white fw-bold">Toko</a>
  @if(Auth::user()->role=='admin')
    <a href="{{ route('admin') }}" class="text-decoration-none text-white">Admin</a>
  @else
    <a href="{{ route('menu') }}" class="text-decoration-none text-white">Menu</a>
    <a href="{{ route('cart') }}" class="text-decoration-none text-white">Cart 🛒</a>
    <a href="{{ route('history') }}" class="text-decoration-none text-white">History</a>
  @endif
  <form class="m-0 ms-auto" action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
  </form>
</nav>
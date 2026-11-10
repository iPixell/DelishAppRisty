<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class UserController extends Controller
{
  public function menu()
  {
    return view("menu", ["data" => Menu::all()]);
  }

  private function cartData()
  {
    $cart = session("cart", []);
    $data = Menu::whereIn("id", array_keys($cart))
      ->get()
      ->each(function ($i) use ($cart) {
        $i->jumlah = $cart[$i->id];
        $i->subtotal = $i->price * $i->jumlah;
      });
    return [$cart, $data, $data->sum("subtotal")];
  }

  public function addcart(Request $request)
  {
    $cart = session("cart", []);
    $cart[$request->menu_id] = ($cart[$request->menu_id] ?? 0) + 1;
    session(["cart" => $cart]);
    return redirect()->route("cart");
  }

  public function cart()
  {
    [, $data, $total] = $this->cartData();
    return view("cart", compact("data", "total"));
  }

  public function updatecart(Request $request)
  {
    $cart = collect(session("cart", []))
      ->merge(collect($request->qty)->filter(fn($q) => $q > 0))
      ->all();
    session(["cart" => $cart]);
    return redirect()->route("cart");
  }

  public function removecart(Menu $menu)
  {
    session()->forget("cart." . $menu->id);
    return redirect()->route("cart");
  }

  public function checkout(Request $request)
  {
    session([
      "cart" => array_replace(
        session("cart", []),
        array_filter($request->qty ?? [], fn($q) => $q > 0)
      ),
    ]);

    [$cart, $data, $total] = $this->cartData();

    $order = Order::create(["user_id" => Auth::id(), "total" => $total]);
    $data->each(function ($i) use ($cart, $order) {
      OrderItem::create([
        "order_id" => $order->id,
        "menu_id" => $i->id,
        "qty" => $cart[$i->id],
        "price" => $i->price,
        "subtotal" => $i->price * $cart[$i->id],
      ]);
    });

    session()->forget("cart");
    return redirect()->route("history");
  }

  public function history()
  {
    return view("history", [
      "data" => Auth::user()
        ->orders()
        ->with("items.menu")
        ->get(),
    ]);
  }
}

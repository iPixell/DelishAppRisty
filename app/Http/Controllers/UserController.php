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
    $data = Menu::all();
    return view("menu", compact("data"));
  }

  public function addcart(Request $request)
  {
    $cart = session()->get("cart", []);
    $id = $request->menu_id;

    if (!isset($cart[$id])) {
      $cart[$id] = 1;
    } else {
      $cart[$id]++;
    }

    session()->put("cart", $cart);
    return redirect()->route("cart");
  }

  public function cart()
  {
    $cart = session()->get("cart", []);
    $data = Menu::whereIn("id", array_keys($cart))->get();
    $total = 0;

    foreach ($data as $item) {
      $item->jumlah = $cart[$item->id];
      $item->subtotal = $item->price * $item->jumlah;
      $total += $item->subtotal;
    }

    return view("cart", compact("data", "total"));
  }

  public function updatecart(Request $request)
  {
    $cart = session()->get("cart", []);

    foreach ($request->qty as $id => $qty) {
      if ($qty > 0) {
        $cart[$id] = $qty;
      }
    }

    session()->put("cart", $cart);
    return redirect()->route("cart");
  }

  public function removecart(Menu $menu)
  {
    $cart = session()->get("cart", []);
    unset($cart[$menu->id]);

    session()->put("cart", $cart);
    return redirect()->route("cart");
  }

  public function checkout()
  {
    $cart = session()->get("cart", []);
    $data = Menu::whereIn("id", array_keys($cart))->get();
    $total = 0;

    foreach ($data as $item) {
      if ($item->qty < $cart[$item->id]) {
        return back()->with("status", "Stok tidak cukup");
      }

      $total += $item->price * $cart[$item->id];
    }

    $order = Order::create([
      "user_id" => Auth::id(),
      "total" => $total,
    ]);

    foreach ($data as $item) {
      $qty = $cart[$item->id];

      OrderItem::create([
        "order_id" => $order->id,
        "menu_id" => $item->id,
        "qty" => $qty,
        "price" => $item->price,
        "subtotal" => $item->price * $qty,
      ]);

      $item->decrement("qty", $qty);
    }

    session()->forget("cart");
    return redirect()->route("history");
  }

  public function history()
  {
    $data = Auth::user()
      ->orders()
      ->with("items.menu")
      ->get();
    return view("history", compact("data"));
  }
}

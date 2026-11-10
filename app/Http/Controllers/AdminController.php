<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class AdminController extends Controller
{
  public function admin()
  {
    $data = Menu::paginate(10);
    return view("admin", compact("data"));
  }
  public function add()
  {
    $category = Category::all();
    return view("add", compact("category"));
  }
  public function postadd(Request $request)
  {
    $request->validate([
      "category_id" => "required",
      "img" => "required",
      "name" => "required",
      "price" => "required",
    ]);
    Menu::create([
      "category_id" => $request->category_id,
      "img" => $request->file("img")->store("image", "public"),
      "name" => $request->name,
      "price" => $request->price,
    ]);
    return redirect()->route("admin");
  }
  public function delete(Menu $menu)
  {
    $menu->orderItems()->delete();
    $menu->delete();
    return back();
  }

  public function edit(Menu $menu)
  {
    $category = Category::with("menu")->get();
    return view("edit", compact("menu", "category"));
  }
  public function postedit(Request $request, Menu $menu)
  {
    $data = $request->validate([
      "category_id" => "required",
      "img" => "nullable|image",
      "name" => "required",
      "price" => "required",
    ]);

    if ($request->hasFile("img")) {
      $data["img"] = $request->file("img")->store("image", "public");
    }

    $menu->update($data);
    return redirect()->route("admin");
  }
}

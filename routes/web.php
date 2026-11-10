<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get("/", [AuthController::class, "login"]);

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "postlogin"])->name("postlogin");

Route::get("/register", [AuthController::class, "register"])->name("register");
Route::post("/register", [AuthController::class, "postregister"])->name(
  "postregister"
);

Route::middleware("auth")->group(function () {
  Route::post("/logout", [AuthController::class, "logout"])->name("logout");

  //xustomer
  Route::get("/menu", [UserController::class, "menu"])->name("menu");
  Route::get("/cart", [UserController::class, "cart"])->name("cart");
  Route::post("/addcart", [UserController::class, "addcart"])->name("addcart");
  Route::post("/updatecart", [UserController::class, "updatecart"])->name(
    "updatecart"
  );
  Route::get("/removecart/{menu}", [UserController::class, "removecart"])->name(
    "removecart"
  );
  Route::post("/checkout", [UserController::class, "checkout"])->name(
    "checkout"
  );
  Route::get("/history", [UserController::class, "history"])->name("history");

  //admin
  Route::get("/admin", [AdminController::class, "admin"])->name("admin");
  Route::get("/add", [AdminController::class, "add"])->name("add");
  Route::post("/add", [AdminController::class, "postadd"])->name("postadd");
  Route::delete("/delete/{menu}", [AdminController::class, "delete"])->name(
    "delete"
  );
  Route::get("/edit/{menu}", [AdminController::class, "edit"])->name("edit");
  Route::post("/postedit/{menu}", [AdminController::class, "postedit"])->name(
    "postedit"
  );
});

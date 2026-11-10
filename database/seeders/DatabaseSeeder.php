<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      "name" => "Admin",
      "email" => "admin@gmail.com",
      "password" => bcrypt("admin123"),
      "role" => "admin",
    ]);
    User::create([
      "name" => "example",
      "email" => "hey@gmail.com",
      "password" => bcrypt("hey"),
      "role" => "customer",
    ]);
    Category::create([
      "name" => "Food",
    ]);
    Category::create([
      "name" => "Drink",
    ]);
    Menu::create([
      "category_id" => 1,
      "img" => "image/seblak.jpg",
      "name" => "seblak",
      "price" => 7000,
    ]);
    Menu::create([
      "category_id" => 2,
      "img" => "image/matcha.jpg",
      "name" => "matcha",
      "price" => 10000,
    ]);
  }
}

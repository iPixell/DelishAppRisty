<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  use HasFactory;

  protected $fillable = ["category_id", "img", "name", "price", "qty"];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}

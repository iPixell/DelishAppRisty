<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;
  protected $guarded = ["id"];
  protected $fillable = ["category_id", "img", "nm_p", "descr", "price", "qty"];
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}

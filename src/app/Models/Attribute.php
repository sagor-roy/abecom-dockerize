<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

   public function product_attribute(){
       return $this->hasMany(ProductAttribute::class);
   }
}

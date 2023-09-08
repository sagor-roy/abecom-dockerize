<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBlock extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function brand(){
        return $this->belongsToMany(Brand::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

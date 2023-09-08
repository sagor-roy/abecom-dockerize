<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVarientValue extends Model
{
    use HasFactory;

    public function varient(){
        return $this->belongsTo(Varient::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function category_varient(){
        return $this->belongsTo(CategoryVarient::class);
    }
}

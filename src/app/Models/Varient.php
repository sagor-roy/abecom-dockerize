<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varient extends Model
{
    use HasFactory;


    public function product_varient_value(){
        return $this->hasMany(ProductVarientValue::class);
    }

    public function category_varient(){
        return $this->hasMany(CategoryVarient::class);
    }
}

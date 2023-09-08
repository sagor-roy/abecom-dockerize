<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVarient extends Model
{
    use HasFactory;

    public function varient(){
        return $this->belongsTo(Varient::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product_varient_value(){
        return $this->hasMany(ProductVarientValue::class);
    }

}

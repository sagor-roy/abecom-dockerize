<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

    public function order_product(){
        return $this->hasMany(OrderProduct::class,'product_varient_value_id','id');
    }

}

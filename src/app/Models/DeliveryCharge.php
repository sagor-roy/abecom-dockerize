<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->hasMany(Order::class, 'city', 'id');
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}

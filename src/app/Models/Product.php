<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_attribute(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function product_varient_value(){
        return $this->hasMany(ProductVarientValue::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function delivery_charge(){
        return $this->belongsTo(DeliveryCharge::class);
    }

    public function order_product(){
        return $this->hasMany(OrderProduct::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function question(){
        return $this->hasMany(ProductQuestion::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function attribute_set()
    {
        return $this->hasMany(AttributeSet::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }

    public function category_varient(){
        return $this->hasMany(CategoryVarient::class);
    }

    public function pblock(){
        return $this->belongsToMany(ProductBlock::class);
    }

    public function banner(){
        return $this->hasMany(CategoryBanner::class);
    }
}

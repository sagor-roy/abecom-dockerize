<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsToMany(SubCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function pblock(){
        return $this->belongsToMany(ProductBlock::class);
    }

    public function banner()
    {
        return $this->hasMany(BrandBanner::class);
    }
}

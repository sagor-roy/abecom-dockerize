<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function banner()
    {
        return $this->hasMany(SubCategoryBanner::class);
    }
}

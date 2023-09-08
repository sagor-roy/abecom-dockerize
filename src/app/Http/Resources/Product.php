<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand->name,
            'category_id' => $this->category->name,
            'sub_category_id' => $this->sub_category_id,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'is_onsale' => $this->is_onsale,
            'is_top_rated' => $this->is_top_rated,
            'name' => Str::limit($this->name, 35, '...'),
            'name_2' => $this->name,
            'offer_price' => $this->offer_price ? $this->offer_price : $this->price,
            'price' => $this->price,
            'short_description' => $this->short_description,
            'slug' => $this->slug,
            'specification' => $this->specification,
            'description' => $this->description,
            'image' => asset('images/product/'.$this->thumbnail),
            'product_detail' => route('productdetails', $this->slug),
        ];
    }
}

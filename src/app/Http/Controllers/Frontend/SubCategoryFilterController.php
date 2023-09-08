<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\CategoryVarient;
use App\Models\Product;
use Illuminate\Http\Request;

class SubCategoryFilterController extends Controller
{
    public function price_filter($id,$min, $max)
    {
        $query = Product::where('sub_category_id', $id)->where('is_active', true);

        $query = $query->whereBetween('price', [$min, $max]);

        $products = $query->get();

        return response()->json(['products' => new ProductCollection($products)], 200);
    }

    public function brand_filter($id, $sub_Cat_id){
        $brand = Brand::find($id);  
        $data = [];
        $products = Product::where('sub_category_id', $sub_Cat_id)->where('is_active', true)->get();

        foreach( $products as $product ){
            if( $product->brand_id == $id ){
                array_push($data,new ResourcesProduct($product));
            }
        }

        return response()->json(['products' => $data], 200);
    }

    public function subcategory_attribute_filter($cat_var_id, $sub_cat){
        $category_varient = CategoryVarient::find($cat_var_id);
        $products = [];
        foreach ($category_varient->product_varient_value as $product_varient_value) {
            if( $product_varient_value->product->sub_category_id == $sub_cat ){
                array_push($products,new ResourcesProduct($product_varient_value->product));
            }
        }
        return response()->json(['products' => $products], 200);
    }
}

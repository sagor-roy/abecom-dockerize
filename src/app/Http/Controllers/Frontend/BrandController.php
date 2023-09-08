<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function price_filter($min, $max, $brand){
        $query = Product::where('brand_id', $brand)->where('is_active', true);

        $query = $query->whereBetween('price', [$min, $max]);

        $products = $query->get();

        return response()->json(['products' => new ProductCollection($products)], 200);
    }

    public function sub_cat_filter($sub_cat, $brand){
        $sub_cat = SubCategory::find($sub_cat);
        $data = [];

        ;

        foreach( $sub_cat->product->where("brand_id",$brand)->where("is_active", true) as $product ){
            array_push($data, new ResourcesProduct($product) );
        }

        return response()->json(['products' => $data], 200);
    }

    public function cat_filter($cat, $brand){
        $data = [];
        $products = Product::where('category_id', $cat)->where('is_active', true)->get();
        foreach( $products as $product ){
            if( $product->brand_id == $brand ){
                array_push($data, new ResourcesProduct($product) );
            }
        }
        return response()->json(['products' => $data], 200);
    }
}

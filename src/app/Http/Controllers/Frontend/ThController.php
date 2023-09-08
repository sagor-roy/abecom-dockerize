<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryVarient;
use App\Models\Product as ModelsProduct;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class ThController extends Controller
{
    //category page
    public function category_th(Request $request){
        if( $request->ajax() ){
            try{
                $category = Category::find($request->cat);
                if( $request->sub_cat ){
                    $sub_cat = SubCategory::find($request->sub_cat);
                    $products = [];
                    foreach( $sub_cat->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                elseif( $request->brand ){
                    $brand = Brand::find($request->brand);
                    $products = [];
                    foreach( $brand->product->where("category_id",$request->cat)->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                
                elseif( $request->varient ){
                    $category_varient = CategoryVarient::find($request->varient);
                    $products = [];
                    foreach ($category_varient->product_varient_value as $product_varient_value) {
                        if( $product_varient_value->product->price >= $request->min_value && $product_varient_value->product->price <= $request->max_value ){
                            array_push($products, new Product($product_varient_value->product));
                        }
                        
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }
                    else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                else{
                    $products = [];
                    foreach( $category->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                    
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }


    //sub category page
    public function sub_category_th(Request $request){
        if( $request->ajax() ){
            try{
                $subcategory = SubCategory::find($request->subcat);
                if( $request->brand ){
                    $brand = Brand::find($request->brand);
                    $products = [];
                    foreach( $brand->product->where("sub_category_id",$request->subcat)->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                
                elseif( $request->varient ){
                    $category_varient = CategoryVarient::find($request->varient);
                    $products = [];
                    foreach ($category_varient->product_varient_value as $product_varient_value) {
                        if( $product_varient_value->product->price >= $request->min_value && $product_varient_value->product->price <= $request->max_value ){
                            if( $product_varient_value->product->sub_category_id == $request->subcat ){
                                array_push($products, new Product($product_varient_value->product));
                            }
                           
                        }
                        
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }
                    else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                else{
                    $products = [];
                    foreach( $subcategory->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                    
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }


    //brand page start
    public function brand_th(Request $request){
        if( $request->ajax() ){
            try{
                $brand = Brand::find($request->brand);
                if( $request->cat ){
                    $category = Category::find($request->cat);
                    $products = [];
                    foreach( $category->product->where("brand_id",$request->brand)->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                
                elseif( $request->subcat ){
                    $subcat = SubCategory::find($request->subcat);
                    $products = [];
                    foreach( $subcat->product->where("brand_id",$request->brand)->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                else{
                    $products = [];
                    foreach( $brand->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                    
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //shop page start
    public function shop_th(Request $request){
        if( $request->ajax() ){
            try{
                if( $request->cat ){
                    $category = Category::find($request->cat);
                    $products = [];
                    foreach( $category->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                
                elseif( $request->subcat ){
                    $subcat = SubCategory::find($request->subcat);
                    $products = [];
                    foreach( $subcat->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                elseif( $request->brand ){
                    $brand = Brand::find($request->brand);
                    $products = [];
                    foreach( $brand->product->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value]) as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
                else{
                    $all_products = ModelsProduct::orderBy("id","desc")->where("is_active", true)->whereBetween('price', [$request->min_value,$request->max_value])->take(30)->get();
                    $products = [];
                    foreach( $all_products as $product ){
                        array_push($products, new Product($product));
                    }
                    if( $request->value == 'th-list' ){
                        return response()->json(['list' => $products], 200);
                    }else{
                        return response()->json(['large' => $products], 200);
                    }
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
}

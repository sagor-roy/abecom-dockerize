<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::select("id","name","slug","price","offer_price","thumbnail","is_active")->where('is_active', true)->orderBy('id', 'desc')->paginate(20);

        $categories = Category::orderBy('position', 'asc')->where('is_active', true)->get();
        $subcategories = SubCategory::orderBy('id', 'desc')->where('is_active', true)->get();
        $brands = Brand::orderBy('id', 'desc')->where('is_active', true)->get();

        return view('frontend.pages.shop', compact('products', 'categories', 'subcategories', 'brands'));
    }

    //price filter shop page start
    public function price_filter_shop($min, $max)
    {
        $query = Product::where('is_active', true);

        $query = $query->whereBetween('price', [$min, $max]);

        $products = $query->take(100)->get();

        return response()->json(['products' => new ProductCollection($products)], 200);
    }

    //price filter shop page end

    //category wise filter start
    public function category_filter($id)
    {
        $category = Category::find($id);
        $subcategories = SubCategory::where("category_id", $category->id)->select("id","name")->where("is_active", true)->get();
        $brands = $category->brand;


        if ($category->product->count() < 2) {
            
            return response()->json([
                'products' => new ResourcesProduct($category->product->where("is_active", true)),
                'subcategories' => $subcategories,
                'brands' => $brands
            ], 200);
        } else {
            return response()->json([
                'products' => new ProductCollection($category->product->where("is_active", true)),
                'subcategories' => $subcategories,
                'brands' => $brands
            ], 200);
        }
    }

    //subcategory wise filter start
    public function subcategory_filter($id)
    {
        $subcategory = SubCategory::find($id);
        $products = [];

        foreach ($subcategory->product->where("is_active", true) as $product) {
            array_push($products, new ResourcesProduct($product));
        }

        return response()->json(['products' => $products], 200);
    }

    //brand wise filter start
    public function brand_filter($id)
    {
        $brand = Brand::find($id);
        if ($brand->product->count() < 2) {
            return response()->json(['products' => new ResourcesProduct($brand->product->where("is_active", true))], 200);
        } else {
            return response()->json(['products' => new ProductCollection($brand->product->where("is_active", true))], 200);
        }
    }
}

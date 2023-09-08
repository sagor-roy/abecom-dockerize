<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVarientValue;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.pages.product.manage');
    }

    public function data(Request $request)
    {
        $product = Product::select("id","slug","thumbnail","name","is_active","category_id","sub_category_id","brand_id")->get();

        return DataTables::of($product)
        ->rawColumns(['action', 'image', 'product', 'status',])
        ->editColumn('image', function (Product $product) {
            $url = asset('images/product/'.$product->thumbnail);

            return "<img src='".$url."' width='50px' />";
        })
        ->editColumn('product', function (Product $product) {
            return  '
            <p><b>Name : </b> '.$product->name.'</p>
            <p><b>Category : </b>'.$product->category->name.'</p>
            <p><b>Sub Category : </b>'.$product->sub_category->name.'</p>
            <p><b>Brand : </b>'.$product->brand->name.'</p>
            ';
        })
        ->editColumn('status', function (Product $product) {
            if ($product->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Product $product) {
            return '
            <a href="'.route('product.edit.page', $product->id).'" target="_blank" class="btn btn-primary">
                    Edit
            </a>
            <button type="button" data-content="'.route('product.view.page', $product->id).'"  data-target="#largeModal" class="btn btn-danger" data-toggle="modal">
                    View
            </button>';
        })
        ->make(true);
    }

    public function add_page()
    {
        return view('backend.pages.product.add');
    }

    public function view_page($id)
    {
        $product = Product::find($id);

        return view('backend.pages.product.view', compact('product'));
    }

    public function dynamic_dependent($id)
    {
        return $sub_cat = SubCategory::where('category_id', $id)->get();
    }

    public function varient_dependent($id)
    {
        $category = Category::find($id);

        return $category->varient;
    }

    public function add(Request $request)
    {
        //if product varient have
        if ($request->true_false == 1) {
            $validator = Validator::make($request->all(), [
                'thumbnail' => 'required|dimensions:min_width=600,max_width=600,min_height=600,max_height=600',
                'name' => 'required|unique:products,name',
                'price' => 'required',
                'category_id' => 'required',
                'sub_cat_id' => 'required',
                'brand_id' => 'required',
                'is_featured' => 'required',
                'is_onsale' => 'required',
                'is_top_rated' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'specification' => 'required',
                'varients.*' => 'required',
                'varient_value.*' => 'required',
                'value.*' => 'required',
                'qty.*' => 'required',
                'delivery_charge_id' => 'required',
                'offer_id' => 'required|numeric',
            ]);
        } else { // no product varient
            $validator = Validator::make($request->all(), [
                'thumbnail' => 'required|dimensions:min_width=600,max_width=600,min_height=600,max_height=600',
                'name' => 'required|unique:products,name',
                'price' => 'required',
                'category_id' => 'required',
                'sub_cat_id' => 'required',
                'brand_id' => 'required',
                'is_featured' => 'required',
                'is_onsale' => 'required',
                'is_top_rated' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'specification' => 'required',
                'varients.*' => 'required',
                'varient_value.*' => 'required',
                'quantity' => 'required',
                'delivery_charge_id' => 'required',
                'offer_id' => 'required|numeric',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_cat_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->offer_price = null;
            $product->slug = Str::slug($request->name);
            $product->is_featured = $request->is_featured;
            $product->is_onsale = $request->is_onsale;
            $product->is_top_rated = $request->is_top_rated;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->specification = $request->specification;


            if( $request->offer_id == 0 ){
                $product->offer_id = null;
                $product->offer_status = false;
            }
            else{
                    $offer = Offer::find($request->offer_id);
                    if( $offer->percent == 0 ){
                        $product->offer_price = $product->price - $offer->cash_discount;
                        $product->offer_status = true;
                        $product->offer_id = $offer->id;
                    }
                    elseif( $offer->cash_discount  == 0 ){
                        $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                        $product->offer_price = $product->price - $discount_price;
                        $product->offer_status = true;
                        $product->offer_id = $offer->id;
                    }
            }

            $product->delivery_charge_id = $request->delivery_charge_id;

            if ($request->thumbnail) {
                $image = $request->file('thumbnail');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/product/'.$img);
                Image::make($image)->save($location);
                $product->thumbnail = $img;
            }

            $product->is_active = true;

            if ($product->save()) {
                //product images start
                if ($request->images) {
                    foreach ($request['images']  as $single_image) {
                        $product_image = new ProductImage();
                        $image = $single_image;
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/product/'.$img);
                        Image::make($image)->save($location);
                        $product_image->image = $img;
                        $product_image->product_id = $product->id;
                        $product_image->save();
                    }
                }
                //product images end

                if ($request->true_false == 1) {
                    //product attribute start
                    if ($request['attributes'] && $request['qty'] && $request['value']) {
                        foreach ($request['attributes'] as $key => $single_attribute) {
                            $product_attribute = new ProductAttribute();
                            $product_attribute->attribute_id = $single_attribute;
                            $product_attribute->product_id = $product->id;
                            $product_attribute->value = $request['value'][$key];
                            $product_attribute->qty = $request['qty'][$key];
                            $product_attribute->is_active = true;
                            $product_attribute->save();
                        }
                    }
                    //product attribute end
                } else {
                    $product->qty = $request->quantity ? $request->quantity : 1;
                    $product->save();
                }

                //product varient start
                if ($request['varients'] && $request['varient_value']) {
                    foreach ($request['varients'] as $key => $varient) {
                        $product_varient_value = new ProductVarientValue();
                        $product_varient_value->product_id = $product->id;
                        $product_varient_value->category_id = $product->category_id;
                        $product_varient_value->varient_id = $varient;
                        $product_varient_value->category_varient_id = $request['varient_value'][$key];
                        $product_varient_value->save();
                    }
                }
                //product varient end
            }

            $url = route('product.edit.page', $product->id);

            return response()->json(['product_url' => $url], 200);
        }
    }

    public function edit_page($id)
    {
        $product = Product::find($id);

        return view('backend.pages.product.edit', compact('product'));
    }

    public function edit_basic(Request $request, $id)
    {
        if( $request->add_varient == true ){
            $request->validate([
                'name' => 'required|unique:products,name,'.$id,
                'price' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'specification' => 'required',
                'category_id' => 'required',
                'sub_cat_id' => 'required',
                'brand_id' => 'required',
                'is_featured' => 'required',
                'is_onsale' => 'required',
                'is_top_rated' => 'required',
                'is_active' => 'required',
                'thumbnail' => 'dimensions:min_width=600,max_width=600,min_height=600,max_height=600',
                'delivery_charge_id' => 'required',
                'attributes.*' => 'required',
                'value.*' => 'required',
                'qty.*' => 'required',
                'offer_id' => 'required',
            ]);
        }else{
            $request->validate([
                'name' => 'required|unique:products,name,'.$id,
                'price' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'specification' => 'required',
                'category_id' => 'required',
                'sub_cat_id' => 'required',
                'brand_id' => 'required',
                'is_featured' => 'required',
                'is_onsale' => 'required',
                'is_top_rated' => 'required',
                'is_active' => 'required',
                'thumbnail' => 'dimensions:min_width=600,max_width=600,min_height=600,max_height=600',
                'delivery_charge_id' => 'required',
                'offer_id' => 'required'
            ]);
        }

        $product = Product::find($id);
        $product->category_id = $request->category_id;

        $product->sub_category_id = $request->sub_cat_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->is_featured = $request->is_featured;
        $product->is_onsale = $request->is_onsale;
        $product->is_top_rated = $request->is_top_rated;
        $product->is_active = $request->is_active;
        $product->delivery_charge_id = $request->delivery_charge_id;

        if( $request->offer_id == 0 ){
            $product->offer_id = null;
            $product->offer_status = false;
            $product->offer_price =  null;
        }
        else{
            $offer = Offer::find($request->offer_id);
            if( $offer->percent == 0 ){
                $product->offer_price = $product->price - $offer->cash_discount;
                $product->offer_status = true;
                $product->offer_id = $offer->id;
            }
            elseif( $offer->cash_discount  == 0 ){
                $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                $product->offer_price = $product->price - $discount_price;
                $product->offer_status = true;
                $product->offer_id = $offer->id;
            }
        }

        //if want to add product varient  on edit
        if( $request->add_varient == true ){
            $product->qty = null;
            if ($request['attributes'] && $request['qty'] && $request['value']) {
                foreach ($request['attributes'] as $key => $single_attribute) {
                    $product_attribute = new ProductAttribute();
                    $product_attribute->attribute_id = $single_attribute;
                    $product_attribute->product_id = $product->id;
                    $product_attribute->value = $request['value'][$key];
                    $product_attribute->qty = $request['qty'][$key];
                    $product_attribute->is_active = true;
                    $product_attribute->save();
                }
            }
        }else{
            $product->qty = $request->quantity;
        }
        //if want to add product varient  on edit end

        if ($request->thumbnail) {
            if (File::exists('images/product/'.$product->thumbnail)) {
                File::delete('images/product/'.$product->thumbnail);
            }
            $image = $request->file('thumbnail');
            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$img);
            Image::make($image)->save($location);
            $product->thumbnail = $img;
        }

        if ($product->save()) {
            $url = $product->id;
            $request->session()->flash('update', 'Product updated');

            return redirect()->route('product.edit.page', $url);
        }
    }

    //add product image

    public function image_data($id)
    {
        $product_image = Product::find($id)->product_image;

        return DataTables::of($product_image)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function ($product_image) {
            $url = asset('images/product/'.$product_image->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->addColumn('action', function ($product_image) {
            return '
            <button type="button" data-content="'.route('edit.product.image.modal', $product_image->id).'"  data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('delete.product.image.modal', $product_image->id).'"  data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>';
        })
        ->make(true);
    }

    public function add_image(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=600,max_width=600,min_height=600,max_height=600',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            if ($request->image) {
                $product_image = new ProductImage();
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/product/'.$img);
                Image::make($image)->save($location);
                $product_image->image = $img;
                $product_image->product_id = $id;
                if ($product_image->save()) {
                    return response()->json(['create' => $product_image], 200);
                }
            }
        }
    }

    public function edit_image_modal($id)
    {
        $product_image = ProductImage::find($id);

        return view('backend.pages.product.image.edit', compact('product_image'));
    }

    public function edit_image($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,jpeg,png|max:50|dimensions:max_width=600,max_height=600',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $product_image = ProductImage::find($id);

            if ($request->image) {
                if (File::exists('images/product/'.$product_image->image)) {
                    File::delete('images/product/'.$product_image->image);
                }
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/product/'.$img);
                Image::make($image)->save($location);
                $product_image->image = $img;

                if ($product_image->save()) {
                    return response()->json(['update' => $product_image], 200);
                }
            }
        }
    }

    public function delete_image_modal($id)
    {
        $product_image = ProductImage::find($id);

        return view('backend.pages.product.image.delete', compact('product_image'));
    }

    public function delete_image($id, Request $request)
    {
        $product_image = ProductImage::find($id);
        if (File::exists('images/product/'.$product_image->image)) {
            File::delete('images/product/'.$product_image->image);
        }
        if ($product_image->delete()) {
            return response()->json(['delete' => $product_image], 200);
        }
    }

    //product attribute add start
    public function add_product_attribute(Request $request, $id)
    {
        $request->validate([
            'value' => 'required',
            'qty' => 'required|numeric|min:0',
        ]);
        $product = Product::find($id);
        $product_attribute = new ProductAttribute();
        $product_attribute->attribute_id = $request->attribute_id;
        $product_attribute->product_id = $product->id;
        $product_attribute->value = $request->value;
        $product_attribute->qty = $request->qty;
        $product_attribute->is_active = true;
        if ($product_attribute->save()) {
            $request->session()->flash('update', 'Product attribute added');

            return redirect()->route('product.edit.page', $product->id);
        }
    }

    //product attribute update start
    public function update_product_attribute(Request $request, $id)
    {
        $request->validate([
            'value' => 'required',
            'qty' => 'required|numeric|min:0',
        ]);

        $product_attribute = ProductAttribute::find($id);
        $product_attribute->value = $request->value;
        $product_attribute->qty = $request->qty;
        $product_attribute->is_active = $request->is_active;
        if ($product_attribute->save()) {
            $request->session()->flash('update', 'Product attribute updated');

            return redirect()->route('product.edit.page', $product_attribute->product_id);
        }
    }

    //product varient data
    public function product_varient_value_data($id)
    {
        $product_varient_value = Product::find($id)->product_varient_value;

        return DataTables::of($product_varient_value)
        ->rawColumns(['action', 'varient_id', 'category_varient_id'])
        ->editColumn('varient_id', function ($product_varient_value) {
            return $product_varient_value->varient->name;
        })
        ->editColumn('category_varient_id', function ($product_varient_value) {
            return $product_varient_value->category_varient->value;
        })
        ->addColumn('action', function ($product_varient_value) {
            return '
            <button type="button" data-content="'.route('edit.product.attr.value.modal', $product_varient_value->id).'"  data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('delete.product.attr.value.modal', $product_varient_value->id).'"  data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>';
        })
        ->make(true);
    }

    //product varient add
    public function add_product_varient(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'varients' => 'required',
            'varient_value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $product_varient_value = new ProductVarientValue();
            $product_varient_value->product_id = $id;
            $product_varient_value->varient_id = $request->varients;
            $product_varient_value->category_varient_id = $request->varient_value;
            $product_varient_value->category_id = $request->category_id;

            if ($product_varient_value->save()) {
                return response()->json(['create' => 'created'], 200);
            }
        }
    }

    public function edit_product_varient_modal($id)
    {
        $product_varient_value = ProductVarientValue::find($id);

        return view('backend.pages.product.product_varient.edit', compact('product_varient_value'));
    }

    //product varient update
    public function update_product_varient(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'varient' => 'required',
            'cat_varient_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['product_varient_required' => $validator->errors()], 422);
        } else {
            $product_varient_value = ProductVarientValue::find($id);
            $product_varient_value->category_varient_id = $request->cat_varient_id;
            $product_varient_value->varient_id = $request->varient;
            $product_varient_value->category_id = $request->category_id;
            if ($product_varient_value->save()) {
                return response()->json(['update' => 'Update'], 200);
            }
        }
    }

    public function delete_product_varient_modal($id)
    {
        $product_varient_value = ProductVarientValue::find($id);

        return view('backend.pages.product.product_varient.delete', compact('product_varient_value'));
    }

    //delete product varient
    public function delete_product_varient($id, Request $request)
    {
        $product_varient_value = ProductVarientValue::find($id);
        if ($product_varient_value->delete()) {
            return response()->json(['delete' => 'Delete'], 200);
        }
    }
}

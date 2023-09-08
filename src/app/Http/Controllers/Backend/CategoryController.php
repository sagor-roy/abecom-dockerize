<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBanner;
use App\Models\CategoryVarient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.pages.category.manage');
    }

    public function data(Request $request)
    {
        $category = Category::orderBy('id', 'desc')->get();



        return DataTables::of($category)
        ->rawColumns(['action', 'image', 'offer_image', 'banner_image', 'offer_amount', 'status', 'name', 'home_image','cat_name'])
        ->editColumn('cat_name', function(Category $category){
            $icon = "<i class='$category->icon'></i>";
            return "
                <p>".$icon ." ". $category->name."</p>
            ";
        })
        ->editColumn('name', function (Category $category) {
            return $category->name.''.$category->icon;
        })
        ->editColumn('image', function (Category $category) {
            $url = asset('images/category/'.$category->image);

            return "<img src='".$url."' width='50px' />";
        })

        ->editColumn('home_image', function (Category $category) {
            if ($category->banner->count() == 0) {
                return '<p class="badge badge-danger">No image avaiable</p>';
            }else{
                $url = asset('images/category/'.$category->banner->first()->image);
            }


            return "<img src='".$url."' width='50px' />";
        })

        ->editColumn('banner_image', function (Category $category) {
            if ($category->banner_image == null) {
                return '<p class="badge badge-danger">No image avaiable</p>';
            }
            $url = asset('images/category/'.$category->banner_image);

            return "<img src='".$url."' width='50px' />";
        })
        ->editColumn('status', function (Category $category) {
            if ($category->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Category $category) {
            return '
            <a href="'.route('category.edit', $category->id).'" target="_blank" class="btn btn-primary">
                    Edit
            </a>
            <button type="button" data-content="'.route('category.inactive.modal', $category->id).'"  data-target="#largeModal" class="btn btn-danger" data-toggle="modal">
                    View
            </button>';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        if( $request->is_attribute == false ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:categories,name,',
                'icon' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=800,max_width=800,min_height=600,max_height=600',
                'attribute' => 'required',
                'varients.*' => 'required',
                'varient_value.*' => 'required',
                'position' => 'required|unique:categories,position,',
                'banner_image.*' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'banner_position.*' => 'required',
                'banner_button.*' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:categories,name,',
                'icon' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=800,max_width=800,min_height=600,max_height=600',
                'attribute.*' => 'required',
                'position' => 'required|unique:categories,position,',
                'banner_image.*' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'banner_position.*' => 'required',
                'banner_button.*' => 'required',
            ]);
        }


        if ($validator->fails()) {
            return response()->json(['cat_errors' => $validator->errors()], 422);
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->icon = $request->icon;
            $category->is_active = true;
            $category->position = $request->position;
            $category->offer_status = false;

            $category->slug = Str::slug($request->name);
            if ($request->image) {
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/category/'.$img);
                Image::make($image)->save($location);
                $category->image = $img;
            }



            if ($category->save()) {

                foreach( $request['banner_image'] as $key => $banner_image ){
                    $category_banner = new CategoryBanner();
                    $image = $banner_image;
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/category/'.$img);
                    Image::make($image)->save($location);
                    $category_banner->image = $img;
                    $category_banner->category_id = $category->id;
                    $category_banner->position = $request['banner_position'][$key];
                    $category_banner->button = $request['banner_button'][$key];
                    $category_banner->save();
                }

                foreach ($request['attribute'] as $attribute) {
                    $category->attribute()->attach($attribute);
                }

                if( $request->is_attribute == false ){
                    foreach ($request['varients'] as $key => $varient) {
                        $category_varient = new CategoryVarient();
                        $category_varient->category_id = $category->id;
                        $category_varient->varient_id = $varient;
                        $category_varient->value = $request['varient_value'][$key];
                        $category_varient->is_active = true;
                        $category_varient->save();
                    }
                }


                return response()->json(['create' => $category], 200);
            }
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('backend.pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'icon' => 'required',
            'attribute' => 'required|array',
            'position' => 'required|unique:categories,position,'.$id,
            'image' => 'dimensions:min_width=800,max_width=800,min_height=600,max_height=600',
            'banner_image' => 'dimensions:min_width=1580,max_width=1580,min_height=270,max_height=270',
        ]);

            $category = Category::find($id);

            $category->name = $request->name;
            $category->icon = $request->icon;
            $category->is_active = $request->status;

            foreach ($category->product as $product) {
                $product->is_active = $request->status;
                $product->save();
            }

            $category->slug = Str::slug($request->name);
            $category->position = $request->position;

            if ($request->image) {
                if (File::exists('images/category/'.$category->image)) {
                    File::delete('images/category/'.$category->image);
                }

                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/category/'.$img);
                Image::make($image)->save($location);
                $category->image = $img;
            }

            if ($request->banner_image) {
                if (File::exists('images/category/'.$category->banner_image)) {
                    File::delete('images/category/'.$category->banner_image);
                }

                $image = $request->file('banner_image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/category/'.$img);
                Image::make($image)->save($location);
                $category->banner_image = $img;
            }


            if ($category->save()) {
                $category->attribute()->detach();
                foreach ($request['attribute'] as $attribute) {
                    $category->attribute()->attach($attribute);
                }

                $request->session()->flash('update', 'Category updated successfully');
                return redirect()->route('category.edit', $category->id);
            }
    }

    public function inactive_modal($id)
    {
        $category = Category::find($id);

        return view('backend.pages.category.view', compact('category'));
    }

    // public function inactive(Request $request, $id)
    // {
    //     $category = Category::find($id);

    //     $category->is_active = false;

    //     if ($category->save()) {
    //         return response()->json(['delete' => $category], 200);
    //     }
    // }




    //category attribute data
    public function attr_data($id){
        $category_varient = Category::find($id)->category_varient->where("is_active", true);

        return DataTables::of($category_varient)
        ->rawColumns(['action', 'varient','status'])
        ->editColumn('varient', function ( $category_varient) {
            return $category_varient->varient->name;
        })
        ->editColumn('status', function ( $category_varient) {
            if( $category_varient->is_active == true ){
                return "<p class='badge badge-success'>Active</p>";
            }
            else{
                return "<p class='badge badge-danger'>Inactive</p>";
            }
        })
        ->addColumn('action', function ( $category_varient) {
            return '
            <button type="button" data-content="'.route('cat.attr.edit', $category_varient->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
            Edit
        </button>';
        })
        ->make(true);
    }
    
    //add modal
    public function attr_data_add_modal($id){
        return view('backend.pages.category.modals.add_attribute', compact('id'));
    }
    //add
    public function cat_attr_add(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'varients.*' => 'required',
            'varient_value.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['cat_attr_failed' => $validator->errors()], 422);
        }else{
            foreach ($request['varients'] as $key => $varient) {
                $category_varient = new CategoryVarient();
                $category_varient->category_id = $id;
                $category_varient->varient_id = $varient;
                $category_varient->value = $request['varient_value'][$key];
                $category_varient->is_active = true;
                $category_varient->save();
            }
            return response()->json(['success' => 'Attribute Added'], 200);
        }
    }

    //edit
    public function cat_attr_edit($id){
        $category_attribute = CategoryVarient::find($id);
        return view('backend.pages.category.modals.edit_attribute', compact('category_attribute'));
    }

    public function cat_attr_update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'value' => 'required',
            'varients' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $category_attribute = CategoryVarient::find($id);
            $category_attribute->value = $request->value;
            $category_attribute->varient_id = $request->varients;
            $category_attribute->is_active = $request->is_active;
            if( $category_attribute->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }


    //banner data
    public function banner_data($id){
        $category_banner = CategoryBanner::where("category_id",$id);

        return DataTables::of($category_banner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function ( CategoryBanner $category_banner) {
            $url = asset("images/category/". $category_banner->image);
            return "<img src='$url' width='100px'> ";
        })

        ->addColumn('action', function (CategoryBanner $category_banner) {
            return '
            <button type="button" data-content="'.route('cat.banner.edit', $category_banner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                Edit
            </button>
            <button type="button" data-content="'.route('cat.banner.delete.modal', $category_banner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                Delete
            </button>
            '
        ;
        })
        ->make(true);
    }

    //add banner
    public function banner_add(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'position' => 'required',
            'button' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                if( $request->image ){
                    $category_banner = new CategoryBanner();
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/category/'.$img);
                    Image::make($image)->save($location);
                    $category_banner->image = $img;
                    $category_banner->category_id = $id;
                    $category_banner->position = $request->position;
                    $category_banner->button = $request->button;
                    if( $category_banner->save() ){
                        return response()->json(['create' => 'Create'], 200);
                    }
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //edit banner
    public function banner_edit($id){
        $category_banner = CategoryBanner::find($id);
        return view("backend.pages.category.modals.edit_banner", compact("category_banner"));
    }

    //update banner
    public function banner_update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'position' => 'required',
            'button' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $category_banner = CategoryBanner::find($id);
                if( $request->image ){
                    if( File::exists("images/category/". $category_banner->image) ){
                        File::delete("images/category/". $category_banner->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/category/'.$img);
                    Image::make($image)->save($location);
                    $category_banner->image = $img;
                }
                $category_banner->position = $request->position;
                $category_banner->button = $request->button;
                if( $category_banner->save() ){
                    return response()->json(['update' => 'Update'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //banner delete modal
    public function banner_delete_modal($id){
        $category_banner = CategoryBanner::find($id);
        return view("backend.pages.category.modals.delete_banner", compact("category_banner"));
    }

    //banner delete
    public function banner_delete(Request $request, $id){
        try{
            $category_banner = CategoryBanner::find($id);
            if( File::exists("images/category/". $category_banner->image) ){
                File::delete("images/category/". $category_banner->image);
            }
            if( $category_banner->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

}

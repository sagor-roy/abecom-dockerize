<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandBanner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        return view('backend.pages.brand.manage');
    }

    public function data(Request $request)
    {
        $brand = Brand::orderBy('id', 'desc')->get();

        return DataTables::of($brand)
        ->rawColumns(['action', 'category', 'subcategory','brand'])
        ->editColumn('brand', function (Brand $brand) {
            $url = asset('images/brand/'.$brand->image);
            $banner = "";
            if( $brand->banner->count() > 0 ){
                $banner = asset('images/brand/'.$brand->banner->first()->image);
            }
            
            $status = "";
            if( $brand->is_active == true ){
                $status = "<p class='badge badge-success'>Active</p>";
            }else{
                $status = "<p class='badge badge-danger'>Inactive</p>";
            }

            return "
                <p>Banner : <img src='$banner' width='50px' alt='Banner Image'></p>
                <p><img src='$url' width='50px' alt='Brand Image'></p>
                <p>Name : $brand->name</p>
                <p>Status : $status</p>
            ";
        })
        ->editColumn('category', function (Brand $brand) {
            $category = [];
            foreach( $brand->category as $brand_category ){
                array_push($category, $brand_category->name);
            }
            return $category;

        })
        ->editColumn('subcategory', function (Brand $brand) {
            $subcategory = [];
            foreach( $brand->subcategory as $brand_subcategory ){
                array_push($subcategory, $brand_subcategory->name);
            }
            return $subcategory;

        })
        ->addColumn('action', function (Brand $brand) {
            return '
            <a href="'.route('brand.edit', $brand->id).'"  class="btn btn-primary" target="_blank">
                    Edit
            </a>
            ';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands,name,',
            'position' => 'required|numeric|unique:brands,position,',
            'categories' => 'required|array',
            'sub_categories' => 'required|array',
            'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=200,max_width=200,min_height=150,max_height=150',
            'banner_image.*' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'banner_position.*' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->position = $request->position;
            $brand->is_active = true;
            $brand->slug = Str::slug($request->name);

            if ($request->image) {
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/brand/'.$img);
                Image::make($image)->save($location);
                $brand->image = $img;
            }

            if ($brand->save()) {
                foreach( $request['banner_image'] as $key => $banner_image ){
                    $brand_banner = new BrandBanner();
                    $image = $banner_image;
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/brand/'.$img);
                    Image::make($image)->save($location);
                    $brand_banner->image = $img;
                    $brand_banner->brand_id = $brand->id;
                    $brand_banner->position = $request['banner_position'][$key];
                    $brand_banner->save();
                }

                foreach ($request['categories'] as $category) {
                    $brand->category()->attach($category);
                }

                foreach ($request['sub_categories'] as $subcategory) {
                    $brand->subcategory()->attach($subcategory);
                }

                return response()->json(['create' => $brand], 200);
            }
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);

        return view('backend.pages.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands,name,'.$id,
            'position' => 'required|numeric|unique:brands,position,'. $id,
            'categories' => 'required|array',
            'sub_categories' => 'required|array',
            'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=200,max_width=200,min_height=150,max_height=150',
            'banner_image' => 'mimes:jpg,jpeg,png|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $brand = Brand::find($id);

            $brand->name = $request->name;
            $brand->position = $request->position;
            $brand->is_active = $request->status;
            $brand->slug = Str::slug($request->name);

            if ($request->image) {
                if (File::exists('images/brand/'.$brand->image)) {
                    File::delete('images/brand/'.$brand->image);
                }

                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/brand/'.$img);
                Image::make($image)->save($location);
                $brand->image = $img;
            }

            if ($brand->save()) {
                $brand->category()->detach();
                foreach ($request['categories'] as $category) {
                    $brand->category()->attach($category);
                }

                $brand->subcategory()->detach();
                foreach ($request['sub_categories'] as $sub_categories) {
                    $brand->subcategory()->attach($sub_categories);
                }

                return response()->json(['update' => $brand], 200);
            }
        }
    }

    public function inactive_modal($id)
    {
        $brand = Brand::find($id);

        return view('backend.pages.brand.delete', compact('brand'));
    }

    public function inactive(Request $request, $id)
    {
        $brand = Brand::find($id);

        $brand->is_active = false;

        if ($brand->save()) {
            return response()->json(['delete' => $brand], 200);
        }
    }


     //banner data
     public function banner_data($id){
        $brand_banner = BrandBanner::where("brand_id",$id);

        return DataTables::of($brand_banner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function ( BrandBanner $brand_banner) {
            $url = asset("images/brand/". $brand_banner->image);
            return "<img src='$url' width='100px'> ";
        })

        ->addColumn('action', function (BrandBanner $brand_banner) {
            return '
            <button type="button" data-content="'.route('brand.banner.edit', $brand_banner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                Edit
            </button>
            <button type="button" data-content="'.route('brand.banner.delete.modal', $brand_banner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                if( $request->image ){
                    $brand_banner = new BrandBanner();
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/brand/'.$img);
                    Image::make($image)->save($location);
                    $brand_banner->image = $img;
                    $brand_banner->brand_id = $id;
                    $brand_banner->position = $request->position;
                    if( $brand_banner->save() ){
                        return response()->json(['create' => 'Create'], 200);
                    }
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //banner edit
    public function banner_edit($id){
        $brand_banner = BrandBanner::find($id);
        return view("backend.pages.brand.modals.edit_banner", compact("brand_banner"));
    }

    //update banner
    public function banner_update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'image' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $brand_banner = BrandBanner::find($id);
                if( $request->image ){
                    if( File::exists("images/brand/". $brand_banner->image) ){
                        File::delete("images/brand/". $brand_banner->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/category/'.$img);
                    Image::make($image)->save($location);
                    $brand_banner->image = $img;
                }
                $brand_banner->position = $request->position;
                if( $brand_banner->save() ){
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
        $brand_banner = BrandBanner::find($id);
        return view("backend.pages.brand.modals.delete_banner", compact("brand_banner"));
    }

    //banner delete
    public function banner_delete(Request $request, $id){
        try{
            $brand_banner = BrandBanner::find($id);
            if( File::exists("images/brand/". $brand_banner->image) ){
                File::delete("images/brand/". $brand_banner->image);
            }
            if( $brand_banner->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

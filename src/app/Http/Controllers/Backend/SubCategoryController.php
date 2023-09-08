<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubCategoryBanner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view('backend.pages.subcategory.manage');
    }

    public function data(Request $request)
    {
        $subcategory = SubCategory::orderBy('id', 'desc')->get();

        return DataTables::of($subcategory)
        ->rawColumns(['action', 'status', 'parent_category','image'])
        ->editColumn('parent_category', function (SubCategory $subcategory) {
            return '<p class="badge badge-success">'.$subcategory->category->name.'</p>';
        })
        ->editColumn('image', function (SubCategory $subcategory) {
            if ($subcategory->banner->count() == 0) {
                return '<p class="badge badge-danger">No image avaiable</p>';
            }
            $url = asset('images/subcategory/'.$subcategory->banner->first()->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->editColumn('status', function (SubCategory $subcategory) {
            if ($subcategory->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (SubCategory $subcategory) {
            return '
            <a href="'.route('subcategory.edit', $subcategory->id).'"  class="btn btn-primary" target="_blank">
                    Edit
            </a>';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sub_categories,name,',
            'category_id' => 'required',
            'banner_image.*' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'banner_position.*' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $subcategory = new SubCategory();
            $subcategory->name = $request->name;
            $subcategory->slug = Str::slug($request->name);
            $subcategory->category_id = $request->category_id;
            $subcategory->is_active = true;


            if ($subcategory->save()) {
                foreach( $request['banner_image'] as $key => $banner_image ){
                    $sub_category_banner = new SubCategoryBanner();
                    $image = $banner_image;
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/subcategory/'.$img);
                    Image::make($image)->save($location);
                    $sub_category_banner->image = $img;
                    $sub_category_banner->sub_category_id = $subcategory->id;
                    $sub_category_banner->position = $request['banner_position'][$key];
                    $sub_category_banner->save();
                }
                
                return response()->json(['create' => $subcategory], 200);
            }
        }
    }

    public function edit($id)
    {
        $subcategory = SubCategory::find($id);

        return view('backend.pages.subcategory.edit', compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sub_categories,name,'.$id,
            'category_id' => 'required',
            'banner_image.*' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
            'banner_position.*' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $subcategory = SubCategory::find($id);

            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;
            $subcategory->is_active = $request->status;
            $subcategory->slug = Str::slug($request->name);

            if ($subcategory->save()) {
                return response()->json(['update' => $subcategory], 200);
            }
        }
    }

    //banner data
    public function banner_data($id){
        $sub_category_banner = SubCategoryBanner::where("sub_category_id",$id);

        return DataTables::of($sub_category_banner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function ( SubCategoryBanner $sub_category_banner) {
            $url = asset("images/subcategory/". $sub_category_banner->image);
            return "<img src='$url' width='100px'> ";
        })

        ->addColumn('action', function (SubCategoryBanner $sub_category_banner) {
            return '
            <button type="button" data-content="'.route('subcat.banner.edit', $sub_category_banner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                Edit
            </button>
            <button type="button" data-content="'.route('subcat.banner.delete.modal', $sub_category_banner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
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
                    $sub_category_banner = new SubCategoryBanner();
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/subcategory/'.$img);
                    Image::make($image)->save($location);
                    $sub_category_banner->image = $img;
                    $sub_category_banner->sub_category_id = $id;
                    $sub_category_banner->position = $request->position;
                    if( $sub_category_banner->save() ){
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
        $sub_category_banner = SubCategoryBanner::find($id);
        return view("backend.pages.subcategory.modals.edit_banner", compact("sub_category_banner"));
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
                $sub_category_banner = SubCategoryBanner::find($id);
                if( $request->image ){
                    if( File::exists("images/subcategory/". $sub_category_banner->image) ){
                        File::delete("images/subcategory/". $sub_category_banner->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/category/'.$img);
                    Image::make($image)->save($location);
                    $sub_category_banner->image = $img;
                }
                $sub_category_banner->position = $request->position;
                if( $sub_category_banner->save() ){
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
        $sub_category_banner = SubCategoryBanner::find($id);
        return view("backend.pages.subcategory.modals.delete_banner", compact("sub_category_banner"));
    }

    //banner delete
    public function banner_delete(Request $request, $id){
        try{
            $sub_category_banner = SubCategoryBanner::find($id);
            if( File::exists("images/subcategory/". $sub_category_banner->image) ){
                File::delete("images/subcategory/". $sub_category_banner->image);
            }
            if( $sub_category_banner->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

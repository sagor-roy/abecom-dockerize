<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SmallBanner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SmallBannerController extends Controller
{
    //index page
    public function index(){
        return view('backend.pages.smallbanner.manage');
    }

    //data
    public function data(){
        $banner = SmallBanner::orderBy('position', 'asc')->get();

        return DataTables::of($banner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function (SmallBanner $banner) {
            $url = asset('images/smallbanner/'.$banner->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->addColumn('action', function (SmallBanner $banner) {
            $class = "";
            if( $banner->parent_id == 0 ){
                $class = "d-none";
            }
            
            return '
            <button type="button" data-content="'.route('small.banner.edit', $banner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('small.banner.delete.modal', $banner->id).'" data-target="#myModal" class="btn btn-danger  '.$class.'" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }


    //add small banner
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|dimensions:min_width=310,max_width=310,min_height=132,max_height=132',
            'banner_id' => 'required',
            'name' => 'required',
            'position' => 'required|unique:small_banners,position,'
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $banner = new SmallBanner();
                $banner->name = $request->name;
                $banner->position = $request->position;
                $banner->link = $request->link;
                $banner->parent_id = $request->banner_id;
                if( $request->image ){
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/smallbanner/'.$img);
                    Image::make($image)->save($location);
                    $banner->image = $img;
                }
                if( $banner->save() ){
                    return response()->json(['create' => 'Added'], 200);
                }
            }   
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }


    //edit small banner
    public function edit($id){
        $banner = SmallBanner::find($id);
        return view("backend.pages.smallbanner.modals.edit", compact("banner"));
    }

    //update small banner
    public function update(Request $request, $id){
        $banner = SmallBanner::find($id);
        $validator = Validator::make($request->all(), [
            'image' => 'dimensions:min_width=310,max_width=310,min_height=132,max_height=132',
            'name' => 'required',
            'position' => 'required|unique:small_banners,position,'. $id
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $banner = SmallBanner::find($id);
                $banner->name = $request->name;
                $banner->position = $request->position;
                $banner->link = $request->link;

                if( $banner->parent_id != 0 ){
                    $banner->parent_id = $request->banner_id;
                }
                
                if( $request->image ){
                    if( File::exists('images/smallbanner/'. $banner->image) ){
                        File::delete('images/smallbanner/'. $banner->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/smallbanner/'.$img);
                    Image::make($image)->save($location);
                    $banner->image = $img;
                }
                if( $banner->save() ){
                    return response()->json(['update' => 'Updated'], 200);
                }
            }   
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }


    //delete modal
    public function delete_modal($id){
        $banner = SmallBanner::find($id);
        return view("backend.pages.smallbanner.modals.delete", compact("banner"));
    }

    //delete
    public function delete($id){
        try{
            $banner = SmallBanner::find($id);
            if( File::exists('images/smallbanner/'. $banner->image) ){
                File::delete('images/smallbanner/'. $banner->image);
            }
            if( $banner->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }   
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
        
    }
}

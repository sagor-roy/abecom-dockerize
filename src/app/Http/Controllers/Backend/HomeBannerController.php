<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class HomeBannerController extends Controller
{
    public function index(){
        return view('backend.pages.homebanner.manage');
    }

    public function data(){
        $coupon = HomeBanner::orderBy('position', 'asc')->get();

        return DataTables::of($coupon)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function (HomeBanner $homebanner) {
            $url = asset('images/homebanner/'.$homebanner->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->addColumn('action', function (HomeBanner $homebanner) {
            return '
            <button type="button" data-content="'.route('home.banner.edit', $homebanner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('home.banner.delete.modal', $homebanner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|dimensions:min_width=832,max_width=832,min_height=410,max_height=410',
            'name' => 'required',
            'position' => 'required|unique:home_banners,position,'
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $homebanner = new HomeBanner();
            $homebanner->position = $request->position;
            $homebanner->name = $request->name;
            if( $request->image ){
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/homebanner/'.$img);
                Image::make($image)->save($location);
                $homebanner->image = $img;
            }

            if( $homebanner->save() ){
                return response()->json(['create' => 'Image added'], 200);
            }
        }
    }

    public function edit($id){
        $homebanner = HomeBanner::find($id);
        return view('backend.pages.homebanner.modals.edit', compact('homebanner'));
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'dimensions:min_width=832,max_width=832,min_height=410,max_height=410',
            'name' => 'required',
            'position' => 'required|unique:home_banners,position,'.$id,
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            $homebanner = HomeBanner::find($id);
            $homebanner->position = $request->position;
            $homebanner->name = $request->name;
            if( $request->image ){
                if( File::exists('images/homebanner/'. $homebanner->image) ){
                    File::delete('images/homebanner/'. $homebanner->image);
                }
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/homebanner/'.$img);
                Image::make($image)->save($location);
                $homebanner->image = $img;
            }

            if( $homebanner->save() ){
                return response()->json(['update' => 'Updated successfully'], 200);
            }
        }
        
    }

    public function delete_modal($id){
        $homebanner = HomeBanner::find($id);
        return view('backend.pages.homebanner.modals.delete', compact('homebanner'));
    }

    public function delete($id){
        $homebanner = HomeBanner::find($id);
        if( File::exists('images/homebanner/'. $homebanner->image) ){
            File::delete('images/homebanner/'. $homebanner->image);
        }
        if( $homebanner->delete() ){
            return response()->json(['delete' => 'Deleted'], 200);
        }
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AllBanner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class AllBannerController extends Controller
{
    //index page
    public function index(){
        return view("backend.pages.allbanner.manage");
    }

    //data
    public function data(){
        $allbanner = AllBanner::orderBy('position', 'asc')->get();

        return DataTables::of($allbanner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function (AllBanner $allbanner) {
            $url = asset('images/allbanner/'.$allbanner->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->addColumn('action', function (AllBanner $allbanner) {
            return '
            <button type="button" data-content="'.route('banner.edit', $allbanner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('banner.delete_modal', $allbanner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }
    
    public function add_modal(){
        return view("backend.pages.allbanner.modals.add");
    }

    //add
    public function add(Request $request){

        if( $request->type == "Offer" ){
            $validator = Validator::make($request->all(),[
                "image" => "required|dimensions:min_width=1150,min_width=1150,min_height=400,max_height=400",
                "type" => "required",
                "name" => "required",
                "position" => "required",
                "link" => "required",
                "button" => "required",
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[
                "image" => "required|dimensions:min_width=1150,min_width=1150,min_height=400,max_height=400",
                "type" => "required",
                "name" => "required",
                "position" => "required",
            ]);
        }
        

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $allbanner = new AllBanner();
                if( $request->image ){
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/allbanner/'.$img);
                    Image::make($image)->save($location);
                    $allbanner->image = $img;
                }
                $allbanner->name = $request->name;
                $allbanner->type = $request->type;
                $allbanner->position = $request->position;
                $allbanner->link = $request->link ?? null;
                $allbanner->button = $request->button ?? null;
                if( $allbanner->save() ){
                    return response()->json(['create' => 'Created'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //edit modal
    public function edit($id){
        $allbanner = AllBanner::find($id);
        return view("backend.pages.allbanner.modals.edit", compact("allbanner"));
    }

    //update
    public function update(Request $request, $id){
        if( $request->type == "Offer" ){
            $validator = Validator::make($request->all(),[
                "image" => "dimensions:min_width=1150,min_width=1150,min_height=400,max_height=400",
                "type" => "required",
                "name" => "required",
                "position" => "required",
                "link" => "required",
                "button" => "required",
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[
                "image" => "dimensions:min_width=1150,min_width=1150,min_height=400,max_height=400",
                "type" => "required",
                "name" => "required",
                "position" => "required",
            ]);
        }
        

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $allbanner = AllBanner::find($id);
                if( $request->image ){
                    if( File::exists('images/allbanner/'. $allbanner->image) ){
                        File::delete('images/allbanner/'. $allbanner->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/allbanner/'.$img);
                    Image::make($image)->save($location);
                    $allbanner->image = $img;
                }
                $allbanner->name = $request->name;
                $allbanner->type = $request->type;
                $allbanner->position = $request->position;
                $allbanner->link = $request->link ?? null;
                $allbanner->button = $request->button ?? null;
                if( $allbanner->save() ){
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
        $allbanner = AllBanner::find($id);
        return view("backend.pages.allbanner.modals.delete", compact("allbanner"));
    }

    //delete
    public function delete(Request $request, $id){
        try{
            $allbanner = AllBanner::find($id);
            if( File::exists('images/allbanner/'. $allbanner->image) ){
                File::delete('images/allbanner/'. $allbanner->image);
            }
            if( $allbanner->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    //index page
    public function index(){
        return view("backend.pages.allpages.about.index");
    }

    //data
    public function data(){
        $about = About::all();

        return DataTables::of($about)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function (About $about) {
            $url = asset('images/'.$about->image);

            return "<img src='".$url."' width='50px' style='background: #000000;' />";
        })
        ->editColumn("content_one", function(About $about){
            return  Str::limit($about->content_one, 50, '...') ;
        })
        ->editColumn("content_two", function(About $about){
            return  Str::limit($about->content_two, 50, '...') ;
        })
        ->addColumn('action', function (About $about) {
            return '
            <button type="button" data-content="'.route('about.edit', $about->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //edit modal
    public function edit($id){
        $about = About::find($id);
        return view("backend.pages.allpages.about.modals.edit", compact("about"));
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "image" => 'dimensions:min_width=269,max_width=269,min_height=248,max_height=248',
            "title_one" => 'required',
            "title_two" => 'required',
            "description_one" => 'required',
            "description_two" => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $about = About::find($id);
                if( $request->image ){
                    if( File::exists('images/'. $about->image) ){
                        File::delete('images/'. $about->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/'.$img);
                    Image::make($image)->save($location);
                    $about->image = $img;
                }
                $about->title_one = $request->title_one;
                $about->title_two = $request->title_two;
                $about->description_one = $request->description_one;
                $about->description_two = $request->description_two;
                if( $about->save() ){
                    return response()->json(['update' => "Updated"], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
}

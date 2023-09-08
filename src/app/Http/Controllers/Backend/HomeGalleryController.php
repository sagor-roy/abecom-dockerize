<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class HomeGalleryController extends Controller
{
    public function index()
    {
        return view('backend.pages.homegallery.manage');
    }


    //data
    public function data(){
        $homegallery = HomeGallery::orderBy('id', 'desc')->get();

        return DataTables::of($homegallery)
        ->rawColumns(['action','image'])
        ->editColumn('image', function (HomeGallery $homegallery) {
            $url = asset('images/homegallery/'.$homegallery->image);

            return "<img src='".$url."' width='50px' />  <br>
            <p>URL : $homegallery->url</p>
            ";
        })
        ->addColumn('action', function (HomeGallery $homegallery) {
            return '
            <button type="button" data-content="'.route('home.gallery.edit', $homegallery->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            
            ';
        })
        ->make(true);
    }


    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png|',
            'position' => 'required|unique:home_galleries,position,',
            'url' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $homegallery = new HomeGallery();
        $homegallery->position = $request->position;
        $homegallery->url = $request->url;

        if ($request->image) {
            $image = $request->file('image');
            $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/homegallery/'.$img);
            Image::make($image)->save($location);
            $homegallery->image = $img;
        }

        if( $homegallery->save() ){
            return response()->json(['create' => 'Created'], 200);
        }
    }


    //edit
    public function edit($id){
        $homegallery = HomeGallery::find($id);
        return view('backend.pages.homegallery.modals.edit', compact('homegallery'));
    }

    //update
    public function update(Request $request, $id){
        $homegallery = HomeGallery::find($id);
        if( $homegallery->position == 1 ){
            $validator = Validator::make($request->all(), [
                'image' => 'dimensions:min_width=705,min_width=705,min_height=300,max_height=300',
                'position' => 'required|unique:home_galleries,position,'. $id,
                'url' => 'required',
            ]);
        }
        elseif( $homegallery->position == 2  ){
            $validator = Validator::make($request->all(), [
                'image' => 'dimensions:min_width=335,min_width=335,min_height=300,max_height=300',
                'position' => 'required|unique:home_galleries,position,'. $id,
                'url' => 'required',
            ]);
            if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        }
        elseif( $homegallery->position == 3  ){
            $validator = Validator::make($request->all(), [
                'image' => 'dimensions:min_width=335,min_width=335,min_height=300,max_height=300',
                'position' => 'required|unique:home_galleries,position,'. $id,
                'url' => 'required',
            ]);
        }
        elseif( $homegallery->position == 4  ){
            $validator = Validator::make($request->all(), [
                'image' => 'dimensions:min_width=705,min_width=705,min_height=300,max_height=300',
                'position' => 'required|unique:home_galleries,position,'. $id,
                'url' => 'required',
            ]);
        }
        elseif( $homegallery->position == 5  ){
            $validator = Validator::make($request->all(), [
                'image' => 'dimensions:min_width=493,min_width=493,min_height=600,max_height=600',
                'position' => 'required|unique:home_galleries,position,'. $id,
                'url' => 'required',
            ]);
        }
        

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            
            $homegallery->position = $request->position;
            $homegallery->url = $request->url;
            if ($request->image) {
                if( File::exists('images/homegallery/'. $homegallery->image) ){
                    File::delete('images/homegallery/'. $homegallery->image);
                }
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/homegallery/'.$img);
                Image::make($image)->save($location);
                $homegallery->image = $img;
            }
            if( $homegallery->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }


    //delete modal
    public function delete_modal($id){
        $homegallery = HomeGallery::find($id);
        return view('backend.pages.homegallery.modals.delete', compact('homegallery'));
    }

    //delete
    public function delete($id){
        $homegallery = HomeGallery::find($id);
        if( File::exists('images/homegallery/'. $homegallery->image) ){
            File::delete('images/homegallery/'. $homegallery->image);
        }
        if( $homegallery->delete() ){
            return response()->json(['delete'=>'Deleted'], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutCertificate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AboutCertificateController extends Controller
{
    //data
    public function data(){
        $about_certificate = AboutCertificate::all();

        return DataTables::of($about_certificate)
        ->rawColumns(['action', 'image'])
        ->editColumn("image", function(AboutCertificate $about_certificate){
            $url = asset("images/certificate/". $about_certificate->image);
            return "
                <img src='$url' width='100px'>
            ";
        })
        ->addColumn('action', function (AboutCertificate $about_certificate) {
            return '
            <button type="button" data-content="'.route('about.certificate.edit', $about_certificate->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('about.certificate.delete_modal', $about_certificate->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //about certificate
    public function add_modal(){
        return view("backend.pages.allpages.about.modals.add_certificate");
    }

    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            "image" => "required|dimensions:min_width=597,max_width=597,min_height=843,max_height=843",
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $certificate = new AboutCertificate();
                if( $request->image ){
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/certificate/'.$img);
                    Image::make($image)->save($location);
                    $certificate->image = $img;
                }
                $certificate->link = $request->link ?? null;
                if( $certificate->save() ){
                    return response()->json(['create' => "Added"], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //edit modal
    public function edit($id){
        $certificate = AboutCertificate::find($id);
        return view("backend.pages.allpages.about.modals.edit_certificate", compact("certificate"));
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "image" => "dimensions:min_width=597,max_width=597,min_height=843,max_height=843",
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $certificate = AboutCertificate::find($id);
                if( $request->image ){
                    if( File::exists('images/certificate/'. $certificate->image) ){
                        File::delete('images/certificate/'. $certificate->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/certificate/'.$img);
                    Image::make($image)->save($location);
                    $certificate->image = $img;
                }
                $certificate->link = $request->link ?? null;
                if( $certificate->save() ){
                    return response()->json(['update' => "Updated"], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //delete modal
    public function delete_modal($id){
        $certificate = AboutCertificate::find($id);
        return view("backend.pages.allpages.about.modals.delete_certificate", compact("certificate"));
    }

    //delete
    public function delete($id){
        try{
            $certificate = AboutCertificate::find($id);
            if( File::exists('images/certificate/'. $certificate->image) ){
                File::delete('images/certificate/'. $certificate->image);
            }
            if( $certificate->delete() ){
                return response()->json(['delete' => "Deleted"], 200);
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

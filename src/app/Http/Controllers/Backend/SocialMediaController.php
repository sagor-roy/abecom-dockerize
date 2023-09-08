<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaController extends Controller
{
    public function index(){
        return view('backend.pages.media.manage');
    }

    public function data(Request $request)
    {
        $media = SocialMedia::orderBy('id', 'desc')->get();

        return DataTables::of($media)
        ->rawColumns(['action','icon'])
        ->editColumn('icon', function(SocialMedia $media){
            return "<i class=".$media->icon."></i>";
        })
        ->addColumn('action', function (SocialMedia $media) {
            return '
            <button type="button" data-content="'.route('media.edit', $media->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('media.delete.modal', $media->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //add start
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'icon' => 'required|unique:social_media,icon,',
            'link' => 'required|unique:social_media,link,'
        ]); 

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $media = new SocialMedia();
            $media->icon  = $request->icon;
            $media->link  = $request->link;
            if( $media->save() ){
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }


    //edit
    public function edit($id){
        $media = SocialMedia::find($id);
        return view('backend.pages.media.modals.edit', compact('media'));
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'icon' => 'required|unique:social_media,icon,'.$id,
            'link' => 'required|unique:social_media,link,'.$id
        ]); 

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $media = SocialMedia::find($id);
            $media->icon  = $request->icon;
            $media->link  = $request->link;
            if( $media->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }

    //delete modal
    public function delete_modal($id){
        $media = SocialMedia::find($id);
        return view('backend.pages.media.modals.delete', compact('media'));
    }

    //delete
    public function delete($id){
        $media = SocialMedia::find($id);
        if( $media->delete() ){
            return response()->json(['delete' => 'Deleted'], 200);
        }
    }
}

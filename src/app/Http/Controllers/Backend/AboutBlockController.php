<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutBlock;
use Exception;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AboutBlockController extends Controller
{
    //data
    public function data(){
        $about_block = AboutBLock::all();

        return DataTables::of($about_block)
        ->rawColumns(['action', 'icon'])
        ->editColumn("icon", function(AboutBLock $about_block){
            $box = "";
            if(  $about_block->text == null ){
                $box = "<i class='$about_block->icon'></i>";
            }elseif( $about_block->icon == null ){
                $box = $about_block->text;
            }
            return "
            <p>$box</p>
            <p>$about_block->title</p>
            <p>$about_block->description</p>
            ";
        })
        ->addColumn('action', function (AboutBLock $about_block) {
            return '
            <button type="button" data-content="'.route('about.block.edit', $about_block->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('about.block.delete.modal', $about_block->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //add modal
    public function add_modal(){
        return view("backend.pages.allpages.about.modals.add_block");
    }

    //add
    public function add(Request $request){
        if( $request->true_false == false ){
            $validator = Validator::make($request->all(),[
                "icon" => "required",
                "title" => "required",
                "description" => "required",
                "position" => "unique:about_blocks,position,"
            ]);
        }elseif( $request->true_false == true ){
            $validator = Validator::make($request->all(),[
                "text" => "required",
                "title" => "required",
                "description" => "required",
                "position" => "unique:about_blocks,position,"
            ]);
        }

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $about_block = new AboutBlock();
                if( $request->true_false == false ){
                    $about_block->icon = $request->icon;
                    $about_block->text = null;
                }
                elseif( $request->true_false == true ){
                    $about_block->icon = null ;
                    $about_block->text = $request->text;
                }
                $about_block->title = $request->title;
                $about_block->description = $request->description;
                $about_block->position = $request->position;
                if( $about_block->save() ){
                    return response()->json(['create' => 'Added'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

    }

    //edit
    public function edit($id){
        $about_block = AboutBlock::find($id);
        return view("backend.pages.allpages.about.modals.edit_block", compact("about_block"));
    }

    //update
    public function update(Request $request, $id){
        if( $request->true_false == false ){
            $validator = Validator::make($request->all(),[
                "icon" => "required",
                "title" => "required",
                "description" => "required",
                "position" => "unique:about_blocks,position,". $id
            ]);
        }elseif( $request->true_false == true ){
            $validator = Validator::make($request->all(),[
                "text" => "required",
                "title" => "required",
                "description" => "required",
                "position" => "unique:about_blocks,position,". $id
            ]);
        }

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $about_block = AboutBlock::find($id);
                if( $request->true_false == false ){
                    $about_block->icon = $request->icon;
                    $about_block->text = null;
                }
                elseif( $request->true_false == true ){
                    $about_block->icon = null ;
                    $about_block->text = $request->text;
                }
                $about_block->title = $request->title;
                $about_block->description = $request->description;
                $about_block->position = $request->position;
                if( $about_block->save() ){
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
        try{
            $about_block = AboutBlock::find($id);
            return view("backend.pages.allpages.about.modals.delete_block", compact("about_block"));
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }

    }

    //delete
    public function delete($id){
        try{
            $about_block = AboutBlock::find($id);
            if( $about_block->delete() ){
                return response()->json(['delete' => 'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

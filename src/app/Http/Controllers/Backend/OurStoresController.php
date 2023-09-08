<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OurStores;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OurStoresController extends Controller
{
    //index
    public function index(){
        return view("backend.pages.allpages.stores.manage");
    }

    //data
    public function data(){
        $stores = OurStores::orderBy('position', 'asc')->where("parent_id",0)->get();

        return DataTables::of($stores)
        ->rawColumns(['action','location'])
        ->editColumn('location', function(OurStores $stores){
            $data = [];
            foreach( $stores->child as $store ){
                array_push($data, $store->name);
            }
            return $data;
        })
        ->addColumn('action', function (OurStores $stores) {
            return '
            <button type="button" data-content="'.route('stores.edit', $stores->id).'" data-target="#largeModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('stores.delete_modal', $stores->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "position" => "required|unique:our_stores,position",
            "showroom_name.*" => "required",
            "hotline.*" => "required",
            "phone.*" => "required",
            "address.*" => "required",
            "map.*" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $stores = new OurStores();
                $stores->name = $request->title;
                $stores->position = $request->position;
                $stores->parent_id = 0;

                if( $stores->save() ){
                    $id = $stores->id;
                    foreach( $request["showroom_name"] as $key => $value ){
                        $stores = new OurStores();
                        $stores->parent_id = $id;
                        $stores->name = $request["showroom_name"][$key];
                        $stores->hotline = $request["hotline"][$key];
                        $stores->phone = $request["phone"][$key];
                        $stores->address = $request["address"][$key];
                        $stores->map = $request["map"][$key];
                        $stores->save();
                    }
                    return response()->json(["create" => "created"], 200);
                }
                
                
            }
            catch( Exception $e ){
                return response()->json(["error" => $e->getMessage()], 200);
            }
        }
    }

    //edit
    public function edit($id){
        $stores = OurStores::find($id);
        return view("backend.pages.allpages.stores.modals.edit", compact("stores"));
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "position" => "required|unique:our_stores,position,". $id,
            "showroom_name.*" => "required",
            "hotline.*" => "required",
            "phone.*" => "required",
            "address.*" => "required",
            "map.*" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $stores = OurStores::find($id);
                $stores->name = $request->title;
                $stores->position = $request->position;
                $stores->parent_id = 0;

                if( $stores->save() ){
                    $id = $stores->id;
                    foreach( $stores->child as $child ){
                        $child->delete();
                    }
                    foreach( $request["showroom_name"] as $key => $value ){
                        $stores = new OurStores();
                        $stores->parent_id = $id;
                        $stores->name = $request["showroom_name"][$key];
                        $stores->hotline = $request["hotline"][$key];
                        $stores->phone = $request["phone"][$key];
                        $stores->address = $request["address"][$key];
                        $stores->map = $request["map"][$key];
                        $stores->save();
                    }
                    return response()->json(["update" => "Update"], 200);
                }
                
                
            }
            catch( Exception $e ){
                return response()->json(["error" => $e->getMessage()], 200);
            }
        }
    }

    //delete modal
    public function delete_modal($id){
        $stores = OurStores::find($id);
        return view("backend.pages.allpages.stores.modals.delete", compact("stores"));

    }

    //delete
    public function delete($id){
        try{
            $stores = OurStores::find($id);
            foreach( $stores->child as $child ){
                $child->delete();
            }
            if( $stores->delete() ){
                return response()->json(["delete" => "Deleted"], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(["error" => $e->getMessage()], 200);
        }
    }
}

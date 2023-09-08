<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PickUp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PickUpController extends Controller
{
    //index function start
    public function index(){
        return view("backend.pages.pickup.index");
    }
    //index function end

    //data function start
    public function data(){
        $pickup = PickUp::select("id","name","is_active")->get();
        return DataTables::of($pickup)
        ->rawColumns(['action', 'status'])
        ->editColumn('status', function (PickUp $pickup) {
            if ($pickup->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (PickUp $pickup) {
            return '
            <button type="button" data-content="'.route('pickup.point.edit.modal', $pickup->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }
    //data function end


    //add modal function start
    public function add_modal(){
        return view("backend.pages.pickup.modals.add");
    }
    //add modal function end

    //add function start
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:pick_ups,name",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $pickup = new PickUp();
                $pickup->name = $request->name;
                $pickup->is_active = true;
                if( $pickup->save() ){
                    return response()->json(['success' => 'New Pickup Point Created'],200);
                }
            }
            catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
    //add function end

    //edit modal function start
    public function edit_modal($id){
        $pickup = PickUp::where("id", $id)->select("id","name","is_active")->first();
        return view("backend.pages.pickup.modals.edit", compact("pickup"));
    }
    //edit modal function end

    //edit function start
    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:pick_ups,name,". $id,
            "is_active" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $pickup = PickUp::find($id);
                $pickup->name = $request->name;
                $pickup->is_active = $request->is_active;
                if( $pickup->save() ){
                    return response()->json(['success' => 'Pickup Point Updated'],200);
                }
            }
            catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
    //edit function end
}

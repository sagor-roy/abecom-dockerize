<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourierController extends Controller
{
    public function index(){
        return view('backend.pages.courier.manage');
    }

    public function data(Request $request)
    {
        $courier = Courier::orderBy('id', 'desc')->get();
        return DataTables::of($courier)
        ->rawColumns(['action', 'status'])
        ->editColumn('status', function (Courier $courier) {
            if ($courier->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Courier $courier) {
            return '
            <button type="button" data-content="'.route('courier.edit', $courier->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }


    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'courier' => 'required|unique:couriers,courier,'
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $courier = new courier();
            $courier->courier = $request->courier;
            $courier->is_active = true;
            if( $courier->save() ){
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    //edit
    public function edit($id){
        $courier = Courier::find($id);
        return view('backend.pages.courier.modals.edit', compact('courier'));
    }


    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'courier' => 'required|unique:couriers,courier,'. $id
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $courier = Courier::find($id);
            $courier->courier = $request->courier;
            $courier->is_active = $request->is_active;
            if( $courier->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

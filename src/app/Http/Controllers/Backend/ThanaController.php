<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ThanaController extends Controller
{

    public function index(){
        $cities = City::where('is_active', true)->get();

        return view('backend.pages.thana.manage', compact('cities'));
    }


    public function data()
    {
        $thana = Thana::with('city')->orderBy('id', 'desc')->get();
        return DataTables::of($thana)
        ->rawColumns(['action', 'status'])
        ->editColumn('status', function (Thana $thana) {
            if ($thana->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Thana $thana) {
            return '
            <button type="button" data-content="'.route('thana.edit', $thana->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'city' => 'required|integer',
            'thana' => 'required|string|max:190|unique:thanas'
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $thana = new Thana();
            $thana->city_id = $request->city;
            $thana->thana = $request->thana;
            $thana->is_active = true;
            if( $thana->save() ){
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    public function edit($id)
    {
        $cities = City::where('is_active', true)->get();
        $thana = Thana::with('city')->find($id);
        return view('backend.pages.thana.modals.edit', compact('thana', 'cities'));
    }


    //update
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'thana' => 'required|string|max:190|unique:thanas,thana,'.$id,
            'city' => 'required|integer',

        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{

            $thana = Thana::find($id);
            $thana->city_id = $request->city;
            $thana->thana = $request->thana;
            $thana->is_active = $request->is_active;
            if( $thana->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

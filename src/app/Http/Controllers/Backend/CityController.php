<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(){
        return view('backend.pages.city.manage');
    }

    public function data(Request $request)
    {
        $city = City::orderBy('id', 'desc')->get();
        return DataTables::of($city)
        ->rawColumns(['action', 'status'])
        ->editColumn('status', function (City $city) {
            if ($city->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (City $city) {
            return '
            <button type="button" data-content="'.route('city.edit', $city->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }


    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'city' => 'required|unique:cities,city,'
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $city = new City();
            $city->city = $request->city;
            $city->is_active = true;
            if( $city->save() ){
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    //edit
    public function edit($id){
        $city = City::find($id);
        return view('backend.pages.city.modals.edit', compact('city'));
    }


    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'city' => 'required|unique:cities,city,'. $id
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $city = City::find($id);
            $city->city = $request->city;
            $city->is_active = $request->is_active;
            if( $city->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

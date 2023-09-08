<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Varient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VarientController extends Controller
{
    public function index()
    {
        return view('backend.pages.varient.manage');
    }

    public function data()
    {
        $varient = Varient::orderBy('id', 'desc')->get();

        return DataTables::of($varient)
        ->rawColumns(['action', 'is_active'])
        ->editColumn('is_active', function (Varient $varient) {
            if ($varient->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Varient $varient) {
            return '
            <button type="button" data-content="'.route('varient.edit', $varient->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:varients,name,',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $varient = new Varient();
            $varient->name = $request->name;
            $varient->is_active = true;
            if ($varient->save()) {
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    public function edit($id)
    {
        $varient = Varient::find($id);

        return view('backend.pages.varient.modals.edit', compact('varient'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:varients,name,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $varient = Varient::find($id);
            $varient->name = $request->name;
            $varient->is_active = $request->is_active;
            if ($varient->save()) {
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

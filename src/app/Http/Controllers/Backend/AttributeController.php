<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    public function index()
    {
        return view('backend.pages.attribute.manage');
    }

    public function data(Request $request)
    {
        $attribute = Attribute::orderBy('id', 'desc')->get();

        return DataTables::of($attribute)
        ->rawColumns(['action'])
        ->addColumn('action', function (Attribute $attribute) {
            return '
            <button type="button" data-content="'.route('attribute.edit', $attribute->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:attributes,name,',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $attribute = new Attribute();
            $attribute->name = $request->name;
            $attribute->slug = Str::slug($request->name);

            if ($attribute->save()) {
                return response()->json(['create' => $attribute], 200);
            }
        }
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);

        return view('backend.pages.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:attributes,name,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $attribute = Attribute::find($id);

            $attribute->name = $request->name;
            $attribute->slug = Str::slug($request->name);

            if ($attribute->save()) {
                return response()->json(['update' => $attribute], 200);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TwoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TwoBannerController extends Controller
{
    public function index()
    {
        return view('backend.pages.twobanner.manage');
    }

    //data
    public function data()
    {
        $two_banner = TwoBanner::orderBy('position', 'asc')->get();

        return DataTables::of($two_banner)
        ->rawColumns(['action', 'image'])
        ->editColumn('image', function (TwoBanner $two_banner) {
            $url = asset('images/twobanner/'.$two_banner->image);

            return "<img src='".$url."' width='50px' />";
        })
        ->addColumn('action', function (TwoBanner $two_banner) {
            return '
            <button type="button" data-content="'.route('two.banner.edit', $two_banner->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('two.banner.delete.modal', $two_banner->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //add
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|dimensions:min_width=1920px,max_width=1920px,min_height=444px,max_height=444px',
            'position' => 'required|min:1|unique:two_banners,position,',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $two_banner = new TwoBanner();
            if ($request->image) {
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/twobanner/'.$img);
                Image::make($image)->save($location);
                $two_banner->image = $img;
            }
            $two_banner->position = $request->position;
            $two_banner->name = $request->name;
            if ($two_banner->save()) {
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    //edit
    public function edit($id)
    {
        $two_banner = TwoBanner::find($id);

        return view('backend.pages.twobanner.modals.edit', compact('two_banner'));
    }

    //update
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'image' => 'dimensions:min_width=1920px,max_width=1920px,min_height=444px,max_height=444px',
            'position' => 'required|min:1|unique:two_banners,position,'.$id,
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $two_banner = TwoBanner::find($id);
            if ($request->image) {
                if (File::exists('images/twobanner/'.$two_banner->image)) {
                    File::delete('images/twobanner/'.$two_banner->image);
                }
                $image = $request->file('image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/twobanner/'.$img);
                Image::make($image)->save($location);
                $two_banner->image = $img;
            }
            $two_banner->position = $request->position;
            $two_banner->name = $request->name;
            if ($two_banner->save()) {
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }

    //delete modal
    public function delete_modal($id)
    {
        $two_banner = TwoBanner::find($id);

        return view('backend.pages.twobanner.modals.delete', compact('two_banner'));
    }

    //delete
    public function delete($id)
    {
        $two_banner = TwoBanner::find($id);
        if (File::exists('images/twobanner/'.$two_banner->image)) {
            File::delete('images/twobanner/'.$two_banner->image);
        }
        if ($two_banner->delete()) {
            return response()->json(['delete' => 'Deleted'], 200);
        }
    }
}

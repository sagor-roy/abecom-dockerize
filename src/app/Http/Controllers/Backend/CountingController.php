<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Counting;
use Illuminate\Http\Request;

class CountingController extends Controller
{
    public function index()
    {
        return view('backend.pages.count.manage');
    }

    //edit
    public function edit(Request $request)
    {
        $request->validate([
            'left_category' => 'required|numeric',
            'slider_category' => 'required|numeric',
            'home_offer' => 'required|numeric',
            'id' => 'required|numeric',
        ]);
        $count = Counting::find($request->id);
        $count->left_category = $request->left_category;
        $count->slider_category = $request->slider_category;
        $count->home_offer = $request->home_offer;
        if ($count->save()) {
            $request->session()->flash('success', 'Updated successfully');

            return back();
        }
    }
}

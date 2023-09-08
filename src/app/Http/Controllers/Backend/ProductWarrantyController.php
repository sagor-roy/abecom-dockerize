<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductWarranty;
use Illuminate\Http\Request;

class ProductWarrantyController extends Controller
{
    //index function
    public function index()
    {
        $product_warranty = ProductWarranty::first();
        return view('backend.pages.product_warranty.index', compact('product_warranty'));
    }

    // update function
    public function update(Request $request, $id)
    {
        $product_warranty = ProductWarranty::find(decrypt($id));
        $product_warranty->product_warranty = $request->product_warranty;
        if ($product_warranty->save()) {
            // $request->session()->flash('success', 'Product Warranty Updated successfully');

            return redirect()->back()->with('success', 'Product Warranty Updated successfully');

            // return back();
        }
    }


}

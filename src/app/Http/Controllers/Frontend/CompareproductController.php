<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompareproductController extends Controller
{
    public function compare()
    {
        return view('frontend.pages.compare');
    }

    public function product_compare(Request $request)
    {
        // return $request->session()->forget('compare');

        $product = Product::find($request->compare_id);

        $compare = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => asset('images/product/'.$product->thumbnail),
            'price' => $product->offer_price ? $product->offer_price : $product->price,
            'url' => route('productdetails', $product->slug),
            'specification' => $product->specification 
        ];
        

        $newCompare = [];
        $exist = false;
        if ($request->session()->get('compare')) {
            $sessionCompare = $request->session()->get('compare');

            foreach ($sessionCompare as $single_compare) {
                foreach ($single_compare as $single_c) {
                    if ($single_c['id'] == $compare['id']) {
                        return response()->json(['compare_already_added' => 'added'], 200);
                    }
                }
            }

            array_push($newCompare, $compare);
        } else {
            array_push($newCompare, $compare);
        }

        $request->session()->push('compare', $newCompare);

        return $request->session()->get('compare');
    }

    public function get_compare(Request $request)
    {
        return $request->session()->get('compare');
    }

    public function delete_compare($key, Request $request)
    {
        $compares = $this->get_compare($request);
        $newCompare = [];
        if ($compares) {
            foreach ($compares as $keys => $single_compare) {
                if ($keys == $key) {
                    unset($compares[$key]);
                    if ($compares) {
                        $request->session()->forget('compare');
                        foreach ($compares as $new_compare) {
                            $request->session()->push('compare', $new_compare);
                        }
                    } else {
                        $request->session()->forget('compare');
                    }
                }
            }
        }

        return $request->session()->get('compare');
    }
}

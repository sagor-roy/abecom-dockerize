<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function product_wishlist($id)
    {
        if (auth('customer')->check()) {
            $product = Product::find($id);

            $wishlist_check = Wishlist::where('product_id', $product->id)->where('customer_id', auth('customer')->user()->id)->first();

            if ($wishlist_check) {
                return response()->json(['wishlist_added_already' => 'Product already added'], 200);
            } else {
                $wishlist = new Wishlist();
                $wishlist->product_id = $product->id;
                $wishlist->customer_id = auth('customer')->user()->id;

                if ($wishlist->save()) {
                    return response()->json(['wishlist_added' => 'Product added to the wishlist'], 200);
                }
            }
        } else {
            return response()->json(['login_first' => 'Please Login First'], 200);
        }
    }

    public function remove_wishlist(Request $request, $id)
    {
        $wishlist = Wishlist::find($id);

        if ($wishlist->delete()) {
            $request->session()->flash('success', 'Product removed from wishlist');

            return redirect()->route('profile', auth('customer')->user()->id);
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function add_coupon($code, Request $request)
    {
        $coupon = Coupon::where('code', $code)->where('is_active', true)->first();

        if ($coupon) {

            $carts = $request->session()->get('cart');

            foreach( $carts as $cart ){
                $product = Product::find($cart['id']);
                if( $product->offer_status == true ){
                    return response()->json(['error' => 'You cann\'t add coupon on offer product '], 200);
                }
            }

            $total = 0;
            $shipping_charge = 0;
            foreach ($request->session()->get('cart') as $single_cart) {
                $total += ($single_cart['quantity'] * $single_cart['unit_price']);
                if( $single_cart['delivery_charge'] > $shipping_charge ){
                    $shipping_charge = $single_cart['delivery_charge'];
                }
            }
            if (auth('customer')->user()->balance > $total) {
                return response()->json(['cannot_add' => 'You cann"t add coupon code now'], 200);
            }

            if (auth('customer')->check()) {
                if (auth('customer')->user()->balance > $total) {
                    $total_after_discount = 0;
                } else {
                    $total_after_discount = ($total - floor(($coupon->percentage / 100) * $total)) - auth('customer')->user()->balance;
                }
            } else {
                $total_after_discount = $total - floor(($coupon->percentage / 100) * $total);
            }
            return response()->json(['discount_get' => $total_after_discount], 200);
        } else {
            return response()->json(['not_found' => 'This coupon code is not valid'], 200);
        }
    }

    public function get_price(Request $request)
    {
        $total = 0;
        foreach ($request->session()->get('cart') as $single_cart) {
            $total += ($single_cart['quantity'] * $single_cart['unit_price']);
        }
        if (auth('customer')->check()) {
            $balance = auth('customer')->user()->balance;
        } else {
            $balance = 0;
        }

        return response()->json(['total' => $total, 'balance' => $balance], 200);
    }
}

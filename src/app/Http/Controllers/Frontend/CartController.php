<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($varient, $quantity, $id, Request $request)
    {

        // return $request->session()->forget('cart');
        $product = Product::find($id);

        if ($product->qty == null) {
            if (Product::find($id)->product_attribute->where('id', $varient)->first()) {
                $product_qty = Product::find($id)->product_attribute->where('id', $varient)->first()->qty;
            } else {
                $product_qty = 0;
            }
        } else {
            $product_qty = $product->qty;
        }

        if ($product) {
            if ($quantity < 1) {
                return response()->json(['cartError' => 'Please select at least one product'], 200);
            } else {
                if ($product->product_attribute->count() > 0) {
                    $cart = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => asset('images/product/'.$product->thumbnail),
                        'unit_price' => $product->offer_price ? $product->offer_price : $product->price,
                        'url' => route('productdetails', $product->slug),
                        'quantity' => $quantity,
                        'varient' => $varient,
                        'delivery_charge' => $product->delivery_charge->amount,
                        'varient_name' => ProductAttribute::find($varient)->value ? ProductAttribute::find($varient)->value : 'No product varient found',
                    ];
                } else {
                    $cart = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => asset('images/product/'.$product->thumbnail),
                        'unit_price' => $product->offer_price ? $product->offer_price : $product->price,
                        'url' => route('productdetails', $product->slug),
                        'quantity' => $quantity,
                        'varient' => $varient,
                        'delivery_charge' => $product->delivery_charge->amount,
                        'varient_name' => 'No product varient found',
                    ];
                }

                $newCart = [];
                $exist = false;
                if ($request->session()->get('cart')) {
                    $sessionCart = $request->session()->get('cart');

                    if (count($sessionCart) > 4) {
                        return response()->json(['cartError' => 'Add To Cart Max Limit 5'], 200);
                    } else {

                        foreach ($sessionCart as $singleCart) {
                            if ($singleCart['id'] == $cart['id'] && $singleCart['varient'] == $cart['varient']) {
                                $singleCart['quantity'] += $quantity;
                                $exist = true;
                            }

                            if ($singleCart['quantity'] > 5) {
                                return response()->json(['cartError' => 'Add To Cart Max Quantity Limit 5'], 200);
                            }

                            if ($singleCart['quantity'] > $product_qty) {
                                return response()->json(['stock_not_available' => 'Stock not available'], 200);
                            }
                            array_push($newCart, $singleCart);
                        }

                        if (!$exist) {

                            if ($cart['quantity'] > 5) {
                                return response()->json(['cartError' => 'Add To Cart Max Quantity Limit 5'], 200);
                            }

                            if ($cart['quantity'] > $product_qty) {
                                return response()->json(['stock_not_available' => 'Stock not available'], 200);
                            }
                            array_push($newCart, $cart);
                        }
                    }

                } else {

                    if ($cart['quantity'] > 5) {
                        return response()->json(['cartError' => 'Add To Cart Max Quantity Limit 5'], 200);
                    }

                    if ($cart['quantity'] > $product_qty) {
                        return response()->json(['stock_not_available' => 'Stock not available'], 200);
                    }
                    array_push($newCart, $cart);
                }

                $request->session()->put('cart', $newCart);
                $cartAdded = $request->session()->get('cart');

                return response()->json(['cart_added' => $cartAdded], 200);
            }
        } else {
            return response()->json(['cartError' => 'Product not found'], 200);
        }
    }

    public function get_cart(Request $request)
    {
        // return $request->session()->forget('cart');

        $cart = $request->session()->get('cart');
        if (auth('customer')->check()) {
            $balance = auth('customer')->user()->balance;
        } else {
            $balance = 0;
        }

        return response()->json(['cart' => $cart, 'balance' => $balance], 200);
    }

    //cart plus start
    public function cart_plus($id, $quantity, $varient, Request $request)
    {
        $product = Product::find($id);

        if ($product->qty == null) {
            $product_qty = Product::find($id)->product_attribute->where('id', $varient)->first()->qty;
        } else {
            $product_qty = $product->qty;
        }

        $carts = $request->session()->get('cart');
        $newCart = [];
        if ($carts):
            foreach ($carts as $cart):
                if ($cart['id'] == $id && $cart['varient'] == $varient):

                    if ($cart['quantity'] > 4) {
                        return response()->json(['cartError' => 'Add To Cart Max Quantity Limit 5'], 200);
                    }


                    if ($product_qty > $cart['quantity']) {
                        ++$cart['quantity'];
                    } else {
                        return response()->json(['stock_not_available' => 'Stock not avaiable'], 200);
                    }

        endif;

        array_push($newCart, $cart);
        endforeach;
        endif;

        $request->session()->put('cart', $newCart);

        return $this->get_cart($request);
    }

    //cart minus start
    public function cart_minus($id, $varient, Request $request)
    {
        $carts = $request->session()->get('cart');
        $newCart = [];
        if ($carts):
            foreach ($carts as $cart):
                if ($cart['id'] == $id && $cart['varient'] == $varient):
                    $cart['quantity']--;
        endif;

        array_push($newCart, $cart);
        endforeach;
        endif;

        $request->session()->put('cart', $newCart);

        return $this->get_cart($request);
    }

    //cart remove
    public function cart_remove($id, $varient, Request $request)
    {
        $carts = $request->session()->get('cart');
        $newCart = [];
        if ($carts) {
            foreach ($carts as $cart) {
                if ($cart['id'] != $id) {
                    array_push($newCart, $cart);
                } elseif ($cart['id'] == $id && $cart['varient'] != $varient) {
                    array_push($newCart, $cart);
                }
            }
        }
        $request->session()->put('cart', $newCart);

        return $this->get_cart($request);
    }
}

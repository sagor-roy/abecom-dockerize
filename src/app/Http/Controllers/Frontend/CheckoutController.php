<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if ($request->session()->get('cart') && auth('customer')->check()) {
            if ($request->city) {
                $city = City::find($request->city);
            }
            if ($request->coupon_status == true) {
                if (strtolower($city->city) != 'dhaka' && $request->delivery_type == "Local") {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'coupon_code' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                        'courier' => 'required',
                        'pickup_point' => 'required'
                    ]);
                }
                elseif( strtolower($city->city) == 'dhaka' && $request->delivery_type == "Local" ){
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'coupon_code' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                        'pickup_point' => 'required'
                    ]);
                }
                else{
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'coupon_code' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                    ]);
                }
            }
            else {
                if (strtolower($city->city) != 'dhaka' && $request->delivery_type == "Local") {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                        'courier' => 'required',
                        'pickup_point' => 'required'
                    ]);
                }
                elseif( strtolower($city->city) == 'dhaka' && $request->delivery_type == "Local" ){
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                        'pickup_point' => 'required'
                    ]);
                }
                else{
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                        'city' => 'required|numeric|min:1',
                        'country' => 'required|in:Bangladesh',
                        'address' => 'required',
                        'payment_method' => 'required|min:0|max:1',
                    ]);
                }
            }

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                $order = new Order();
                $order->order_id = rand(00000000, 99999999);
                $order->customer_id = auth('customer')->user()->id;
                $order->name = $request->name;
                $order->phone = $request->phone;
                $order->email = auth('customer')->user()->email;
                $order->city_id = $request->city;
                $order->courier_id = $request->courier ? $request->courier : null;

                $order->country = $request->country;
                $order->shipping_address = $request->address;
                $order->customer_balance = auth('customer')->user()->balance;
                $order->note = $request->note;

                $total = 0;
                $delivery_charge = 0;

                if ($request->city) {
                    $city = City::find($request->city);
                    if (strtolower($city->city) == 'dhaka') {
                        foreach ($request->session()->get('cart') as $single_cart) {
                            $total += ($single_cart['quantity'] * $single_cart['unit_price']);
                            if ($delivery_charge < $single_cart['delivery_charge']) {
                                $delivery_charge = $single_cart['delivery_charge'];
                            }
                        }
                    } else {
                        foreach ($request->session()->get('cart') as $single_cart) {
                            $total += ($single_cart['quantity'] * $single_cart['unit_price']);
                        }
                    }
                } else {
                    return response()->json(['error' => 'City not found'], 200);
                }



                if( $request->delivery_type == "Local" ){
                    $order->delivery_type = 'Local';
                    $order->shipping_charge = 0;
                    $order->pickup_id = $request->pickup_point;
                }
                else{
                    $order->delivery_type = 'Home';
                    $order->shipping_charge = $delivery_charge;
                    $order->pickup_id = null;
                }

                $order->amount = $total;

                //coupon check and validation start
                if ($request->discount_status == true) {
                    $coupon = Coupon::where('code', $request->coupon_code)->where('is_active', true)->first();
                    if ($coupon) {
                        $carts = $request->session()->get('cart');
                        $offer = 0;
                        foreach( $carts as $cart ){
                            $product = Product::find($cart['id']);
                            if( $product->offer_status == true ){
                                ++$offer;
                            }
                        }
                        if( $offer == 0 ){
                            if (auth('customer')->user()->balance > $total) {
                                $order->discount_status = false;
                                $order->amount_after_discount = null;
                                $order->coupon_id = null;
                            } else {
                                $total_after_discount = ($total - floor(($coupon->percentage / 100) * $total));
                                $order->discount_status = true;
                                $order->amount_after_discount = $total_after_discount;
                                $order->coupon_id = $coupon->id;
                            }
                        }else{
                            $order->discount_status = false;
                            $order->amount_after_discount = null;
                            $order->coupon_id = null;
                        }

                    } else {
                        $order->discount_status = false;
                        $order->amount_after_discount = null;
                        $order->coupon_id = null;
                    }
                } else {
                    $order->discount_status = false;
                    $order->amount_after_discount = null;
                    $order->coupon_id = null;
                }
                //coupon check and validation end

                //purshase point
                $customer_balance_check = $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
                if ($customer_balance_check > auth('customer')->user()->balance) {
                    $order->customer->balance = 0;
                    $order->customer->save();
                } else {
                    $order->customer->balance -= $customer_balance_check;
                    $order->customer->save();
                }

                if ($request->payment_method == 0 || $request->payment_method == 2) {
                    return $this->onSpotPayment($request, $order);
                } elseif ($request->payment_method == 1) {
                    return $this->sslCommerz($request, $order);
                }
            }
        } else {
            $request->session()->forget('cart');

            return response()->json(['cart_empty' => 'Your cart is empty'], 200);
        }
    }

    public function onSpotPayment($request, $order)
    {
        if( $request->payment_method == 2 ){
            $order->paid_by = 'Bank';
        }
        else{
            $order->paid_by = 'Cash';
        }
        $order->order_status = 'Pending';
        $order->payment_status = 'Pending';
        $order->is_active = true;
        $order->is_verified = true;

        if ($order->save()) {
            $carts = $request->session()->get('cart');
            foreach ($carts as $cart) {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $cart['id'];
                $order_product->quantity = $cart['quantity'];
                $order_product->unit_price = $cart['unit_price'];
                $order_product->total = $cart['quantity'] * $cart['unit_price'];
                if ($cart['varient'] == 0) {
                    $order_product->product_varient_value_id = null;
                } else {
                    $order_product->product_varient_value_id = $cart['varient'];
                }
                $order_product->is_active = true;
                $order_product->is_delivered = false;
                $order_product->save();
            }

            $request->session()->forget('cart');
            $url = route('profile', $order->customer_id);

            Mail::send('emails.customer_order_mail', ['order' => $order], function ($order) use ($request) {
                $order->from('info.abe83@gmail.com');
                $order->to(auth('customer')->user()->email);
                $order->subject('Your Order Is Placed');
            });

            Mail::send('emails.customer_order_mail', ['order' => $order], function ($order) use ($request) {
                $order->from('info.abe83@gmail.com');
                $order->to('info.abe83@gmail.com');
                $order->subject('Your Order Is Placed');
            });

            return response()->json(['onspot_order_placed' => $url], 200);
        }
    }

    public function sslCommerz($request, $order)
    {
        $order->paid_by = 'Online';
        $order->order_status = 'Pending';
        $order->is_active = true;
        $order->payment_status = 'Pending';
        if ($order->save()) {
            $carts = $request->session()->get('cart');
            foreach ($carts as $cart) {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_id = $cart['id'];
                $order_product->quantity = $cart['quantity'];
                $order_product->unit_price = $cart['unit_price'];
                $order_product->total = $cart['quantity'] * $cart['unit_price'];
                if ($cart['varient'] == 0) {
                    $order_product->product_varient_value_id = null;
                } else {
                    $order_product->product_varient_value_id = $cart['varient'];
                }
                $order_product->is_active = true;
                $order_product->is_delivered = false;
                $order_product->save();
            }

            $checkout_amount = $order->shipping_charge;
            $checkout_amount += $order->amount_after_discount ? $order->amount_after_discount : $order->amount;

            if (auth('customer')->check()) {
                $checkout_amount -= auth('customer')->user()->balance;
            }

            $post_data = [
                'store_id' => 'abecombdlive',
                'store_passwd' => '608669CF739D459892',
                'total_amount' => $checkout_amount,
                'tran_id' => $order->refresh()->id,
                'currency' => 'BDT',
                'product_category' => 'Order Amount Pay',
                'success_url' => 'https://abe.com.bd/sslcommerz/success',
                'fail_url' => 'https://abe.com.bd/sslcommerz/failed',
                'cancel_url' => 'https://abe.com.bd/sslcommerz/cancel',
                'ipn_url' => 'https://abe.com.bd/sslcommerz/ipn',
                'emi_option' => 0,
                'cus_name' => $order->name,
                'cus_email' => auth('customer')->user()->email,
                'cus_city' => $order->city,
                'cus_country' => $order->country,
                'cus_add1' => $order->shipping_address,
                'cus_phone' => $order->phone,
                'shipping_method' => 'NO',
                'num_of_item' => $order->order_product->count(),
                'product_name' => 'Order Amount Pay',
                'product_profile' => 'non-physical-goods',
                'value_a' => $order->id,
            ];

            $client = new Client();
            $response = $client->post('https://securepay.sslcommerz.com/gwprocess/v4/api.php', ['form_params' => $post_data, 'verify' => false])->getBody();

            $order->payment_initiation_server_response = $response->getContents();
            $order->save();

            $request->session()->forget('cart');

            return $order->payment_initiation_server_response;
        }
    }

    public function SSLSuccess(Request $request)
    {
        $order = Order::find($request->get('tran_id'));
        $order->payment_validation_server_response = $request->all();
        $order->payment_status = 'Success';
        $order->paid_by = 'Online';
        $order->is_verified = true;
        $email = $order->customer->email;

        if ($order->save()) :
            Mail::send('emails.customer_order_mail', ['order' => $order], function ($order) use ($email) {
                $order->from('info.abe83@gmail.com');
                $order->to($email);
                $order->subject('Your Order Is Placed');
            });

            Mail::send('emails.customer_order_mail', ['order' => $order], function ($order) use ($request) {
                $order->from('info.abe83@gmail.com');
                $order->to('info.abe83@gmail.com');
                $order->subject('Your Order Is Placed');
            });

            $request->session()->flash('success', 'Thanks for your order. Your payment is success.');

            return redirect()->route('profile', $order->customer_id);
        endif;
    }

    public function SSLFailed(Request $request)
    {
        $order = Order::find($request->get('tran_id'));
        $order->payment_validation_server_response = $request->all();
        $order->payment_status = 'Pending';
        $order->paid_by = 'Online';
        $order->is_verified = false;

        if ($order->save()) :
            $request->session()->flash('failed', 'Failed to connect with SSLCOMMERZ');

        return redirect()->route('profile', $order->customer_id);
        endif;
    }

    public function SSLCancel(Request $request)
    {
        $order = Order::find($request->get('tran_id'));
        $order->payment_validation_server_response = $request->all();
        $order->payment_status = 'Pending';
        $order->paid_by = 'Online';
        $order->is_verified = false;

        if ($order->save()) :
            $request->session()->flash('failed', 'Cancelled to connect with SSLCOMMERZ');

        return redirect()->route('profile', $order->customer_id);
        endif;
    }

    public function SSLIpn(Request $request)
    {
        $order = Order::find($request->get('tran_id'));
        $order->payment_validation_server_response = $request->all();
        $order->is_verified = true;
        $order->save();
    }
}

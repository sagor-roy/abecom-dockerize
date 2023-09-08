<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\BankPayment;
use App\Models\GuestVerification;
use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class GuestCheckoutController extends Controller
{
    public function guest_checkout()
    {

        if (auth('customer')->check()) {
            return view('errors.404');
        } else {

          $cities = City::with('thanas')->where('is_active', true)->orderBy('id','desc')->get();
          $bank_payment = BankPayment::find(1);

          $checkout_page_nb = ContactDetail::select('id', 'checkout_page_nb')->first();

            return view('frontend.pages.guest_checkout', compact('cities', 'bank_payment', 'checkout_page_nb'));
        }
    }

    //guest verification
    public function guest_verification(Request $request)
    {
        if ($request->session()->get('guest_info')) {
            $request->session()->forget('guest_info');
        }
        if ($request->session()->get('cart')) {
            if ($request->city) {
                $city = City::find($request->city);
            }
            if (strtolower($city->city) != 'dhaka' && $request->delivery_type == "Local") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:30',
                    'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                    'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'city' => 'required',
                    'country' => 'required',
                    'address' => 'required',
                    'payment_method' => 'required|min:0|max:1',
                    'courier' => 'required',
                    'pickup_point' => 'required'
                ]);
            }
            elseif (strtolower($city->city) == 'dhaka' && $request->delivery_type == "Local") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:30',
                    'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                    'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'city' => 'required',
                    'country' => 'required',
                    'address' => 'required',
                    'payment_method' => 'required|min:0|max:1',
                    'pickup_point' => 'required'
                ]);
            }
            else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:30',
                    'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                    'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'city' => 'required',
                    'country' => 'required',
                    'address' => 'required',
                    'payment_method' => 'required|min:0|max:1',
                ]);
            }
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                $guest = [];

                if( $request->delivery_type == "Local" ){
                    $guest_info = [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'city' => $request->city,
                        'courier' => $request->courier ? $request->courier : null,
                        'country' => $request->country,
                        'address' => $request->address,
                        'payment_method' => $request->payment_method,
                        'note' => $request->note,
                        'delivery_type' => "Local",
                        'pickup_point' => $request->pickup_point,
                    ];

                }
                elseif( $request->delivery_type == "Home" ){
                    $guest_info = [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'city' => $request->city,
                        'courier' => $request->courier ? $request->courier : null,
                        'country' => $request->country,
                        'address' => $request->address,
                        'payment_method' => $request->payment_method,
                        'delivery_type' => "Home",
                        'note' => $request->note,
                    ];

                }
                else{
                    return response()->json(['error' => 'Something went wrong.'], 200);
                }

                array_push($guest, $guest_info);
                $request->session()->put('guest_info', $guest[0]);

                $code = rand(111111, 999999);

                Mail::send('emails.guest_checkout_verification_code', ['code' => $code], function ($message) use ($request) {
                    $message->from('info.abe83@gmail.com');
                    $message->to($request['email']);
                    $message->subject('Verification Code');
                });

                $guest_verification = new GuestVerification();
                $guest_verification->email = $request['email'];
                $guest_verification->code = $code;
                if ($guest_verification->save()) {
                    return response()->json(['guest_verified' => 'Guest Verified'], 200);
                }

            }
        }
    }

    //do checkout
    public function do_guest_checkout(Request $request)
    {
        if ($request->session()->get('cart') && $request->session()->get('guest_info')) {
            $validator = Validator::make($request->all(), [
                'verify_code' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                $guest = $request->session()->get('guest_info');
                if (GuestVerification::where('code', $request->verify_code)->where('email', $guest['email'])->first()) {


                    $order = new Order();
                    $order->order_id = rand(00000000, 99999999);
                    $order->customer_id = 0;
                    $order->name = $guest['name'];
                    $order->phone = $guest['phone'];
                    $order->email = $guest['email'];
                    $order->city_id = $guest['city'];
                    $order->courier_id = $guest['courier'];

                    $order->country = $guest['country'];
                    $order->shipping_address = $guest['address'];
                    $order->customer_balance = null;
                    $order->note = $guest['note'];

                    $total = 0;
                    $delivery_charge = 0;

                    if ($guest['city']) {
                        $city = City::find($guest['city']);

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

                    $order->amount = $total;

                    if( $guest['delivery_type'] == 'Local' ){
                        $order->delivery_type = 'Local';
                        $order->shipping_charge = 0;
                        $order->pickup_id = $guest['pickup_point'];
                    }
                    else{
                        $order->delivery_type = 'Home';
                        $order->shipping_charge = $delivery_charge;
                        $order->pickup_id = null;
                    }



                    $order->discount_status = false;
                    $order->amount_after_discount = null;
                    $order->coupon_id = null;

                    if ($guest['payment_method'] == 0 || $request->payment_method == 2) {
                        return $this->onSpotPayment($request, $order);
                    } elseif ($guest['payment_method'] == 1) {
                        return $this->sslCommerz($request, $order);
                    }
                } else {
                    return response()->json(['invalid_guest' => 'Invalid Code or Email Address'], 200);
                }
            }
        } else {
            $request->session()->forget('cart');
            $request->session()->forget('guest_info');

            return response()->json(['cart_empty' => 'Harmful request from user'], 200);
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

            $email = $order->email;

            $request->session()->forget('cart');
            $request->session()->forget('guest_info');
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

            return response()->json(['onspot_order_placed' => 'Order placed successfully. We will contact with your soon'], 200);
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

            $post_data = [
                'store_id' => 'perso5f9cfe76d402b',
                'store_passwd' => 'perso5f9cfe76d402b@ssl',
                'total_amount' => $checkout_amount,
                'tran_id' => $order->refresh()->id,
                'currency' => 'BDT',
                'product_category' => 'Order Amount Pay',
                'success_url' => 'https://abe.com.bd/guest/sslcommerz/success',
                'fail_url' => 'https://abe.com.bd/guest/sslcommerz/failed',
                'cancel_url' => 'https://abe.com.bd/guest/sslcommerz/cancel',
                'ipn_url' => 'https://abe.com.bd/guest/sslcommerz/ipn',
                'emi_option' => 0,
                'cus_name' => $order->name,
                'cus_email' => $order->email,
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
            $response = $client->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', ['form_params' => $post_data, 'verify' => false])->getBody();

            $order->payment_initiation_server_response = $response->getContents();
            $order->save();

            $request->session()->forget('cart');
            $request->session()->forget('guest_info');

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
        $email = $order->email;

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
        if (auth('customer')->check()) {
            return redirect()->route('profile', $order->customer_id);
        } else {
            return '
                <h2 style="text-align: center">Your order is successfully placed</h2>
                <a style="display: block; margin: 0 auto; text-align: center;" href="'.route('shop').'">Go to shop</a>
            ';
        }
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

        if (auth('customer')->check()) {
            return redirect()->route('profile', $order->customer_id);
        } else {
            return '
                    <h2 style="text-align: center">Failed to connect with ssl</h2>
                    <a style="display: block; margin: 0 auto; text-align: center;" href="'.route('shop').'">Go to shop</a>
                ';
        }
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

        if (auth('customer')->check()) {
            return redirect()->route('profile', $order->customer_id);
        } else {
            return '
                        <h2 style="text-align: center">Failed to connect with ssl</h2>
                        <a style="display: block; margin: 0 auto; text-align: center;" href="'.route('shop').'">Go to shop</a>
                    ';
        }
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

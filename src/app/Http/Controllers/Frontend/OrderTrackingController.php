<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderTrackingController extends Controller
{
    public function index($token, $id)
    {
        
        if(Str::length($token) == 80 && $id ){
           
            $order = Order::where('order_id',$id)->first();
            if( $order ){
                if( $order->customer_id == 0 ){
                    return view('frontend.pages.track_order', compact('order'));
                }else{
                    if( auth('customer')->check() ){
                        foreach( auth('customer')->user()->order as $customer_order ){
                            if( $customer_order->order_id == $order->order_id ){
                                return view('frontend.pages.track_order', compact('order'));
                            }
                        }
                        return view('errors.404');
                    }else{
                        return view('errors.404');
                    }
                }
                
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
    }

    //track order
    public function track(Request $request){
        $message = [
            'order_id.required' => 'Please give an order id',
        ];
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
        ], $message);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $order = Order::where('order_id',$request->get('order_id'))->first();
            if( $order ){
                if( $order->customer_id == 0 ){
                    $token = Str::random(80);
                    $url = route('order.track',['token'=>$token, 'id' => $order->order_id]);
                    return response()->json(['order_track' => $url], 200);
                }else{
                    if( auth('customer')->check() ){
                        foreach( auth('customer')->user()->order as $customer_order ){
                            if( $customer_order->order_id == $order->order_id ){
                                $token = Str::random(80);
                                $url = route('order.track',['token'=>$token, 'id' => $order->order_id]);
                                return response()->json(['order_track' => $url], 200);
                            }
                        }
                        return response()->json(['error' => 'No order found'], 200);
                    }else{
                        return response()->json(['error' => 'Login first to check your order'], 200);
                    }
                }
                
            }else{  
                return response()->json(['error' => 'No order found'], 200);
            }
        }
    }
}

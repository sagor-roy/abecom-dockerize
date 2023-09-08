<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PriceMatch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceMatchController extends Controller
{
    //price match form 
    public function pricematch(Request $request){
        if( $request->ajax() ){
            $validator = Validator::make($request->all(),[
                "name" => "required",
                "email" => "required",
                "phone" => "required|numeric|regex:/(01)[0-9]{9}/",
                "price" => "required",
                "url" => "required",
                "comment" => "required",
                "product_id" => "required|numeric"
            ]);
            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else{
                try{
                    $price_match = new PriceMatch();
                    $price_match->name = $request->name;
                    $price_match->email = $request->email;
                    $price_match->phone = $request->phone;
                    $price_match->price = $request->price;
                    $price_match->url = $request->url;
                    $price_match->comment = $request->comment;
                    $price_match->is_replied = false;
                    $price_match->product_id = $request->product_id;

                    if( $price_match->save() ){
                        return response()->json(['success' => 'Thanks for your message'],200);
                    }
                }
                catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }
        }
    }
}

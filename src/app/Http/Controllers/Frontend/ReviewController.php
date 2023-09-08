<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function add_review(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'star.*' => 'required',
            'review' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $product = Product::find($id);
            if ($product && auth('customer')->check() ) {
                $review = new Review();
                $review->product_id = $product->id;
                $review->customer_id = auth('customer')->user()->id;
                $review->star = $request->star[0];
                $review->review = $request->review;
                $review->is_approved = false;
                if ($review->save()) {
                    return response()->json(['review' => 'Thanks for your review. Your review will live after approval.'], 200);
                }
            } else {
                return response()->json(['invalid_review_product' => 'Something went wrong'], 200);
            }
        }
    }
}

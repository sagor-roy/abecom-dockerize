<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index()
    {
        
        return view('backend.pages.coupon.manage');
    }

    public function data(Request $request)
    {
        $coupon = Coupon::orderBy('id', 'desc')->get();

        return DataTables::of($coupon)
        ->rawColumns(['action', 'status'])
        ->editColumn('status', function (Coupon $coupon) {
            if ($coupon->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Coupon $coupon) {
            return '
            <button type="button" data-content="'.route('coupon.edit', $coupon->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    public function add(Request $request)
    {

        if( $request->is_cash == true ){
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:coupons,code,',
                'cash_discount' => 'required|numeric',
                'end_date' => 'required',
                'name' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:coupons,code,',
                'percent' => 'required|numeric',
                'end_date' => 'required',
                'name' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->is_active = true;
            if( $request->is_cash == true ){
                $coupon->percentage = 0;
                $coupon->cash_discount = $request->cash_discount;
            }else{
                $coupon->percentage = $request->percent;
                $coupon->cash_discount = 0;
            }
            $coupon->end_date = $request->end_date;
            $coupon->name = $request->name;
            if ($coupon->save()) {
                return response()->json(['create' => $coupon], 200);
            }
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);

        return view('backend.pages.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        if( $request->cash_discount == 0 ){
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:coupons,code,'.$id,
                'percent' => 'required|numeric',
                'end_date' => 'required',
                'name' => 'required',
            ]);
        }elseif( $request->percent == 0 ){
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:coupons,code,'.$id,
                'cash_discount' => 'required|numeric',
                'end_date' => 'required',
                'name' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $coupon = Coupon::find($id);
                $coupon->code = $request->code;
                if( $request->cash_discount == 0 ){
                    $coupon->percentage = $request->percent;
                    $coupon->cash_discount = 0;
                }elseif( $request->percent == 0 ){
                    $coupon->percentage = 0;
                    $coupon->cash_discount = $request->cash_discount;
                }
                $coupon->is_active = $request->is_active;
                $coupon->end_date = $request->end_date;
                $coupon->name = $request->name;
                if ($coupon->save()) {
                    return response()->json(['update' => $coupon], 200);
                } 
            }  
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }

        
    }
}

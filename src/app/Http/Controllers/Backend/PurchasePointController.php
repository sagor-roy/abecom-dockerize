<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use App\Models\PurchasePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PurchasePointController extends Controller
{
    public function index()
    {
        return view('backend.pages.points.manage');
    }

    public function data(Request $request)
    {
        $point = PurchasePoint::orderBy('id', 'desc')->get();

        return DataTables::of($point)
        ->rawColumns(['action', 'is_active', 'min_price', 'max_price', 'balance'])
        ->editColumn('min_price', function (PurchasePoint $point) {
            return '৳ '.$point->min_price.' BDT';
        })
        ->editColumn('max_price', function (PurchasePoint $point) {
            return '৳ '.$point->max_price.' BDT';
        })
        ->editColumn('balance', function (PurchasePoint $point) {
            return $point->balance;
        })
        ->editColumn('is_active', function (PurchasePoint $point) {
            if ($point->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (PurchasePoint $point) {
            return '
            <button type="button" data-content="'.route('purchase.point.edit', $point->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'required|min:0|numeric|unique:purchase_balance,min_price,',
            'max_price' => 'required|min:0|numeric|unique:purchase_balance,max_price,',
            'balance' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $purchase_point = new PurchasePoint();
            $purchase_point->min_price = $request->min_price;
            $purchase_point->max_price = $request->max_price;
            $purchase_point->balance = $request->balance;
            $purchase_point->is_active = true;
            if ($purchase_point->save()) {
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    //edit
    public function edit($id)
    {
        $point = PurchasePoint::find($id);

        return view('backend.pages.balance.modals.edit', compact('point'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'required|min:0|numeric|unique:purchase_balance,min_price,'.$id,
            'max_price' => 'required|min:0|numeric|unique:purchase_balance,max_price,'.$id,
            'balance' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $purchase_point = PurchasePoint::find($id);
            $purchase_point->min_price = $request->min_price;
            $purchase_point->max_price = $request->max_price;
            $purchase_point->balance = $request->balance;
            $purchase_point->is_active = $request->is_active;
            if ($purchase_point->save()) {
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }

    //balance against point 
    public function balance_point(Request $request, $id){
        $contact_detail = ContactDetail::find($id);
        $contact_detail->balance_point = $request->balance_point;
        if( $contact_detail->save() ){
            return response()->json(['update' => 'update'], 200);
        }
    }
}

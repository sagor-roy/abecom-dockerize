<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DeliveryChargeController extends Controller
{
    public function index()
    {
        return view('backend.pages.delivery_charge.manage');
    }

    //data
    public function data()
    {
        $coupon = DeliveryCharge::orderBy('id', 'desc')->get();

        return DataTables::of($coupon)
        ->rawColumns(['action', 'is_active', 'amount'])
        ->editColumn('amount', function (DeliveryCharge $charge) {
            return $charge->amount.' BDT';
        })
        ->editColumn('is_active', function (DeliveryCharge $charge) {
            if ($charge->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (DeliveryCharge $charge) {
            return '
            <button type="button" data-content="'.route('delivery.charge.edit', $charge->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //add
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|unique:delivery_charges,size,',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $delivery_charge = new DeliveryCharge();
            $delivery_charge->size = $request->size;
            $delivery_charge->amount = $request->amount;
            $delivery_charge->is_active = true;
            if ($delivery_charge->save()) {
                return response()->json(['create' => 'Created'], 200);
            }
        }
    }

    //edit
    public function edit($id)
    {
        $delivery_charge = DeliveryCharge::find($id);

        return view('backend.pages.delivery_charge.modals.edit', compact('delivery_charge'));
    }

    //update
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|unique:delivery_charges,size,'. $id,
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $delivery_charge = DeliveryCharge::find($id);
            $delivery_charge->size = $request->size;
            $delivery_charge->amount = $request->amount;
            $delivery_charge->is_active = $request->is_active;
            if ($delivery_charge->save()) {
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

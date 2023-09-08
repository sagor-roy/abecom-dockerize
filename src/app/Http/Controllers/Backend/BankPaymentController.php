<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use Illuminate\Http\Request;

class BankPaymentController extends Controller
{
    public function index()
    {
        $bank_payment = BankPayment::find(1);

        return view('backend.pages.bank_payment.index', compact('bank_payment'));
    }

    public function update(Request $request)
    {
        $bank_payment = BankPayment::updateOrCreate(
            ['id' => 1],
            [
                'description' => $request->description,
                'is_active' => true,
            ]
        );

        return response()->json([
            'success' => "Online Payment Description Updated Successfully"
        ],200);
    }
}

<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:customers,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|unique:customers,phone|numeric|regex:/(01)[0-9]{9}/',
            'birthdate' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $customer = new Customer();

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->birthday = $request->birthdate;
            $customer->password = Hash::make($request->password);
            $customer->is_active = true;

            if ($customer->save()) {
                $url = route('login');

                Mail::send('frontend.emails.registrationsuccess', ['email' => $customer->email], function ($customer) use ($request) {
                    $customer->from('info@abe.com.bd');
                    $customer->to($request->email);
                    $customer->subject('Registration successfully done');
                });

                return response()->json(['login_url' => $url]);
            }
        }
    }
}

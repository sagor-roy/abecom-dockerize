<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPassword extends Controller
{
    public function forget_email()
    {
        return view('frontend.pages.forgetpass');
    }

    public function get_code(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:customers',
        ]);

        $token = Str::random(60);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $email = $request->email;
        Mail::send('frontend.pages.verify', ['token' => $token, 'email' => $email], function ($message) use ($request) {
            $message->from('info@abe.com.bd');
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        $request->session()->flash('success', 'A password reset link has been sent to you email address. Please use the link to reset your password.');

        return redirect()->route('forget.email');
    }

    public function change_pass($token, $email, Request $request)
    {
        $customer = Customer::where('email', $email)->first();
        if( $customer && Str::length($token) == 60 ){
            $all_token = DB::table('password_resets')->get();
            foreach ($all_token as $single_token) {
                if ($single_token->token == $token) {
                    return view('frontend.pages.reset', ['token' => $token, 'email' => $email]);
                }
            }
            $request->session()->flash('failed', 'Session Timeout. Please send reset password link again');

            return redirect()->route('forget.email');
        }else{
            return view('errors.404');
        }

    }

    public function reset_password(Request $request, $email)
    {
        $request->validate([
            'email' => 'required|exists:customers,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $customer = Customer::where('email', $email)->first();
        $customer->password = Hash::make($request->password);
        if ($customer->save()) {
            Auth::guard('customer')->logout();

            $request->session()->flash('success', 'Your password is updated successfully');

            return redirect()->route('login');
        }
    }
}

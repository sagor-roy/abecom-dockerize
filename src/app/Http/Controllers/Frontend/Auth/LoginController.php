<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MobileLoginOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $customer = Customer::where('email', $request->email)->orWhere("phone",$request->email)->where('is_active', true)->first();
            if ($customer) {
                $cred = ['email' => $customer->email, 'password' => $customer->password];
                
                if( $customer->phone ){
                    if (auth('customer')->attempt(['phone' => $customer->phone, 'password' => $request->password], true)) {
                        $url = route('profile', auth('customer')->user()->id);
    
                        return response()->json(['profile_url' => $url]);
                    } else {
                        return response()->json(['invalid_login' => 'Invalid Credentials'], 200);
                    }
                }
                elseif( $customer->email ){
                    if (auth('customer')->attempt(['email' => $customer->email, 'password' => $request->password], true)) {
                        $url = route('profile', auth('customer')->user()->id);
    
                        return response()->json(['profile_url' => $url]);
                    } else {
                        return response()->json(['invalid_login' => 'Invalid Credentials'], 200);
                    }
                }
                
            } else {
                return response()->json(['invalid_customer' => 'Invalid customer'], 200);
            }
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('login');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectGoogle(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $getAllUser = Customer::where('email', $user->email)->first();

        if (!$getAllUser) {
            $customer = new Customer();
            $customer->name = $user->name;
            $customer->email = $user->email;
            $customer->phone = $user->email;
            $customer->password = Hash::make('123456');
            $customer->is_active = true;

            if ($customer->save()) {
                if (Auth::guard('customer')->login($customer, true)) {
                    Mail::send('frontend.emails.registrationsuccess', ['email' => $customer->email], function ($customer) use ($request) {
                        $customer->from('info@abe.com.bd');
                        $customer->to($request->email);
                        $customer->subject('Registration successfully done');
                    });

                    return redirect()->route('profile', $customer->id);
                } else {
                    $request->session()->flash('failed', 'Please enter information!');

                    return redirect()->route('login');
                }
            }
        } else {
            if ($getAllUser->is_active == false) {
                $request->session()->flash('failed', 'Your account is deactivated!');

                return redirect()->route('login');
            }
            if (Auth::guard('customer')->login($getAllUser, true)) {
                return redirect()->route('profile', $getAllUser->id);
            } else {
                $request->session()->flash('failed', 'Please enter correct information!');

                return redirect()->route('login');
            }
        }
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectFacebook(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        if ($user->email) {
            $getAllUser = Customer::where('email', $user->email)->first();

            if (!$getAllUser) {
                $customer = new Customer();
                $customer->name = $user->name;
                $customer->email = $user->email;
                $customer->phone = $user->email;
                $customer->password = Hash::make('123456');
                $customer->is_active = true;

                if ($customer->save()) {
                    if (Auth::guard('customer')->login($customer, true)) {
                        Mail::send('frontend.emails.registrationsuccess', ['email' => $customer->email], function ($customer) use ($request) {
                            $customer->from('info@abe.com.bd');
                            $customer->to($request->email);
                            $customer->subject('Registration successfully done');
                        });

                        return redirect()->route('profile', $customer->id);
                    } else {
                        $request->session()->flash('failed', 'Please enter information!');

                        return redirect()->route('login');
                    }
                }
            } else {
                if ($getAllUser->is_active == false) {
                    $request->session()->flash('failed', 'Your account is deactivated!');

                    return redirect()->route('login');
                }
                if (Auth::guard('customer')->login($getAllUser, true)) {
                    return redirect()->route('profile', $getAllUser->id);
                } else {
                    $request->session()->flash('failed', 'Please enter correct information!');

                    return redirect()->route('login');
                }
            }
        } else {
            $request->session()->flash('failed', 'The email address field was not returned. This may be because the email address was missing or invalid or hasn"t been confirmed.');

            return redirect()->route('login');
        }
    }


    //login with mobile start
    public function login_mobile(Request $request){
        if( $request->ajax() ){

            $validator = Validator::make($request->all(),[
                "phone" => "regex:/(01)[0-9]{9}/",
            ]);

            if( $validator->fails() ){
                return response()->json(['error' => 'Invalid format'],200);
            }
            else{
                 $otp = rand(000000,999999);

                $url = 'http://isms.zaman-it.com/smsapimany';
                $data = [
                            'api_key' => 'R20000185d4afaa187f594.83659319',
                            'senderid' => '8809612776677',
                            'messages' => json_encode([
                            [
                                'to' => '88'. $request->phone,
                                'message' => 'AB Electronics: Your One Time Password is ' . $otp . '. It will expire in 5 minutes',
                            ],
                            ]),
                        ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                $response = curl_exec($ch);
                

                if( $response ){
                    $mobile_login_otp = new MobileLoginOtp();
                    $mobile_login_otp->number = $request->phone;
                    $mobile_login_otp->otp = $otp;
                    if( $mobile_login_otp->save() ){
                        return response()->json([
                            'success' => 'We send you an otp in your given number',
                            'number' => $request->phone,
                            'res' => $response
                        ], 200);
                    }
                }
            }

            
            
        }
    }


    //otp validation start
    public function otp_validation(Request $request){
        if( $request->ajax() ){


            $mobile_login_otp = MobileLoginOtp::where("otp",$request->data_otp)->first();

            if( $mobile_login_otp ){
                $getAllUser = Customer::where('phone', $request->data_number)->first();

                if( !$getAllUser ){
                    $customer = new Customer();
                    $customer->name = null;
                    $customer->email = null;
                    $customer->phone = $request->data_number;
                    $customer->password = Hash::make($request->data_otp);
                    $customer->is_active = true;
        
                    if ($customer->save()) {
                        Auth::guard('customer')->login($customer, true);
                        $profile = route('profile', $customer->id);
                        $mobile_login_otp->delete();
                        return response()->json(['profile' => $profile], 200);
                    }
                }
                else{
                    if ($getAllUser->is_active == false) {
                        return response()->json(['error' => 'Your account is deactivated'], 200);
                    }
                    else{
                        Auth::guard('customer')->login($getAllUser, true);
                        $profile = route('profile', $getAllUser->id);
                        $mobile_login_otp->delete();
                        return response()->json(['profile' => $profile], 200);
                    }
                }
            }
            else{
                return response()->json(['error' => 'Invalid OTP'], 200);
            }
            
        }
    }
}

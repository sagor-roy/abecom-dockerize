<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function profile_basic_info(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email,'.$id,
            'phone' => 'required|unique:customers,phone,'. $id,
            'city' => 'required',
            'address' => 'required',
            'birthday' => 'required',
        ]);

        $customer = Customer::find($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->city = $request->city;
        $customer->address = $request->address;
        $customer->birthday = $request->birthday;

        if ($customer->save()) {
            $request->session()->flash('success', 'Profile updated');

            return back();
        }
    }

    public function profile_change_pass(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::find($id);

        if (Hash::check($request->old_password, $customer->password)) {
            $customer->password = Hash::make($request->password);
            if ($customer->save()) {
                $request->session()->flash('success', 'Password updated');

                return back();
            }
        } else {
            $request->session()->flash('failed', 'Old password not matched please try again');

            return back();
        }
    }

    //cancel order
    public function profile_cancel_order($id, Request $request)
    {
        $order = Order::find($id);

        $order->order_status = 'Cancelled';
        if ($order->save()) {
            $request->session()->flash('success', 'Order cancelled successfully');
            $email = $order->email;
            Mail::send('emails.customer_order_cancelled', ['order' => $order], function ($order) use ($email) {
                $order->from('info@abe.com.bd');
                $order->to($email);
                $order->subject('Your order is cancelled successfully');
            });

            return back();
        }
    }

    //order details
    public function order_details($id, $order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            return view('frontend.pages.order_details', compact('order'));
        } else {
            return view('errors.404');
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerBirthdayWish;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function all()
    {
        return view('backend.pages.customer.manage');
    }

    public function data(Request $request)
    {
        $customer = Customer::select("id","name","email","phone","birthday","is_active","balance")->get();

        return DataTables::of($customer)
        ->rawColumns(['action', 'name', 'is_active'])
        ->editColumn('name', function (Customer $customer) {
            $phone = "";
            if( $customer->phone != $customer->email ){
                $phone = $customer->phone;
            }
            
            return '
                <p><b>Name</b> : '.$customer->name.'</p>
                <p><b>Email</b> : '.$customer->email.'</p>
                <p><b>Phone</b> : '.$phone.'</p>
                <p><b>Birthday</b> : '.$customer->birthday.'</p>
            ';
        })
        ->editColumn('is_active', function (Customer $customer) {
            if ($customer->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Customer $customer) {
            $class = '';

            if( $customer->birthday ){
                if (Carbon::parse($customer->birthday)->month == Carbon::now()->month && Carbon::parse($customer->birthday)->day == Carbon::now()->day) {
                    $class = 'd-inline';
                } else {
                    $class = 'd-none';
                }
            }else{
                $class = 'd-none';
            }
            

            return '
            <button type="button" data-content="'.route('customer.reset.password.modal', $customer->id).'" data-target="#myModal" class="btn btn-success" data-toggle="modal">
                    Reset Password
            </button>
            <button type="button" data-content="'.route('customer.edit.modal', $customer->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Status
            </button>
            <button type="button" data-content="'.route('customer.view.modal', $customer->id).'" data-target="#largeModal" class="btn btn-danger" data-toggle="modal">
                    View
            </button>
            <p>
            <button type="button"  data-content="'.route('add.wish.modal', $customer->id).'" data-target="#myModal" class="btn btn-warning '.$class.'" data-toggle="modal">
                    Birthday wish
            </button>
            <button type="button" style="margin-top: 10px" data-content="'.route('view.wish', $customer->id).'" data-target="#myModal" class="btn btn-secondary" data-toggle="modal">
                    Wishes
            </button>
            </p>
            ';
        })
        ->make(true);
    }

    public function reset_password_modal($id)
    {
        $customer = Customer::find($id);

        return view('backend.pages.customer.modals.reset', compact('customer'));
    }

    public function reset_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $customer = Customer::find($id);
            $customer->password = Hash::make($request->password);
            if ($customer->save()) {
                return response()->json(['password_update' => 'Password updated'], 200);
            }
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('backend.pages.customer.modals.edit', compact('customer'));
    }

    public function update($id, Request $request)
    {
        $customer = Customer::find($id);
        $customer->is_active = $request->is_active;
        if ($customer->save()) {
            return response()->json(['update' => 'Customer updated'], 200);
        }
    }

    public function view($id)
    {
        $customer = Customer::find($id);

        return view('backend.pages.customer.modals.view', compact('customer'));
    }

    //add wish modal
    public function add_wish_modal($id)
    {
        $customer = Customer::find($id);

        return view('backend.pages.customer.modals.add_wish', compact('customer'));
    }

    //wish all
    public function wish_all(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            $customers = Customer::orderBy('id', 'desc')->get();
            $customer_wish = $request->message;
            foreach( $customers as $customer ){
                if( Carbon::parse($customer->birthday)->month == Carbon::now()->month && Carbon::parse($customer->birthday)->day == Carbon::now()->day  ){
                    Mail::send('emails.birthday_wish', ['customer_wish' => $customer_wish], function ($message) use ($customer) {
                        $message->from('info@abe.com.bd');
                        $message->to($customer->email);
                        $message->subject('Happy Birthday');
                    });

                    return response()->json(['mail_send' => 'Mail Send'], 200);
                }else{
                    return response()->json(['error' => 'No birthday found today'], 500);
                }
            }
        }
    }

    //add wish
    public function add_wish($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $customer = Customer::find($id);
            $customer_wish = new CustomerBirthdayWish();
            try {
                $customer_wish->customer_id = $id;
                $customer_wish->user_id = auth('web')->user()->id;
                $customer_wish->message = $request->message;
                if ($customer_wish->save()) {
                    Mail::send('emails.birthday_wish', ['customer_wish' => $customer_wish], function ($message) use ($customer) {
                        $message->from('info@abe.com.bd');
                        $message->to($customer->email);
                        $message->subject('Happy Birthday');
                    });

                    return response()->json(['mail_send' => 'Mail Send'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    //view birthday wish
    public function view_wish($id)
    {
        $customer = Customer::find($id);

        return view('backend.pages.customer.modals.view_wish', compact('customer'));
    }
}

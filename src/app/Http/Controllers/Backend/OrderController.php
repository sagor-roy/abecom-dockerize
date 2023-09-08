<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use App\Models\Order;
use App\Models\OrderMail;
use App\Models\PurchasePoint;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $total_order = Order::where('is_active', true)->count();
        $pending_order = Order::where('is_active', true)->where('order_status', 'Pending')->count();
        $onprocess_order = Order::where('is_active', true)->where('order_status', 'OnProcess')->count();
        $shipped_order = Order::where('is_active', true)->where('order_status', 'Shipped')->count();
        $delivered_order = Order::where('is_active', true)->where('order_status', 'Delivered')->count();
        $cancelled_order = Order::where('is_active', true)->where('order_status', 'Cancelled')->count();

        $today = Carbon::now();
        $todays_order = 0;
        $one_week = 0;
        $one_year = 0;

        foreach (Order::where('is_active', true)->get() as $order) {
            if ($order->created_at->toDateString() == $today->toDateString()) {
                ++$todays_order;
            }
            $difference = $order->created_at->diffInDays(Carbon::now());
            if ($difference < 8) {
                ++$one_week;
            }
            if ($difference < 366) {
                ++$one_year;
            }
        }

        return view('backend.pages.order.manage', compact(
            'total_order', 'pending_order', 'onprocess_order', 'shipped_order' ,'delivered_order', 'cancelled_order', 'todays_order',
            'one_week', 'one_year'
        ));
    }

    public function data()
    {
        $order = Order::select("id","order_id","created_at","order_status")->get();

        return DataTables::of($order)
        ->rawColumns(['action', 'order','date', 'status'])
        
        ->editColumn('order', function (Order $order) {
            return "#" . $order->order_id;    
        
        })

        ->editColumn('date', function (Order $order) {
            return $order->created_at->toDayDateTimeString();    
        
        })

        ->editColumn('status', function (Order $order) {
            return $order->order_status;    
        
        })
        
        ->addColumn('action', function (Order $order) {
            $status = "";
            if( auth('web')->user()->is_admin == true ){
                $status = '<button type="button" data-content="'.route('status.edit', $order->id).'" data-target="#myModal" class="btn btn-warning" data-toggle="modal">
                        Status
                </button>';
            }

            return '
            <p>
                <button type="button" data-content="'.route('order.view', $order->id).'" data-target="#largeModal" class="btn btn-success" data-toggle="modal">
                        View
                </button>

                '.$status.'

                <a  href="'.route('invoice', $order->id).'" target="_blank" class="btn btn-primary">
                        Invoice
                </a>

                <button type="button" data-content="'.route('order.mail.modal', $order->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                        Mail
                </button>

                <button type="button" data-content="'.route('order.mail.view', $order->id).'" data-target="#largeModal" class="btn btn-outline-dark" data-toggle="modal">
                        View Mail
                </button>
            </p>
            
            ';
        })
        ->make(true);
    }

    //view full order
    public function view($id)
    {
        $order = Order::find($id);

        return view('backend.pages.order.modals.view', compact('order'));
    }

    //status edit
    public function status_edit($id)
    {
        $order = Order::find($id);

        return view('backend.pages.order.modals.status', compact('order'));
    }

    //status update
    public function status_update($id, Request $request)
    {
        $order = Order::find($id);



        if ($request->order_status == 'Pending') {
            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->is_active = $request->status;
        }

        if ($request->order_status == 'OnProcess') {
            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->is_active = $request->status;
        }

        if ($request->order_status == 'Shipped') {
            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->is_active = $request->status;
        }

        if ($request->order_status == 'Delivered') {

            if( $order->is_delivered == false ){
                if ($order->discount_status == true) {
                    $point = PurchasePoint::where('min_price', '<=', $order->amount_after_discount)->where('max_price', '>=', $order->amount_after_discount)->where('is_active', true)->first();
                    if ($point) {
                        $order->customer->balance += $point->balance;
                        $order->customer->save();
                    }
                } else {
                    $point = PurchasePoint::where('min_price', '<=', $order->amount)->where('max_price', '>=', $order->amount)->where('is_active', true)->first();
                    if ($point) {
                        $order->customer->balance += $point->balance;
                        $order->customer->save();
                    }
                }

                //product quantity reduce
                foreach ($order->order_product as $order_product) {
                    if ($order_product->product_varient_value_id) {
                        if ($order_product->product_attribute->qty < $order_product->quantity) {
                            return response()->json(['error' => 'Order product quantity maximum than available stock'], 200);
                        } else {
                            $order_product->product_attribute->qty -= $order_product->quantity;
                            $order_product->is_delivered = true;
                            $order_product->save();
                            $order_product->product_attribute->save();

                        }
                    } else {
                        if ($order_product->product->qty < $order_product->quantity) {
                            return response()->json(['error' => 'Order product quantity maximum than available stock'], 200);
                        } else {
                            $order_product->product->qty -= $order_product->quantity;
                            $order_product->is_delivered = true;
                            $order_product->save();
                            $order_product->product->save();
                        }
                    }
                }
            }

            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->is_active = $request->status;
            $order->is_delivered = true;

        }

        if ($request->order_status == 'Cancelled') {
            $order->order_status = $request->order_status;
            $order->payment_status = $request->payment_status;
            $order->is_active = $request->status;
            if ($order->customer_id != 0) {
                if ($order->customer_balance > $order->amount) {
                    $order->customer->balance += $order->amount;
                } else {
                    $order->customer->balance += $order->customer_balance;
                }
                $order->customer->save();
            }
        }

        if ($order->save()) {
            return response()->json(['update' => 'Updated'], 200);
        }
    }

    //order invoice
    public function invoice($id)
    {
        $order = Order::find($id);

        return view('backend.pages.order.invoice', compact('order'));
    }

    //order mail
    public function mail_modal($id, Request $request)
    {
        $order = Order::find($id);

        return view('backend.pages.order.modals.mail', compact('order'));
    }

    //send mail
    public function mail(Request $request, $id)
    {
        if ($request->order_status == 'OnProcess') {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
                'estimate_date' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = Order::find($id);
        $email = $order->email;
        if ($request->order_status == 'OnProcess') {
            $order_mail = new OrderMail();
            $order_mail->order_id = $id;
            $order_mail->status = 'OnProcess';
            $order_mail->message = $request->message;
            $order_mail->estimate_time = $request->estimate_date;
            $order_mail->user_id = auth('web')->user()->id;

            if ($order_mail->save()) {
                Mail::send('emails.order_onprocess_mail', ['order' => $order, 'order_mail' => $order_mail], function ($order) use ($email) {
                    $order->from('info@abe.com.bd');
                    $order->to($email);
                    $order->subject('Your Order Is Now On Process');
                });

                return response(['mail_send' => 'Mail Send'], 200);
            }
        }

        if ($request->order_status == 'Shipped') {
            $order_mail = new OrderMail();
            $order_mail->order_id = $id;
            $order_mail->status = 'Shipped';
            $order_mail->message = $request->message;
            $order_mail->user_id = auth('web')->user()->id;
            if ($order_mail->save()) {
                Mail::send('emails.order_shipped', ['order' => $order, 'order_mail' => $order_mail], function ($order) use ($email) {
                    $order->from('info@abe.com.bd');
                    $order->to($email);
                    $order->subject('Your Order Is Shipped');
                });

                return response(['mail_send' => 'Mail Send'], 200);
            }
        }

        if ($request->order_status == 'Delivered') {
            $order_mail = new OrderMail();
            $order_mail->order_id = $id;
            $order_mail->status = 'Delivered';
            $order_mail->message = $request->message;
            $order_mail->user_id = auth('web')->user()->id;
            if ($order_mail->save()) {
                Mail::send('emails.order_delivered_mail', ['order' => $order, 'order_mail' => $order_mail], function ($order) use ($email) {
                    $order->from('info@abe.com.bd');
                    $order->to($email);
                    $order->subject('Your Order Is Delivered');
                });

                return response(['mail_send' => 'Mail Send'], 200);
            }
        }

        if ($request->order_status == 'Cancelled') {
            $order_mail = new OrderMail();
            $order_mail->order_id = $id;
            $order_mail->status = 'Cancelled';
            $order_mail->message = $request->message;
            $order_mail->user_id = auth('web')->user()->id;

            if ($order_mail->save()) {
                Mail::send('emails.order_cancelled_mail', ['order' => $order, 'order_mail' => $order_mail], function ($order) use ($email) {
                    $order->from('info@abe.com.bd');
                    $order->to($email);
                    $order->subject('Your Order Is Cancelled');
                });

                return response(['mail_send' => 'Mail Send'], 200);
            }
        }
    }

    //mail view start
    public function mail_view($id)
    {
        $order = Order::find($id);

        return view('backend.pages.order.modals.mail_view', compact('order'));
    }

    // checkout page nb function start
    public function checkout_page_nb()
    {
        $checkout_page_nb = ContactDetail::select('id', 'checkout_page_nb')->first();

        return view('backend.pages.order.checkout_page_nb.index', compact('checkout_page_nb'));
    }
    // checkout page nb function end

    // checkout page nb update function start
    public function checkout_page_nb_update($id, Request $request)
    {
        try{
              
            $checkout_page_nb = ContactDetail::select('id', 'checkout_page_nb')->findOrFail(decrypt($id));

            $checkout_page_nb->checkout_page_nb = $request->checkout_page_nb;

            if ($checkout_page_nb->save()) {
                return response()->json(['success' => 'Checkout Page NB updated Successfully'], 200);
            }

        }
        catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }

    }
    // checkout page nb update function end

}

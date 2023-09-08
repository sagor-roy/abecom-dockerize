<?php

namespace App\Http\Controllers\Backend;

use App\Exports\Order;
use App\Exports\OrderDateToDate;
use App\Exports\Subscribers;
use App\Http\Controllers\Controller;
use App\Models\EmailSubscribe;
use App\Models\Order as ModelsOrder;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function order_report(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'city' => 'required',
            'courier' => 'required',
            'discount' => 'required',
            'coupon' => 'required',
            'paid_by' => 'required',
            'payment_status' => 'required',
            'order_status' => 'required',
            'checkout_type' => 'required',
            'active_status' => 'required',
        ]);
        if ($request->courier == 0) {
            $request->courier = null;
        }
        if ($request->coupon == 0) {
            $request->coupon = null;
        }

        if ($request->checkout_type == 0) {
            //guest checkout
            $all_order = ModelsOrder::whereBetween('updated_at', [Carbon::parse($request->from), Carbon::parse($request->to)->addDays()])->orderBy('id', 'desc')
            ->where('customer_id', 0)
            ->where('city_id', $request->city)
            ->where('courier_id', $request->courier)
            ->where('discount_status', $request->discount)
            ->where('coupon_id', $request->coupon)
            ->where('paid_by', $request->paid_by)
            ->where('payment_status', $request->payment_status)
            ->where('order_status', $request->order_status)
            ->where('is_active', $request->active_status)
            ->get();
        } else {
            //normal checkout
            $all_order = ModelsOrder::whereBetween('updated_at', [Carbon::parse($request->from), Carbon::parse($request->to)->addDays()])->orderBy('id', 'desc')
            ->where('customer_id', '!=', 0)
            ->where('city_id', $request->city)
            ->where('courier_id', $request->courier)
            ->where('discount_status', $request->discount)
            ->where('coupon_id', $request->coupon)
            ->where('paid_by', $request->paid_by)
            ->where('payment_status', $request->payment_status)
            ->where('order_status', $request->order_status)
            ->where('is_active', $request->active_status)
            ->get();
        }

        $data = [];

        if ($all_order->count() > 0) {
            foreach ($all_order as $single_order) {
                array_push($data, $single_order);
            }
            $export = new Order();

            return Excel::download($export->getDownloadByQuery($data), 'OrderReport - '.Carbon::parse($request->from)->toDateString().' - '.Carbon::parse($request->to)->toDateString().'.csv');
        } else {
            $data = $all_order;
            $export = new Order();

            return Excel::download($export->getDownloadByQuery($data), 'OrderReport - '.Carbon::parse($request->from)->toDateString().' - '.Carbon::parse($request->to)->toDateString().'.csv');
        }
    }

    //order report download date to date
    public function order_report_date_to_date(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $data = [];

        $all_order = ModelsOrder::whereBetween('updated_at', [Carbon::parse($request->from), Carbon::parse($request->to)->addDays()])->orderBy('id', 'desc')
        ->get();

        if ($all_order->count() > 0) {
            foreach ($all_order as $single_order) {
                array_push($data, $single_order);
            }
            $export = new OrderDateToDate();

            return Excel::download($export->getDownloadByQuery($data), 'OrderReport - '.Carbon::parse($request->from)->toDateString().' - '.Carbon::parse($request->to)->toDateString().'.csv');
        } else {
            $data = $all_order;
            $export = new OrderDateToDate();

            return Excel::download($export->getDownloadByQuery($data), 'OrderReport - '.Carbon::parse($request->from)->toDateString().' - '.Carbon::parse($request->to)->toDateString().'.csv');
        }
    }

    public function subscribers(Request $request){
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        $data = [];

        $all_subscriber = EmailSubscribe::whereBetween('updated_at', [Carbon::parse($request->from), Carbon::parse($request->to)->addDays()])->orderBy('id', 'desc')
        ->get();
        $export = new Subscribers();
        foreach ($all_subscriber as $subscribers) {
            array_push($data, $subscribers);
        }
        return Excel::download($export->getDownloadByQuery($data), 'Subscribers - '.Carbon::parse($request->from)->toDateString().' - '.Carbon::parse($request->to)->toDateString().'.csv');
    }
}

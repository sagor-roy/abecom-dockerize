<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\CorporateSales;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PriceMatch;
use App\Models\Product;
use App\Models\ServiceComplaint;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Varient;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {


        $today = Carbon::now()->toDateString(); //2021-01-27

        


        $orders = Order::where('order_status','Delivered')->where('is_active', true)->where('payment_status','Success')->get();
        $total_sale = 0 ;
        $today_sale = 0 ;
        $one_month_sale = 0 ;
        $one_year_sale = 0 ;

        foreach ($orders as $order) {
            $total_sale += $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
            if ($order->updated_at->toDateString() == $today ) {
                $today_sale += $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
            }
            $difference = $order->updated_at->diffInDays(Carbon::now());

            if ($difference < 30) {
                $one_month_sale += $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
            }
            if ($difference < 365) {
                $one_year_sale += $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
            }
        }

        $product = Product::where('is_active', true)->count();
        $category = Category::where('is_active', true)->count();
        $subcategory = SubCategory::where('is_active', true)->count();
        $brand = Brand::where('is_active', true)->count();
        $customer = Customer::count();
        $a_customer = Customer::where('is_active', true)->count();
        $i_customer = Customer::where('is_active', false)->count();
        $user = User::where('is_active', true)->where('is_admin','!=', true)->count();

        $new_order = Order::where('is_active', true)->where('order_status','Pending')->count();

        $new_message = Contact::where("is_replied", false)->count();
        $corporate_sale = CorporateSales::where("is_replied", false)->count();
        $service_complaint = ServiceComplaint::where("is_replied", false)->count();
        $price_match = PriceMatch::where("is_replied",false)->count();

        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));

        $current_visitors = 0;
        $page_views = 0;

        if( count($analyticsData) > 0 ){
            $current_visitors = $analyticsData[0]['visitors'];
            $page_views = $analyticsData[0]['pageViews'];
        }



        return view('backend.dashboard', compact(
            'product','category','subcategory','brand','customer','user','a_customer','i_customer','today_sale','total_sale','one_month_sale','one_year_sale',
            'new_order', 'current_visitors', 'page_views','new_message','corporate_sale','service_complaint','price_match'
    ));
    }

    public function product_request_chart(Request $request){
        if( $request->ajax() ){
            $product = [];
            $productRequestChart = OrderProduct::orderBy("id","desc")->where('is_delivered', true)->selectRaw('product_id, AVG(quantity) quantity')
                                    ->groupBy('product_id')
                                    ->take(20)
                                    ->get();
            foreach( $productRequestChart as $chart ) {
                array_push($product,Product::where("id",$chart->product_id)->select("name")->first());
            }

            return response()->json(['product' => $product,'productRequestChart' => $productRequestChart], 200);
        }
    }

    //category product chart
    public function category_product_chart(Request $request){
        if( $request->ajax() ){
            $categories = Category::where('is_active', true)->get();
            $data = [];
            foreach( $categories as $category ){
                array_push($data,Product::where("category_id",$category->id)->select("id")->where("is_active", true)->count());
            }
            return response()->json([
                'category' => $categories,
                'product' => $data
            ], 200);
        }
    }

    public function category_attribute_chart(Request $request){
        if( $request->ajax() ){
            $categories = Category::where('is_active', true)->get();
            $data = [];
            foreach( $categories as $category ){
                array_push($data,$category->category_varient->groupBy('varient_id')->count());
            }
            return response()->json([
                'category' => $categories,
                'varient' => $data
            ], 200);
        }
    }

}

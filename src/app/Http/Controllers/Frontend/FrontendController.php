<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryVarient;
use App\Models\City;
use App\Models\Contact;
use App\Models\ContactDetail;
use App\Models\Counting;
use App\Models\CustomPage;
use App\Models\EmailSubscribe;
use App\Models\Offer;
use App\Models\BankPayment;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\Cache;
use App\Models\ProductBlock;
use App\Models\ProductWarranty;
use Exception;
use Illuminate\Http\Response;

class FrontendController extends Controller
{
    public function home(Request $request)
    {
        $response = new Response('Cookie Set Successfully');
        $response->withCookie(cookie()->forever('ABElectronics', 'https://abe.com.bd'));

        if (Cache::has('ABElectronics')){
            Cache::get('ABElectronics');
            return view('frontend.pages.home');
         } else {
            Cache::forever('ABElectronics','https://abe.com.bd');
            return view('frontend.pages.home');
        }

    }

    public function about(){
        $contact_detail = ContactDetail::first();
        return view("frontend.pages.about", compact('contact_detail'));
    }

    public function contact(){
        return view("frontend.pages.contact");
    }

    public function contact_send(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
            "message" => "required",
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $contact = new Contact();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->message = $request->message;
                $contact->is_replied = false;
                if( $contact->save() ){
                    return response()->json(['success' => 'Thanks for contacting with us'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    public function stores(){
        return view("frontend.pages.stores");
    }

    public function corporate_sale(){
        return view("frontend.pages.corporate_sale");
    }

    public function service_complaint(){
        return view("frontend.pages.service_complaint");
    }

    public function login()
    {
        if (auth('customer')->check()) {
            return redirect()->route('profile', auth('customer')->user()->id);
        }

        return view('frontend.pages.login');
    }

    public function social_share()
    {
        Share::page('http://jorenvanhocht.be')->facebook();
    }

    public function register()
    {
        return view('frontend.pages.register');
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = Product::where('category_id', $category->id)->where('is_active', true)->select("id","slug","name","thumbnail","price","offer_price")->paginate(20);

        return view('frontend.pages.category', compact('category', 'products'));
    }

    public function subcategory($slug)
    {
        $sub_cat = SubCategory::where('slug', $slug)->first();

        $products = Product::where('sub_category_id', $sub_cat->id)->where('is_active', true)->select("id","slug","name","thumbnail","price","offer_price")->paginate(20);

        return view('frontend.pages.sub_category', compact('sub_cat', 'products'));
    }

    public function brand($slug){
        $brand = Brand::where('slug', $slug)->first();
        $products = Product::where('brand_id', $brand->id)->where('is_active', true)->select("id","slug","name","thumbnail","price","offer_price")->paginate(20);
        return view('frontend.pages.brand', compact('brand', 'products'));
    }

    public function checkout()
    {
        if (auth('customer')->check()) {

            $cities = City::with('thanas')->where('is_active', true)->orderBy('id','desc')->get();
            $bank_payment = BankPayment::find(1);

            $checkout_page_nb = ContactDetail::select('id', 'checkout_page_nb')->first();

            return view('frontend.pages.checkout', compact('cities', 'bank_payment', 'checkout_page_nb'));
        } else {
            return view('frontend.pages.login');
        }
    }

    public function offer()
    {
        return view('frontend.pages.offer');
    }

    public function offer_single($slug)
    {
        $offer = Offer::where("slug",$slug)->first();

        if( $offer ){
            
            if( count($offer->category) != 0 ){
                $category = $offer->category->first();
                $products = Product::where("is_active", true)->where("category_id", $category->id)->paginate(18);
            }
            else{
                $products = Product::where("is_active", true)->where("offer_id", $offer->id)->paginate(18);
                
            }
            
            return view('frontend.pages.offer_single', compact('offer', 'products'));
        }
        else{
            return back()->with('warning','No offer found');
        }


    }

    //offer filter
    public function offer_filter(Request $request){
        if( $request->ajax() ){
            $category = Category::find($request->category_id);
            $offer = Offer::find($request->offer_id);
            $sub_categories = SubCategory::where("category_id", $category->id)->where("is_active", true)->select("id","name")->get();

            if( $offer->product->count() == 0 ){
                return response()->json([
                    'products' => new ProductCollection($category->product->where("is_active", true)),
                    'sub_categories' => $sub_categories
                ], 200);
            }else{
                return response()->json([
                    'products' => new ProductCollection($offer->product->where("is_active", true)),
                    'sub_categories' => $sub_categories
                ], 200);
            }
        }
    }


    //offer_subcategory_filter function start
    public function offer_subcategory_filter(Request $request){
        if( $request->ajax() ){
            $sub_category = SubCategory::find($request->sub_category_id);
            $offer = Offer::find($request->offer_id);

            if( $offer->products->count() == 0 ){
                return response()->json([
                    'products' => new ProductCollection($offer->products->where("is_active", true)->where("sub_category_id", $sub_category->id)),
                ], 200);
            }else{
                return response()->json([
                    'products' => new ProductCollection($offer->products->where("is_active", true)->where("sub_category_id", $sub_category->id)),
                ], 200);
            }
        }
    }
    //offer_subcategory_filter function end


    public function productdetails($slug)
    {

        $product = Product::where('slug', $slug)->first();

        $related_products = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->where('is_active', true)->take(10)->get();

        $product_warranty = ProductWarranty::first();

        $data = [];
        if (auth('customer')->check() && auth('customer')->user()->order->where('order_status', 'Delivered')->count() > 0) {
            foreach (auth('customer')->user()->order as $customer_order) {
                foreach ($customer_order->order_product as $order_product) {
                    if (!$data) {
                        if ($order_product->product_id == $product->id) {
                            array_push($data, $product);
                        }
                    }
                }
            }
        }

        return view('frontend.pages.product_detail', compact('product', 'related_products', 'data', 'product_warranty'));
    }

    //subscribe
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscribe_email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $exist = EmailSubscribe::where('email', $request->subscribe_email)->first();
            if ($exist) {
                return response()->json(['already_subscribe' => 'You already subscribe once'], 200);
            } else {
                $subscribe = new EmailSubscribe();
                $subscribe->email = $request->subscribe_email;
                if ($subscribe->save()) {
                    return response()->json(['subscribe' => 'Subscription successfully done'], 200);
                }
            }
        }
    }

    public function profile()
    {
        if (auth('customer')->check()) {
            return view('frontend.pages.profile');
        } else {
            return view('frontend.pages.login');
        }
    }

    public function price_filter($min, $max, $cat_id)
    {
        $query = Product::where('category_id', $cat_id)->where('is_active', true);

        $query = $query->whereBetween('price', [$min, $max]);

        $products = $query->get();

        return response()->json(['products' => new ProductCollection($products)], 200);
    }

    public function sub_cat_filter($id)
    {
        $sub_cat = SubCategory::find($id);

        $products = Product::where('sub_category_id', $id)->where('is_active', true)->where('category_id', $sub_cat->category_id)->get();

        return response()->json(['products' => new ProductCollection($products)], 200);
    }

    public function brand_filter($id, $cat_id)
    {
        $brand = Brand::find($id);
        $data = [];

        $products = Product::where('brand_id', $id)->where('is_active', true)->get();

        foreach( $products as $product ){
            if( $product->category_id == $cat_id ){
                array_push($data,new ResourcesProduct($product));
            }
        }

        return response()->json(['products' => $data], 200);
    }

    //category attribute filter
    public function category_attribute_filter($cat_var_id)
    {
        $category_varient = CategoryVarient::find($cat_var_id);
        $products = [];
        foreach ($category_varient->product_varient_value as $product_varient_value) {
            array_push($products, new ResourcesProduct($product_varient_value->product));
        }

        return response()->json(['products' => $products], 200);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $text = $request->search;
        $search = Product::select("name","thumbnail","price","offer_price","slug","description","specification","short_description","is_active")
        ->where('name', 'LIKE', "%$request->search%")
        ->where("is_active", true)

      ->paginate(20)
      ;
        // $category = Category::find($request->category_id);


        return view('frontend.pages.search', compact('search', 'text'));
    }

    //courier
    public function courier($id, Request $request)
    {
        $city = City::Find($id);
        if ($city) {
            $delivery_charge = 0;
            $total = 0;
            $balance = 0;
            foreach ($request->session()->get('cart') as $single_cart) {
                $total += ($single_cart['quantity'] * $single_cart['unit_price']);
                if ($delivery_charge < $single_cart['delivery_charge']) {
                    $delivery_charge = $single_cart['delivery_charge'];
                }
            }
            if (auth('customer')->check()) {
                $balance = auth('customer')->user()->balance;
            } else {
                $balance = 0;
            }
            if (strtolower($city->city) == 'dhaka') {
                return response()->json(['hide_courier' => 'Hide Courier', 'delivery_charge' => $delivery_charge, 'total' => $total, 'balance' => $balance], 200);
            } else {
                return response()->json(['show_courier' => 'show Courier', 'delivery_charge' => 0, 'total' => $total, 'balance' => $balance], 200);
            }
        } else {
            return response()->json(['error' => 'Invalid City'], 200);
        }
    }

    //home page brand filter
    public function home_brand_filter($pblock, $cat_id, $brand)
    {

        $pblock = ProductBlock::find($pblock);

        $data = [];
        if( $brand == 'all' ){
            $products = Product::orderBy('id','desc')->where('category_id',$cat_id)->where('is_active', true)->take(8)->get();
            foreach( $products as $product ){
                array_push($data,new ResourcesProduct($product));
            }
        }else{
            $products = Product::orderBy('id','desc')->where('category_id',$cat_id)->where('brand_id',$brand)->where('is_active', true)->take(8)->get();
            foreach( $products as $product ){

                array_push($data,new ResourcesProduct($product));

            }
        }
        return response()->json(['products'  => $data,'pblock' => $pblock], 200);
    }

    //home page category filter
    public function home_category_filter($pblock,$brand,$cat_id){

        $pblock = ProductBlock::find($pblock);

        $data = [];
        if( $brand == 'all' ){
            $products = Product::orderBy('id','desc')->where('category_id',$cat_id)->where('is_active', true)->take(8)->get();
            foreach( $products as $product ){
                array_push($data,new ResourcesProduct($product));
            }
        }else{
            $products = Product::orderBy('id','desc')->where('category_id',$cat_id)->where('brand_id',$brand)->where('is_active', true)->take(8)->get();
            foreach( $products as $product ){

                array_push($data,new ResourcesProduct($product));

            }
        }

        return response()->json(['color' => $pblock->color, 'products'  => $data,'pblock' => $pblock], 200);
    }

    //home page offer filter
    public function home_offer_filter($id)
    {
        $offer = Offer::find($id);
        $data = [];
        $day = [];
        $hour = [];
        $minute = [];
        $second = [];
        $discount = "";
        $content = "";
        
        if( isset($offer->category[0]) ){
            foreach ($offer->category[0]->product->where("is_active", true)->take(5) as $product) {
                array_push($data, new ResourcesProduct($product));
                array_push($day, Carbon::now()->diffInDays(Carbon::parse($offer->end_date)));
                array_push($hour, (24 - Carbon::now()->format('H')) );
                array_push($minute, (60 - Carbon::now()->format('i')) );
            }
        }
        else{
            foreach ($offer->product->where("is_active", true)->take(5) as $product) {
                array_push($data, new ResourcesProduct($product));
                array_push($day, Carbon::now()->diffInDays(Carbon::parse($offer->end_date)));
                array_push($hour, (24 - Carbon::now()->format('H')) );
                array_push($minute, (60 - Carbon::now()->format('i')) );
            }
        }
        
        
        if( $offer->percent == 0 ){
            $discount = $offer->cash_discount . " BDT";
        }elseif( $offer->cash_discount == 0 ){
            $discount = $offer->percent . " %";
        }
        if($offer->percent){
            $content = "Upto ".$offer->percent."% discount";
        }
        elseif($offer->cash_discount){
            $content = "Upto ".$offer->cash_discount ." taka discount";
        }

        $image = asset('images/clock.gif');
        $url = route('offer.single', $offer->slug);

        return response()->json(['products' => $data, 'discount' => $discount,  'percent' => $offer->percent, 'day' => $day, 'hour' => $hour, 'minute' => $minute, 'image' => $image, 'name' => $offer->name, 'url' => $url,'content' => $content], 200);
    }

    //home page product type filter start
    public function home_product_type_filter($id)
    {
        if ($id == 'featured') {
            $products = Product::orderBy('id', 'desc')->where('is_featured', true)->where('is_active', true)->take(6)->get();
            $data = [];
            foreach ($products as $product) {
                array_push($data, new ResourcesProduct($product));
            }

            return response()->json(['products' => $data], 200);
        } elseif ($id == 'onsale') {
            $products = Product::orderBy('id', 'desc')->where('is_onsale', true)->where('is_active', true)->take(6)->get();
            $data = [];
            foreach ($products as $product) {
                array_push($data, new ResourcesProduct($product));
            }

            return response()->json(['products' => $data], 200);
        } elseif ($id == 'toprated') {
            $products = Product::orderBy('id', 'desc')->where('is_top_rated', true)->where('is_active', true)->take(6)->get();
            $data = [];
            foreach ($products as $product) {
                array_push($data, new ResourcesProduct($product));
            }

            return response()->json(['products' => $data], 200);
        } else {
            return response()->json(['error' => 'Something went wrong'], 200);
        }
    }


    //custom_page function start
    public function custom_page($slug){
        try{
            $custom_page = CustomPage::where("slug", $slug)->select("name","content")->first();

            if( $custom_page ){
                return view("frontend.pages.custom_page", compact('custom_page'));

            }
            else{
                return view("errors.404");
            }

        }
        catch( Exception $e ){
            return back()->with('warning', $e->getMessage());
        }
    }
    //custom_page function end


}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{
    public function index(){
        
        return view('backend.pages.offer.category.manage');
    }

    public function data(Request $request)
    {
        $offer = Offer::orderBy('id', 'desc')->get();

        return DataTables::of($offer)
        ->rawColumns(['action','image','offer', 'category','product' ,'status'])
        ->editColumn('image', function (Offer $offer) {
            $url = asset('images/offer/'.$offer->image);
            $banner = asset('images/offer/'.$offer->banner);

            return "
            <p>Offer Image : <img src='".$url."' width='50px' /> </p>
            <p>Offer Image : <img src='".$banner."' width='50px' /> </p>
            ";
        })
        ->editColumn('offer', function (Offer $offer) {
            $discount = "";
            if( $offer->percent == 0 ){
                $discount = $offer->cash_discount . " BDT";
            }elseif( $offer->cash_discount == 0 ){
                $discount = $offer->percent . " %";
            }

            return "
            <p>$offer->name</p>
            <p>$discount</p>
            <p>End Date : $offer->end_date</p>
            <p> Color : <span style='background: $offer->color;
                padding: 2px 10px;
                margin-left: 5px;'></span></p>
            ";
        })
        ->editColumn('category', function (Offer $offer) {
            $data = [];
            foreach( $offer->category as $category ){
                array_push($data, $category->name);
            }
            return $data;
        })
        ->editColumn('status', function (Offer $offer) {
            if ($offer->status == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Offer $offer) {
            return '
            <button type="button" data-content="'.route('cat.offer.view', $offer->id).'" data-target="#largeModal" class="btn btn-success" data-toggle="modal">
                    <i class="fas fa-eye"></i>
            </button>
            <button type="button" data-content="'.route('cat.offer.edit', $offer->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                <i class="fas fa-edit"></i>
            </button>
            ';
        })
        ->make(true);
    }

    public function add(Request $request){

        if( $request->all_product == true ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:offers,name',
                'categories.*' => 'required',
                'date' => 'required',
                'image' => 'required|dimensions:min_width=90,max_width=90,min_height=90,max_height=90',
                'banner' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'percent' => 'required',
                'cash_discount' => 'required',
                'color' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:offers,name',
                'categories.*' => 'required',
                'products.*' => 'required',
                'date' => 'required',
                'image' => 'required|dimensions:min_width=90,max_width=90,min_height=90,max_height=90',
                'banner' => 'required|dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'percent' => 'required',
                'cash_discount' => 'required',
                'color' => 'required',
            ]);
        }

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{

            try{
                //check is offer exists in category
                if( $request['categories'] ){
                    foreach( $request['categories'] as $category ){
                        if( Category::find($category)->offer_status == 1 ){
                            return response()->json(['warning' => 'Already a offer exists in your selected category'], 200);
                        }
                    }
                }

                //check is offer exists in product
                if( $request->all_product == false ){
                    foreach( $request['products'] as $product ){
                        if( Product::find($product)->offer_status == 1 ){
                            return response()->json(['warning' => 'Already a offer exists in your selected product'], 200);
                        }
                    }
                }else{
                    foreach( $request['categories'] as $category ){
                        foreach( Category::find($category)->product as $product ){
                            if( $product->offer_status == 1 ){
                                return response()->json(['warning' => 'Already a offer exists in your selected product'], 200);
                            }
                        }
                    }
                }



                $offer = new Offer();
                $offer->name = $request->name;
                $offer->slug = Str::slug($request->name);
                $offer->color = $request->color;

                if( $request->percent == 0 ){
                    $offer->percent = 0;
                    $offer->cash_discount = $request->cash_discount;
                }elseif( $request->cash_discount  == 0){
                    $offer->percent = $request->percent;
                    $offer->cash_discount = 0;
                }


                $offer->end_date = $request->date ;
                $offer->status = true;

                if ($request->image) {
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/offer/'.$img);
                    Image::make($image)->save($location);
                    $offer->image = $img;
                }
                if ($request->banner) {
                    $image = $request->file('banner');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/offer/'.$img);
                    Image::make($image)->save($location);
                    $offer->banner = $img;
                }


                if( $offer->save() ){

                    if( $request['categories'] ){
                        foreach( $request['categories'] as $category ){
                            $cat = Category::find($category);
                            if( $cat->offer_status == 0 ){
                                $offer->category()->attach($category);
                                $cat->offer_status = true;
                                $cat->save();
                            }
                        }
                    }

                    if( $request->all_product == false ){
                        foreach( $request['products'] as $product_id ){
                            $product = Product::find($product_id);
                            $offer->product()->attach($product_id);
                            if( $product->offer_status == false ){
                                if( $offer->percent == 0 ){
                                    $product->offer_price = $product->price - $offer->cash_discount;
                                    $product->offer_status = true;
                                    $product->offer_id = $offer->id;
                                    $product->save();
                                }
                                elseif( $offer->cash_discount  == 0 ){
                                    $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                                    $product->offer_price = $product->price - $discount_price;
                                    $product->offer_id = $offer->id;
                                    $product->offer_status = true;
                                    $product->save();
                                }
                            }
                        }
                    }else{
                        foreach( $offer->category as $offer_category ){
                            foreach( $offer_category->product as $product ){
                                if( $product->offer_status == false ){
                                    if( $offer->percent == 0 ){
                                        $product->offer_price = $product->price - $offer->cash_discount;
                                        $product->offer_status = true;
                                        $product->offer_id = $offer->id;
                                        $product->save();
                                    }
                                    elseif( $offer->cash_discount  == 0 ){
                                        $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                                        $product->offer_price = $product->price - $discount_price;
                                        $product->offer_status = true;
                                        $product->offer_id = $offer->id;
                                        $product->save();
                                    }
                                }
                            }

                        }
                    }

                    return response()->json(['create' => $offer], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }



        }

    }

    public function edit($id){
        $offer = Offer::find($id);
        return view('backend.pages.offer.category.edit', compact('offer'));
    }

    public function update(Request $request, $id){

        if( $request->all_product == true ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:offers,name,'.$id,
                'categories.*' => 'required',
                'date' => 'required',
                'image' => 'dimensions:min_width=90,max_width=90,min_height=90,max_height=90',
                'banner' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'percent' => 'required',
                'cash_discount' => 'required',
                'color' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:offers,name,'.$id,
                'categories.*' => 'required',
                'products.*' => 'required',
                'date' => 'required',
                'image' => 'dimensions:min_width=90,max_width=90,min_height=90,max_height=90',
                'banner' => 'dimensions:min_width=1150,max_width=1150,min_height=400,max_height=400',
                'percent' => 'required',
                'cash_discount' => 'required',
                'color' => 'required',
            ]);
        }


        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $offer = Offer::find($id);



                //check is offer exists in category
                if( $request['categories'] ){
                    foreach( $request['categories'] as $category ){
                        if( $offer->category->find($category) ){
                            $other_offer = Offer::where('id','!=',$id)->where('status', true)->get();
                            foreach( $other_offer as $o_f ){
                                foreach( $o_f->category as $o_f_category ){
                                    if( $o_f_category->id == $category ){
                                        return response()->json(['warning' => 'Already a offer exists in your selected category'], 200);
                                    }
                                }
                            }
                        }else{
    
                            if( Category::find($category)->offer_status == 1 ){
    
                                return response()->json(['warning' => 'Already a offer exists in your selected category'], 200);
                            }
                        }
                    }
                }
                

                //check is offer exists in product
                if( $request->all_product == false ){
                    foreach( $request['products'] as $product ){
                        if( $offer->product->find($product) ){

                        }else{
                            if( Product::find($product)->offer_status == 1 ){
                                return response()->json(['warning' => 'Already a offer exists in your selected product'], 200);
                            }
                        }
                    }
                }else{
                    foreach( $request['categories'] as $category ){
                        if( $offer->category->find($category) ){

                        }else{
                            foreach( Category::find($category)->product as $product ){
                                if( $product->offer_status == 1 ){
                                    return response()->json(['warning' => 'Already a offer exists in your selected product'], 200);
                                }
                            }
                        }

                    }
                }

                $offer->name = $request->name;
                $offer->slug = Str::slug($request->name);
                $offer->color = $request->color;

                if( $request->percent == 0 ){
                    $offer->percent = 0;
                    $offer->cash_discount = $request->cash_discount;
                }elseif( $request->cash_discount  == 0){
                    $offer->percent = $request->percent;
                    $offer->cash_discount = 0;
                }

                $offer->end_date = $request->date ;
                $offer->status = $request->is_active;

                if ($request->image) {
                    if( File::exists('images/offer/'. $request->image) ){
                        File::delete('images/offer/'. $request->image);
                    }
                    $image = $request->file('image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/offer/'.$img);
                    Image::make($image)->save($location);
                    $offer->image = $img;
                }

                if ($request->banner) {
                    if( File::exists('images/offer/'. $request->banner) ){
                        File::delete('images/offer/'. $request->banner);
                    }
                    $image = $request->file('banner');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/offer/'.$img);
                    Image::make($image)->save($location);
                    $offer->banner = $img;
                }


                if( $offer->save() ){

                    //remove existing offers start
                    foreach( $offer->category as $exists_offer_category ){
                        $exists_offer_category->offer_status = false;
                        $exists_offer_category->save();
                        foreach( $exists_offer_category->product as $exists_offer_category_product ){
                            $exists_offer_category_product->offer_status = false;
                            $exists_offer_category_product->offer_price = null;
                            $exists_offer_category_product->offer_id = null;
                            $exists_offer_category_product->save();
                        }
                    }
                    foreach( $offer->product as $exists_offer_product ){
                        $exists_offer_product->offer_status = false;
                        $exists_offer_product->offer_status = false;
                        $exists_offer_product->offer_id = null;
                        $exists_offer_product->save();
                    }
                    //remove existing offers end


                    $offer->category()->detach();
                    
                    if( $request['categories'] ){
                        foreach( $request['categories'] as $category ){
                            $cat = Category::find($category);
                            $offer->category()->attach($category);
                            if( $offer->status == true ){
                                $cat->offer_status = true;
                                $cat->save();
                            }else{
                                $cat->offer_status = false;
                                $cat->save();
                            }
    
                        }
                    }
                    

                    if( $request->all_product == false ){
                        $offer->product()->detach();
                        foreach( $request['products'] as $product_id ){
                            $product = Product::find($product_id);
                            $offer->product()->attach($product_id);
                            if( $offer->percent == 0 ){
                                if( $offer->status == true ){
                                    $product->offer_price = $product->price - $offer->cash_discount;
                                    $product->offer_status = true;
                                    $product->offer_id = $offer->id;
                                    $product->save();
                                }else{
                                    $product->offer_price = null;
                                    $product->offer_status = false;
                                    $product->offer_id = null;
                                    $product->save();
                                }

                            }
                            elseif( $offer->cash_discount  == 0 ){
                                if( $offer->status == true ){
                                    $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                                    $product->offer_price = $product->price - $discount_price;
                                    $product->offer_status = true;
                                    $product->offer_id = $offer->id;
                                    $product->save();
                                }else{
                                    $product->offer_price = null;
                                    $product->offer_status = false;
                                    $product->offer_id = null;
                                    $product->save();
                                }

                            }
                        }
                    }else{

                        $offer->product()->detach();
                        foreach( $request['categories'] as $offer_category_id ){
                            $offer_category = Category::find($offer_category_id);
                            foreach( $offer_category->product as $product ){
                                if( $offer->percent == 0 ){
                                    if( $offer->status == true ){
                                        $product->offer_price = $product->price - $offer->cash_discount;
                                        $product->offer_status = true;
                                        $product->offer_id = $offer->id;
                                        $product->save();
                                    }else{
                                        $product->offer_price = null;
                                        $product->offer_status = false;
                                        $product->offer_id = null;
                                        $product->save();
                                    }

                                }
                                elseif( $offer->cash_discount  == 0 ){
                                    if( $offer->status == true ){
                                        $discount_price = floor(( $offer->percent / 100 ) * $product->price);
                                        $product->offer_price = $product->price - $discount_price;
                                        $product->offer_status = true;
                                        $product->offer_id = $offer->id;
                                        $product->save();
                                    }else{
                                        $product->offer_price = null;
                                        $product->offer_status = false;
                                        $product->offer_id = null;
                                        $product->save();
                                    }

                                }
                            }

                        }
                    }

                    return response()->json(['create' => $offer], 200);
                }
            }
            catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    // public function delete_modal($id){
    //     $offer = Offer::find($id);
    //     return view('backend.pages.offer.category.delete', compact('offer'));
    // }

    // public function delete($id){
    //     $offer = Offer::find($id);
    //     if (File::exists('images/offer/'.$offer->image)) {
    //         File::delete('images/offer/'.$offer->image);
    //     }
    //     if( $offer->delete() ){
    //         return response()->json(['delete' => $offer], 200);
    //     }
    // }

    //view offer start
    public function view($id){
        $offer = Offer::find($id);
        return view('backend.pages.offer.modals.view', compact('offer'));
    }

}

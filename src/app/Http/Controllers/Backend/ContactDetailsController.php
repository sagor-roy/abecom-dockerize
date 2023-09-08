<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ContactDetailsController extends Controller
{
    public function index(){
        return view('backend.pages.contact.manage');
    }


    public function data()
    {
        $contact = ContactDetail::orderBy('id', 'desc')->get();

        return DataTables::of($contact)
        ->rawColumns(['action', 'contact'])
        ->editColumn('contact', function (ContactDetail $contact) {
            $logo = asset('images/logo/'. $contact->logo);
            $footer_logo = asset('images/logo/'. $contact->footer_logo);
            $fav = asset('images/logo/'. $contact->fav);
            return "
                <p>
                    <b>Logo : <img src='$logo' width='50px'></b>
                </p>
                <p>
                    <b>Footer Logo : <img src='$footer_logo' width='50px'></b>
                </p>
                <p>
                    <b>Fav Icon : <img src='$fav' width='30px'></b>
                </p>
                <p>
                    <b>address : </b> $contact->address
                </p>
                <p>
                    <b>Hotline : </b>  $contact->hotline
                </p>
                <p>
                    <b>Phone : </b>  $contact->phone
                </p>
                <p>
                    <b>email : </b> $contact->email
                </p>
                <p>
                    <b>Opening Time : </b> $contact->open_time
                </p>
                <p>
                    <b>Closing Time : </b> $contact->close_time
                </p>
                <p>
                    <b>Offer Title : </b> $contact->offer_title
                </p>
                <p>
                    <b>Footer Title : </b>  $contact->footer_title
                </p>
            ";
        })
        ->addColumn('action', function (ContactDetail $contact) {
            return '
            <button type="button" data-content="'.route('contact.edit', $contact->id).'" data-target="#largeModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //edit start
    public function edit($id){
        $contact = ContactDetail::find($id);
        return view('backend.pages.contact.modals.edit', compact('contact'));
    }

    //update
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|numeric',
            'hotline' => 'required|regex:/(01)[0-9]{9}/|numeric',
            'address' => 'required',
            'store_info' => 'required',
            'map' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'logo' => 'mimes:dimensions:min_width=1073,max_width=1073,min_height=164,max_height=164',
            'footer_logo' => 'dimensions:min_width=240,max_width=240,min_height=145,max_height=145',
            'fav' => 'mimes:jpg,jpeg,png|dimensions:min_width=263,max_width=263,min_height=164,max_height=164',
            'shop_banner' => 'mimes:jpg,jpeg,png|dimensions:min_width=1150,max_width=1150,min_height=300,max_height=300',
            'offer_banner' => 'mimes:jpg,jpeg,png|dimensions:min_width=1150,max_width=1150,min_height=300,max_height=300',
            'product_details_title' => 'required',
            'product_details_list' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $contact = ContactDetail::find($id);
            $contact->email = $request->email;
            $contact->hotline = $request->hotline;
            $contact->phone = $request->phone;
            $contact->address = $request->address;
            $contact->map = $request->map;
            $contact->store_info = $request->store_info;
            $contact->open_time = $request->open_time;
            $contact->close_time = $request->close_time;
            $contact->offer_title = $request->offer_title;
            $contact->product_details_title = $request->product_details_title;
            $contact->product_details_list = $request->product_details_list;
;

            if ($request->logo) {
                if (File::exists('images/logo/'.$contact->logo)) {
                    File::delete('images/logo/'.$contact->logo);
                }

                $image = $request->file('logo');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/logo/'.$img);
                Image::make($image)->save($location);
                $contact->logo = $img;
            }

            if ($request->footer_logo) {
                if (File::exists('images/logo/'.$contact->footer_logo)) {
                    File::delete('images/logo/'.$contact->footer_logo);
                }

                $image = $request->file('footer_logo');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/logo/'.$img);
                Image::make($image)->save($location);
                $contact->footer_logo = $img;
            }

            if ($request->fav) {
                if (File::exists('images/logo/'.$contact->fav)) {
                    File::delete('images/logo/'.$contact->fav);
                }

                $image = $request->file('fav');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/logo/'.$img);
                Image::make($image)->save($location);
                $contact->fav = $img;
            }

            if ($request->shop_banner) {
                if (File::exists('images/logo/'.$contact->shop_banner)) {
                    File::delete('images/logo/'.$contact->shop_banner);
                }

                $image = $request->file('shop_banner');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/logo/'.$img);
                Image::make($image)->save($location);
                $contact->shop_banner = $img;
            }

            if ($request->offer_banner) {
                if (File::exists('images/logo/'.$contact->offer_banner)) {
                    File::delete('images/logo/'.$contact->offer_banner);
                }

                $image = $request->file('offer_banner');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/logo/'.$img);
                Image::make($image)->save($location);
                $contact->offer_banner = $img;
            }

            if ($request->about_us_image) {
                if (File::exists('images/about_us_image/'.$contact->about_us_image)) {
                    File::delete('images/about_us_image/'.$contact->about_us_image);
                }

                $image = $request->file('about_us_image');
                $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/about_us_image/'.$img);
                Image::make($image)->save($location);
                $contact->about_us_image = $img;
            }

            if( $contact->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }
}

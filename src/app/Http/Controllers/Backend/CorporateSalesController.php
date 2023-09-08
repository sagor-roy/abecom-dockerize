<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use App\Models\CorporateSales;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CorporateSalesController extends Controller
{
    //index
    public function index(){
        return view("backend.pages.allpages.corporate_sales.manage");
    }

    //data
    public function data(){
        $corporate_sales = CorporateSales::orderBy('id', 'desc')->get();

        return DataTables::of($corporate_sales)
        ->rawColumns(['action', 'name','type','is_replied'])
        ->editColumn('name', function (CorporateSales $corporate_sales) {
            return "
                <p><b>Name</b> : $corporate_sales->name</p>
                <p><b>Email</b> : $corporate_sales->email</p>
                <p><b>Phone</b> : $corporate_sales->phone</p>
                <p><b>Company</b> : $corporate_sales->company</p>
                <p><b>City</b> : $corporate_sales->city</p>
                <p><b>Country</b> : $corporate_sales->country</p>
                <p><b>Address</b> : $corporate_sales->address</p>
                <p><b>Enquery</b> : $corporate_sales->enquery</p>
            ";
        })
        ->editColumn('type', function (CorporateSales $corporate_sales) {
            return "
                <p>$corporate_sales->type</p>
            ";
        })
        ->editColumn('is_replied', function (CorporateSales $corporate_sales) {
            $is_replied = "";
            if( $corporate_sales->is_replied == true ){
                return $is_replied = "<p class='badge badge-success'>Replied</p>";
            }
            else{
                return $is_replied = "<p class='badge badge-danger'>Not Replied</p>";
            }
        })
        ->addColumn('action', function (CorporateSales $corporate_sales) {
            return '
            <button type="button" data-content="'.route('corporate.sale.reply.modal', $corporate_sales->id).'" data-target="#largeModal" class="btn btn-primary" data-toggle="modal">
                    Reply
            </button>
            <button type="button" data-content="'.route('corporate.sale.reply.delete.modal', $corporate_sales->id).'" data-target="#largeModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //update
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'corporate_sale' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $contact_detail = ContactDetail::first();
                $contact_detail->corporate_sale = $request->corporate_sale;
                if( $contact_detail->save() ){
                    return response()->json(['success' => 'Updated Successfully'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
             
        }
    }

    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "company" => "required",
            "phone" => "required|numeric|regex:/(01)[0-9]{9}/",
            "email" => "required",
            "address" => "required",
            "city" => "required",
            "country" => "required",
            "enquery_type" => "required",
            "message" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $corporate_sale = new CorporateSales();
                $corporate_sale->name = $request->name;
                $corporate_sale->company = $request->company;
                $corporate_sale->phone = $request->phone;
                $corporate_sale->email = $request->email;
                $corporate_sale->address = $request->address;
                $corporate_sale->city = $request->city;
                $corporate_sale->country = $request->country;
                $corporate_sale->type = $request->enquery_type;
                $corporate_sale->enquery = $request->message;
                $corporate_sale->is_replied = false;
                if( $corporate_sale->save() ){
                    return response()->json(['success' => 'Thanks for your enquery. We will reply you soon'], 200);                
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //reply modal
    public function reply_modal($id){
        $corporate_sale = CorporateSales::find($id);
        return view("backend.pages.allpages.corporate_sales.modals.reply", compact("corporate_sale"));
    }

    //reply
    public function reply(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "reply" => "required",
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $corporate_sale = CorporateSales::find($id);
                if( $corporate_sale->is_replied == true ){
                    return response()->json(['warning' => 'You already replied'], 200);
                }
                $corporate_sale->reply = $request->reply;
                $corporate_sale->is_replied = true;
                $corporate_sale->user_id = auth('web')->user()->id;
                if( $corporate_sale->save() ){
                    $reply = $corporate_sale->reply;
                    $email = $corporate_sale->email;
                    Mail::send('emails.corporate_sale', ['reply' => $reply], function ($message) use ($email) {
                        $message->from('info@abe.com.bd');
                        $message->to($email);
                        $message->subject('Thanks for your enquery');
                    });
                    return response()->json(['success' => 'Reply Send Successfully'], 200);
                }
            }
            catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //delete modal
    public function reply_delete_modal($id){
        $corporate_sale = CorporateSales::find($id);
        return view("backend.pages.allpages.corporate_sales.modals.delete", compact("corporate_sale"));
    }

    //delete
    public function reply_delete($id){
        try{
            $corporate_sale = CorporateSales::find($id);
            if( $corporate_sale->delete() ){
                return response()->json(['success' => 'Message Deleted Successfully'], 200);
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

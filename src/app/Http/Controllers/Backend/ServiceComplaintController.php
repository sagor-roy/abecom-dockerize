<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use App\Models\ServiceComplaint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceComplaintController extends Controller
{
    //inedx
    public function index(){
        return view("backend.pages.allpages.service_complaint.manage");
    }

    //data
    public function data(){
        $service_complaint = ServiceComplaint::orderBy('id', 'desc')->get();

        return DataTables::of($service_complaint)
        ->rawColumns(['action', 'enquery','is_replied'])
        ->editColumn('enquery', function (ServiceComplaint $service_complaint) {
            return "
            <p> <b>Name</b> $service_complaint->name</p>
            <p> <b>Email</b> $service_complaint->email</p>
            <p> <b>Phone</b> $service_complaint->phone</p>
            <p> <b>Showroom</b> $service_complaint->showroom</p>
            <p> <b>Order No.</b> $service_complaint->invoice_number</p>
            <p> <b>Product Brand</b> $service_complaint->product_brand</p>
            <p> <b>Product Type</b> $service_complaint->product_type</p>
            <p> <b>Product Model No.</b> $service_complaint->product_model_number</p>
            <p> <b>Subject</b> $service_complaint->subject</p>
            <p> <b>Complain</b> $service_complaint->complain</p>
            ";
        })
        ->editColumn('is_replied', function (ServiceComplaint $service_complaint) {
            $is_replied = "";
            if( $service_complaint->is_replied == true ){
                return $is_replied = "<p class='badge badge-success'>Replied</p>";
            }
            else{
                return $is_replied = "<p class='badge badge-danger'>Not Replied</p>";
            }
        })
        ->addColumn('action', function (ServiceComplaint $service_complaint) {
            return '
            <button type="button" data-content="'.route('service.complaint.reply.modal', $service_complaint->id).'" data-target="#largeModal" class="btn btn-primary" data-toggle="modal">
                    Reply
            </button>
            <button type="button" data-content="'.route('service.complaint.reply.delete.modal', $service_complaint->id).'" data-target="#largeModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }

    //update
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'service_complaint' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $contact_detail = ContactDetail::first();
                $contact_detail->service_complaint = $request->service_complaint;
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
            'showroom' => 'required',
            'invoice' => 'required|numeric',
            'p_brand' => 'required',
            'subject' => 'required',
            'complain' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $service_complaint = new ServiceComplaint();
                $service_complaint->name = $request->name;
                $service_complaint->phone = $request->phone;
                $service_complaint->email = $request->email;
                $service_complaint->showroom = $request->showroom;
                $service_complaint->invoice_number = $request->invoice;
                $service_complaint->product_brand = $request->p_brand;
                $service_complaint->product_type = $request->p_type ?? null;
                $service_complaint->product_model_number = $request->p_model_number ?? null;
                $service_complaint->subject = $request->subject;
                $service_complaint->complain = $request->complain;
                $service_complaint->is_replied = false;
                if( $service_complaint->save() ){
                    return response()->json(['success' => 'Thanks for your enquery. We will contact with you soon', 200]);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //reply modal
    public function reply_modal($id){
        $service_complaint = ServiceComplaint::find($id);
        return view("backend.pages.allpages.service_complaint.modals.reply", compact("service_complaint"));
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
                $service_complaint = ServiceComplaint::find($id);
                if( $service_complaint->is_replied == true ){
                    return response()->json(['warning' => 'You already replied'], 200);
                }
                $service_complaint->reply = $request->reply;
                $service_complaint->is_replied = true;
                $service_complaint->user_id = auth('web')->user()->id;
                if( $service_complaint->save() ){
                    $reply = $service_complaint->reply;
                    $email = $service_complaint->email;
                    Mail::send('emails.service_complaint', ['reply' => $reply], function ($message) use ($email) {
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
        $service_complaint = ServiceComplaint::find($id);
        return view("backend.pages.allpages.service_complaint.modals.delete", compact("service_complaint"));
    }

    //delete
    public function reply_delete($id){
        try{
            $service_complaint = ServiceComplaint::find($id);
            if( $service_complaint->delete() ){
                return response()->json(['success' => 'Message Deleted Successfully'], 200);
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
}

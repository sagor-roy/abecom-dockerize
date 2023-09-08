<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    //index
    public function index(){
        return view("backend.pages.messages.manage");
    }

    //data
    public function  data(){
        $message = Contact::orderBy('id', 'desc')->get();

        return DataTables::of($message)
        ->rawColumns(['action', 'message','status','reply'])
        ->editColumn('message', function(Contact $message){
            return "
               <p>Name : $message->name</p>
               <p>Email : $message->email</p>
               <p>Phone : $message->phone</p>
               <p>Message : $message->message</p>
            ";
        })
        ->editColumn('reply', function(Contact $message){
            if( $message->reply == null ){
                return "<p class='badge badge-danger'>Not replied</p>";
            }
            else{
                return "
                <p>$message->reply</p>
                <small>Send at ".$message->updated_at->toDayDateTimeString()."</small> <br>
                <small>Replied by ".$message->user->name."</small>
                ";
            }
        })
        
        ->addColumn('action', function (Contact $message) {
            return '
                <p>
                <button type="button" data-content="'.route('message.reply.modal', $message->id).'" data-target="#myModal" class="btn btn-success" data-toggle="modal">
                    Reply
                </button>
                <button type="button" data-content="'.route('message.delete_modal', $message->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
                </button>
            </p>
            ';
        })
        ->make(true);
    }

    //delete modal
    public function delete_modal($id){
        $message = Contact::find($id);
        return view("backend.pages.messages.modals.delete", compact('message'));
    }
    //delete
    public function delete(Request $request, $id){
        try{
            $message = Contact::find($id);
            if( $message->delete() ){
                return response()->json(['delete'=>'Deleted'], 200);
            }
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

    //reply modal
    public function reply_modal($id){
        $message = Contact::find($id);
        return view("backend.pages.messages.modals.reply", compact('message'));
    }

    //reply
    public function reply($id, Request $request){
        $validator = Validator::make($request->all(),[
            "reply" => "required",
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $message = Contact::find($id);
                $message->reply = $request->reply;
                $message->is_replied = true;
                $message->user_id = auth("web")->user()->id;
               
                if( $message->save() ){
                    $email = $message->email;
                    $reply = $message->reply;
                    Mail::send('emails.message', ['reply' => $reply], function ($message) use ($email) {
                        $message->from('info@abe.com.bd');
                        $message->to($email);
                        $message->subject('Thanks for messaging us');
                    });
                    return response()->json(['success' => 'Reply sended'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
}

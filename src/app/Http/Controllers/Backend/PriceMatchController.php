<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PriceMatch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PriceMatchController extends Controller
{
    //index
    public function index(){
        return view("backend.pages.price_match.manage");
    }

    //data
    public function  data(){
        $price_match = PriceMatch::orderBy('id', 'desc')->get();

        return DataTables::of($price_match)
        ->rawColumns(['action', 'message', 'status' ,'reply'])
        ->editColumn('message', function(PriceMatch $price_match){
            $product = $price_match->product->name;
            $price = $price_match->product->price . " BDT";
            return "
               <p>Name : $price_match->name</p>
               <p>Email : $price_match->email</p>
               <p>Phone : $price_match->phone</p>
               <p>Message : $price_match->comment</p>
               <p>Product : $product</p>
               <p>Our Price : $price </p>
               <p>Match Price : $price_match->price BDT </p>
            ";
        })
        ->editColumn('status', function(PriceMatch $price_match){
            if( $price_match->is_replied == true ){
                return "<p class='badge badge-success'>Replied</p>";
            }
            else{
                return "<p class='badge badge-danger'>Not Replied</p>";
            }
        })
        ->editColumn('reply', function(PriceMatch $price_match){
            if( $price_match->reply == null ){
                return "<p class='badge badge-danger'>Not replied</p>";
            }
            else{
                return "
                <p>$price_match->reply</p>
                <small>Send at ".$price_match->updated_at->toDayDateTimeString()."</small> <br>
                <small>Replied by ".$price_match->user->name."</small>
                ";
            }
        })

        ->addColumn('action', function (PriceMatch $price_match) {
            return '
                <p>
                <button type="button" data-content="'.route('reply.modal', $price_match->id).'" data-target="#myModal" class="btn btn-success" data-toggle="modal">
                    Reply
                </button>
                <button type="button" data-content="'.route('price.match.delete.modal', $price_match->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
                </button>
            </p>
            ';
        })
        ->make(true);
    }

    //reply modal
    public function reply_modal($id){
        $price_match = PriceMatch::find($id);
        return view("backend.pages.price_match.modals.reply", compact("price_match"));
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
                $price_match = PriceMatch::find($id);
                if( $price_match->is_replied == true ){
                    return response()->json(['warning' => 'You already replied'], 200);
                }
                $price_match->reply = $request->reply;
                $price_match->is_replied = true;
                $price_match->user_id = auth('web')->user()->id;
                if( $price_match->save() ){
                    $reply = $price_match->reply;
                    $email = $price_match->email;
                    Mail::send('emails.price_match', ['reply' => $reply], function ($message) use ($email) {
                        $message->from('info@abe.com.bd');
                        $message->to($email);
                        $message->subject('Thanks for your message');
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
    public function delete_modal($id){
        $price_match = PriceMatch::find($id);
        return view("backend.pages.price_match.modals.delete", compact("price_match"));
    }

    //delete
    public function delete($id){
        try{
            $price_match = PriceMatch::find($id);
            if( $price_match->delete() ){
                return response()->json(['success' => 'Message Deleted Successfully'], 200);
            }
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

    //delete all
    public function delete_all(Request $request){
        PriceMatch::truncate();
        $request->session()->flash("success","All Message Deleted");
        return back();
    }
}

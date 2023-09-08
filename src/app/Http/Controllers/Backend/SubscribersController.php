<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscribe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubscribersController extends Controller
{
    public function index(){
        return view('backend.pages.subscriber.manage');
    }

    //data
    public function data(){
        $subscriber = EmailSubscribe::orderBy('id', 'desc')->get();

        return DataTables::of($subscriber)
        ->rawColumns(['action',])
        ->addColumn('action', function (EmailSubscribe $subscriber) {
            return '
            <button type="button" data-content="'.route('subscribers.delete.modal', $subscriber->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }


    //delete modal
    public function delete_modal($id){
        $subscriber = EmailSubscribe::find($id);
        return view('backend.pages.subscriber.modals.delete', compact('subscriber'));
    }

    //delete modal
    public function delete($id){
        $subscriber = EmailSubscribe::find($id);
        if( $subscriber ){
            try{
                if( $subscriber->delete() ){
                    return response()->json(['delete' => 'Deleted'], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }

    //delete all
    public function delete_all(Request $request){
        try{
            DB::table('email_subscribes')->truncate();
            $request->session()->flash('success','All email deleted');
            return redirect()->route('subscribers.all');
        }
        catch( Exception $e ){
            return response()->json(['error' => $e->getMessage()], 200);
        }
        
    }


}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductAnswer;
use App\Models\ProductQuestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QuestionAnswerController extends Controller
{
    public function index(){
        return view("backend.pages.qa.manage");
    }

    public function data(Request $request)
    {
        $p_question = ProductQuestion::orderBy('id', 'desc')->get();

        return DataTables::of($p_question)
        ->rawColumns(['action', 'question','answer'])
        ->editColumn('question', function (ProductQuestion $p_question) {
            $customer = $p_question->customer->name;
            $time = $p_question->created_at->toDayDateTimeString();
            return "
                <p>Customer : $customer</p>
                <p>$p_question->question</p>
                <p>$time</p>
            ";
        })
        ->editColumn('answer', function (ProductQuestion $p_question) {
            $answers = ProductAnswer::where('product_question_id',$p_question->id)->get();
            foreach( $answers as $answer ){
                return $answer->answer;
            }

            
        })
        ->addColumn('action', function (ProductQuestion $p_question) {
            return '
            <button type="button" data-content="'.route('product.qa.reply', $p_question->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Reply
            </button>
            <button type="button" data-content="'.route('product.qa.edit', $p_question->id).'" data-target="#myModal" class="btn btn-success" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //reply
    public function reply($id){
        $p_question = ProductQuestion::find($id);
        return view('backend.pages.qa.modals.reply', compact('p_question'));
    }

    //answer
    public function answer(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'answer' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            $p_question = ProductQuestion::find($id);
            if( $p_question->answer->count() > 0 ){
                return response()->json(['warning' => 'You already answered this question'], 200);
            }else{
                try{
                    $p_answer = new ProductAnswer();
                    $p_answer->product_question_id = $p_question->id;
                    $p_answer->user_id = auth('web')->user()->id;
                    $p_answer->answer = $request->answer;
                    if( $p_answer->save() ){
                        return response()->json(['success' => 'Thanks for your reply'],200);
                    }

                }   
                catch(Exception $e){
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }
        }
    }
    
    //reply
    public function edit($id){
        $p_question = ProductQuestion::find($id);
        return view('backend.pages.qa.modals.edit', compact('p_question'));
    }
    
    //update reply
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'answer' => 'required',
        ]);

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        else{
            try{
                $p_question = ProductQuestion::find($id);
                $p_answer = ProductAnswer::find($p_question->answer->first()->id);
                $p_answer->answer = $request->answer;
                if( $p_answer->save() ){
                    return response()->json(['update'=>'Updated'],200);
                }

            }   
            catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
            
        }
        
    }
    
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductQuestion as ResourcesProductQuestion;
use App\Models\ProductQuestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerController extends Controller
{
    public function add_question(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'question' => 'required',
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $question = new ProductQuestion();
                $question->customer_id = auth('customer')->user()->id;
                $question->product_id = $id;
                $question->question = $request->question;
                if( $question->save() ){
                    return response()->json(['question_added' => new ResourcesProductQuestion($question) ], 200);
                }
            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()], 200);
            }
            
        }
    }
}

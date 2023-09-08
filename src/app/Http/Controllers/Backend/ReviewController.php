<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function index()
    {
        return view('backend.pages.review.manage');
    }

    //data
    public function data(){
        $review = Review::orderBy('id', 'desc')->get();

        return DataTables::of($review)
        ->rawColumns(['action', 'review','product'])
        ->editColumn('review', function(Review $review){
            $star = "";
            if( $review->star == 1 ){
                $star = "<i class='fas fa-star'></i>";
            }
            elseif( $review->star == 2 ){
                $star = "<i class='fas fa-star'></i><i class='fas fa-star'></i>";
            }
            elseif( $review->star == 3 ){
                $star = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
            }
            elseif( $review->star == 4 ){
                $star = "<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
            }
            elseif( $review->star == 5 ){
                $star = "<i class='fas fa-star'></i><i class='fas fa-star'></i> <i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
            }

            $status = "";
            if( $review->is_approved == true ){
                $status = "<p class='badge badge-success'>Approved</p>";
            }else{
                $status = "<p class='badge badge-danger'>Unapproved</p>";
            }

            return "
                <p class='star-color'>".$star."</p>
                <p >".$review->review."</p>
                <p >Status :".$status."</p>
                <p >Time : ".$review->created_at->toDayDateTimeString()."</p>
                <p style='margin-bottom: 0'><b>Customer Details</b></p>
                <p style='margin-bottom: 0'>Name : ".$review->customer->name."</p>
                <p style='margin-bottom: 0'>Phone : ".$review->customer->phone."</p>
                <p style='margin-bottom: 0'>Email : ".$review->customer->email."</p>
            ";
        })
        ->editColumn('product', function(Review $review){
            return "
                <p>".$review->product->name."</p>
                <p>Total Review : ".$review->product->review->where('is_approved', true)->count()."</p>
            ";
        })
        ->addColumn('action', function (Review $review) {
            return '
                <p>
                    <button type="button" data-content="'.route('review.edit', $review->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                        Status
                    </button>
                </p>
                <p>
                <button type="button" data-content="'.route('review.delete.modal', $review->id).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
                </button>
            </p>
            ';
        })
        ->make(true);
    }


    //edit start
    public function edit($id){
        $review = Review::find($id);
        return view('backend.pages.review.modals.edit', compact('review'));
    }

    //update
    public function update(Request $request, $id){
        $review = Review::find($id);
        $review->is_approved = $request->is_approved;
        if( $review->save() ){
            return response()->json(['update' => 'Updated'], 200);
        }
    }

    //delete modal start
    public function delete_modal($id){
        $review = Review::find($id);
        return view('backend.pages.review.modals.delete', compact('review'));
    }

    //delete
    public function delete($id){
        $review = Review::find($id);
        if( $review->delete() ){
            return response()->json(['delete' => 'Deleted'], 200);
        }
    }

    //delete all
    public function delete_all(Request $request){
        $reviews = Review::truncate();
        $request->session()->flash('success','All Review Deleted');
        return redirect()->route('review.show');
    }

    //approve all
    public function approve_all(Request $request){
        $reviews = Review::all();
        foreach( $reviews  as $review ){
            $review->is_approved = true;
            $review->save();
        }
        $request->session()->flash('success','All Review Approved');
        return redirect()->route('review.show');
    }

    //unapprove all
    public function unapprove_all(Request $request){
        $reviews = Review::all();
        foreach( $reviews  as $review ){
            $review->is_approved = false;
            $review->save();
        }
        $request->session()->flash('success','All Review Unapproved');
        return redirect()->route('review.show');
    }
}

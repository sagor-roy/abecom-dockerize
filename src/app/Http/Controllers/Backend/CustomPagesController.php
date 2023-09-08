<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\FooterWidget;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomPagesController extends Controller
{
    //index function start
    public function index(){
        return view('backend.pages.custom_pages.manage');
    }
    //index function end


    //data function start
    public function data(Request $request)
    {
        $custom_page = CustomPage::orderBy('position', 'asc')->select("position","name","id","type","footer_widget_id","is_active")->get();

        return DataTables::of($custom_page)
        ->rawColumns(['action', 'is_active','footer_widget_id'])

        ->editColumn('footer_widget_id', function (CustomPage $custom_page) {
            return $custom_page->footer_widget->widget;
        })

        ->editColumn('is_active', function (CustomPage $custom_page) {
            if( $custom_page->is_active == true ){
                return '<span class="badge badge-success">Active</span>';
            }
            else{
                return '<span class="badge badge-danger">In active</span>';
            }
        })
        ->addColumn('action', function (CustomPage $custom_page) {
            return '
            <button type="button" data-content="'.route('custom.page.edit.modal', encrypt($custom_page->id)).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            <button type="button" data-content="'.route('custom.page.delete.modal', encrypt($custom_page->id)).'" data-target="#myModal" class="btn btn-danger" data-toggle="modal">
                    Delete
            </button>
            ';
        })
        ->make(true);
    }
    //data function end


    //add_modal function start
    public function add_modal(){
        try{
            $footer_widgets = FooterWidget::select("widget","id")->get();

            return view('backend.pages.custom_pages.modals.add', compact('footer_widgets'));
        }
        catch( Exception $e ){
            return $e->getMessage();
        }
    }
    //add modal function end


    //add function start
    public function add(Request $request){
        try{
            
            if( $request->type == "Page" ){
                $validator = Validator::make($request->all(), [
                    "position" => "required|min:1|integer",
                    "name" => "required|unique:custom_pages,name",
                    "footer_widget_id" => "required|exists:footer_widgets,id",
                    "type" => "required|in:Page,Link",
                    "content" => "required",
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    "position" => "required|min:1|integer",
                    "name" => "required|unique:custom_pages,name",
                    "footer_widget_id" => "required|exists:footer_widgets,id",
                    "type" => "required|in:Page,Link",
                    "link" => "required",
                ]);
            }

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }
            else{

                if( CustomPage::where("position",$request->position)->where("footer_widget_id",$request->footer_widget_id)->first() ){
                    return response()->json([
                        'warning' => 'Position already exists for this widget'
                    ],200);
                }

                $custom_page = new CustomPage();

                $custom_page->position = $request->position;
                $custom_page->name = $request->name;
                $custom_page->slug = Str::slug($request->name);
                $custom_page->footer_widget_id = $request->footer_widget_id;
                $custom_page->type = $request->type;

                if( $request->type == "Page" ){
                    $custom_page->content = $request->content;
                }
                else{
                    $custom_page->link = $request->link;
                }

                $custom_page->is_active = true;

                if( $custom_page->save() ){
                    return response()->json([
                        'success' => 'New page created'
                    ],200);
                }


            }
            
        }
        catch( Exception $e ){
            return response()->json(['warning' => $e->getMessage()],200);
        }
    }
    //add function end


    //edit_modal function start
    public function edit_modal($id){
        try{
            $custom_page = CustomPage::find(decrypt($id));
            $footer_widgets = FooterWidget::select("widget","id")->get();
            if( $custom_page ){
                return view('backend.pages.custom_pages.modals.edit',compact('custom_page','footer_widgets'));
            }
            else{
                return "No page found";
            }

        }
        catch( Exception $e ){
            return $e->getMessage();
        }
    }
    //edit modal function end


    //edit function start
    public function edit(Request $request, $id){
        try{
            $id = decrypt($id);
            if( $request->type == "Page" ){
                $validator = Validator::make($request->all(), [
                    "position" => "required|min:1|integer",
                    "name" => "required|unique:custom_pages,name,". $id,
                    "footer_widget_id" => "required|exists:footer_widgets,id",
                    "type" => "required|in:Page,Link",
                    "content" => "required",                    
                    "is_active" => "required",
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    "position" => "required|min:1|integer",
                    "name" => "required|unique:custom_pages,name,". $id,
                    "footer_widget_id" => "required|exists:footer_widgets,id",
                    "type" => "required|in:Page,Link",
                    "link" => "required",                    
                    "is_active" => "required",
                ]);
            }

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()],422);
            }
            else{

                if( CustomPage::where("position",$request->position)->where("footer_widget_id",$request->footer_widget_id)->where("id","!=",$id)->first() ){
                    return response()->json([
                        'warning' => 'Position already exists for this widget'
                    ],200);
                }

                $custom_page = CustomPage::find($id);

                $custom_page->position = $request->position;
                $custom_page->name = $request->name;
                $custom_page->slug = Str::slug($request->name);
                $custom_page->footer_widget_id = $request->footer_widget_id;
                $custom_page->type = $request->type;

                if( $request->type == "Page" ){
                    $custom_page->content = $request->content;
                }
                else{
                    $custom_page->link = $request->link;
                }

                $custom_page->is_active = $request->is_active;

                if( $custom_page->save() ){
                    return response()->json([
                        'success' => 'Page updated'
                    ],200);
                }


            }
            
        }
        catch( Exception $e ){
            return response()->json(['warning' => $e->getMessage()],200);
        }
    }
    //edit function end


    //delete_modal function start
    public function delete_modal($id){
        try{
            $custom_page = CustomPage::find(decrypt($id));

            if( $custom_page ){
                return view('backend.pages.custom_pages.modals.delete',compact('custom_page'));
            }
            else{
                return "No page found";
            }

        }
        catch( Exception $e ){
            return $e->getMessage();
        }
    }
    //delete_modal function end


    //delete function start
    public function delete(Request $request, $id){
        try{
            $custom_page = CustomPage::find(decrypt($id));

            if( $custom_page ){
                if( $custom_page->delete() ){
                return response()->json(['success' => 'Page Deleted'],200);
                }
            }
            else{
                return response()->json(['warning' => 'No page found'],200);
            }
        }
        catch( Exception $e ){
            return response()->json(['warning' => $e->getMessage()],200);
        }
    }
    //delete function end

}

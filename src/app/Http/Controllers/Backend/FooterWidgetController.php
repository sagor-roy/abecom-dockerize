<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FooterWidgetController extends Controller
{
    public function index(){
        return view('backend.pages.widget.manage');
    }

    //data
    public function data(Request $request)
    {
        $widget = FooterWidget::orderBy('position', 'asc')->get();

        return DataTables::of($widget)
        ->rawColumns(['action','is_active'])
        ->editColumn('is_active', function (FooterWidget $widget) {
            if( $widget->is_active == true ){
                return "<span class='badge badge-success'>Active</span>";
            }
            else{
                return "<span class='badge badge-danger'>In active</span>";    
            }
        })
        ->addColumn('action', function (FooterWidget $widget) {
            return '
            <button type="button" data-content="'.route('widget.edit', $widget->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //add
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'widget' => 'required',
            'position' => 'required|unique:footer_widgets,position,'
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()],422);
        }else{
            $widget = new FooterWidget();
            $widget->widget = $request->widget;
            $widget->position = $request->position;
            if( $widget->save() ){
                return response()->json(['create' => 'Create'], 200);
            }
        }
    }

    //edit
    public function edit($id){
        $widget = FooterWidget::find($id);
        return view('backend.pages.widget.modals.edit', compact('widget'));
    }

    //update
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'widget' => 'required|unique:footer_widgets,widget,'. $id,
            'position' => 'required|unique:footer_widgets,position,'. $id
        ]);
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()],422);
        }
        else{
            $widget = FooterWidget::find($id);
            $widget->widget = $request->widget;
            $widget->position = $request->position;
            $widget->is_active = $request->is_active;
            if( $widget->save() ){
                return response()->json(['update' => 'Updated'], 200);
            }
        }
    }

    //delete modal
    public function delete_modal($id){
        $widget = FooterWidget::find($id);
        return view('backend.pages.widget.modals.delete', compact('widget'));
    }

    //delete
    public function delete($id){
        $widget = FooterWidget::find($id);
        if( $widget->delete() ){
            return response()->json(['delete' => 'Deleted'], 200);
        }
    }
}

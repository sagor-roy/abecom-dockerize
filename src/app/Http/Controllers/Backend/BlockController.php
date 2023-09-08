<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductBlock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlockController extends Controller
{

    public function index(){    
        return view('backend.pages.block.manage');
    }

    public function data(Request $request)
    {
        $pblock = ProductBlock::orderBy('id', 'desc')->get();

        return DataTables::of($pblock)
        ->rawColumns(['action', 'status','block_info','category','brand'])
        ->editColumn("block_info", function(ProductBlock $pblock){
            
            $block_thumbnail = asset('images/pblock/'. $pblock->block_thumbnail);
            $small_image = asset('images/pblock/'. $pblock->small_image);
            $product = "";
            $status = "";

            if( $pblock->product_id ){
                $product = $pblock->product->name;
            }else{
                $product = "No thumbnail product added";
            }

            if( $pblock->is_active == true ){
                $status = "<small class='badge badge-success'>Active</small>";
            }else{
                $status = "<small class='badge badge-danger'>inactive</small>";
            }
            
            $cat_data = "";
            foreach( $pblock->category as $pblock_category ){
                $cat_data .= $pblock_category->name . ", " ;
            }
    
            $brand_data = "";
            foreach( $pblock->brand as $pblock_brand ){
                $brand_data .= $pblock_brand->name . ", " ;
            }
            
            return "
                <p><b>Name</b> : $pblock->name</p>
                <p><b>Total Category</b> : $pblock->per_category</p>
                <p><b>Total Brand</b> : $pblock->per_brand</p>
                <p><b>Total Product</b> : $pblock->per_product</p>
                <p><b>Block Color</b> : <span style='background: $pblock->color;
                padding: 2px 10px;
                margin-left: 5px;'></span></p>
                <p><b>Block Thumbnail</b>  : <img src='$block_thumbnail' alt='No Image Found' width='30px'> </p>
                <p><b>Small Thumbnail</b>  : <img src='$small_image' alt='No Image Found' width='30px'> </p>
                <p><b>Thumbnail Product</b>  : $product</p>
                <p><b>Status</b>  : $status</p>
                <p><b>Categories</b>  : $cat_data</p>
                <p><b>Brands</b>  : $brand_data</p>

            ";
        })
        
        ->addColumn('action', function (ProductBlock $pblock) {
            return '
            <button type="button" data-content="'.route('block.edit', $pblock->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //add start
    public function add(Request $request){
        if( $request->select_thumbnail == 1 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,',
                'product' => 'required',
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }
        elseif( $request->select_thumbnail == 2 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,',
                'thumbnail_image' => 'required|dimensions:min_width:360px,max_width:360px,min_height:550px,max_height:550px',
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,',
                'per_product' => 'required|numeric',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }
        elseif( $request->select_thumbnail == 3 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,',
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,',
                'per_product' => 'required|numeric',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'select_thumbnail' => 'required',
            ]);
        }
        

        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $pblock = new ProductBlock();
                $pblock->name = $request->name;
                $pblock->position = $request->position;
                $pblock->color = $request->color;
                $pblock->per_category = $request->per_category;
                $pblock->per_brand = $request->per_brand;
                $pblock->per_product = $request->per_product;
                $pblock->is_active = true;

                if( $request->select_thumbnail == 1 ){
                    $pblock->product_id = $request->product;
                    $pblock->block_thumbnail = null;
                }
                elseif( $request->select_thumbnail == 2 ){
                    $pblock->product_id = null;
                    if ($request->thumbnail_image) {
                        $image = $request->file('thumbnail_image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/pblock/'.$img);
                        Image::make($image)->save($location);
                        $pblock->block_thumbnail = $img;
                    }
                }
                elseif( $request->select_thumbnail == 3 ){
                    $pblock->block_thumbnail = null;
                    $pblock->product_id = null;
                }
                if ($request->small_image) {
                    $image = $request->file('small_image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/pblock/'.$img);
                    Image::make($image)->save($location);
                    $pblock->small_image = $img;
                }

                if( $pblock->save() ){
                    if( $request['categories'] ){
                        foreach( $request['categories'] as $category ){
                            $pblock->category()->attach($category);
                        }
                    }
    
                    if( $request['brands'] ){
                        foreach( $request['brands'] as $brand ){
                            $pblock->brand()->attach($brand);
                        }
                    }
                    
                    return response()->json(['create' => 'Created'], 200);
                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
        }
    }
    //add end


    //edit modal start
    public function edit($id){
        $pblock = ProductBlock::find($id);
        return view('backend.pages.block.modals.edit', compact('pblock'));
    }
    //edit modal end

    //update start
    public function update(Request $request, $id){
        if( $request->select_thumbnail == 1 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,'.$id,
                'product' => 'required',
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,'.$id,
                'per_product' => 'required|numeric',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }
        elseif( $request->select_thumbnail == 2 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,'.$id,
                'thumbnail_image' => 'dimensions:min_width:360px,max_width:360px,min_height:550px,max_height:550px',
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,'.$id,
                'per_product' => 'required|numeric',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }
        elseif( $request->select_thumbnail == 3 ){
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_blocks,name,'.$id,
                'small_image' => 'dimensions:min_width:800px,max_width:800px,min_height:600px,max_height:600px',
                'categories.*' => 'required',
                'brands.*' => 'required',
                'color' => 'required',
                'position' => 'required|unique:product_blocks,position,'.$id,
                'per_product' => 'required|numeric',
                'per_product' => 'required|numeric',
                'per_category' => 'required|numeric',
                'per_brand' => 'required|numeric',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'select_thumbnail' => 'required',
            ]);
        }
        
        if( $validator->fails() ){
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $pblock = ProductBlock::find($id);
                $pblock->name = $request->name;
                $pblock->position = $request->position;
                $pblock->color = $request->color;
                $pblock->per_category = $request->per_category;
                $pblock->per_brand = $request->per_brand;
                $pblock->per_product = $request->per_product;
                $pblock->is_active = $request->is_active;

                if( $request->select_thumbnail == 1 ){
                    $pblock->product_id = $request->product;
                    $pblock->block_thumbnail = null;
                }
                elseif( $request->select_thumbnail == 2 ){
                    $pblock->product_id = null;
                    if ($request->thumbnail_image) {
                        if( File::exists("images/pblock/".$pblock->thumbnail_image) ){
                            File::delete("images/pblock/".$pblock->thumbnail_image);
                        }
                        $image = $request->file('thumbnail_image');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/pblock/'.$img);
                        Image::make($image)->save($location);
                        $pblock->block_thumbnail = $img;
                    }
                }
                elseif( $request->select_thumbnail == 3 ){
                    $pblock->block_thumbnail = null;
                    $pblock->product_id = null;
                }
                if ($request->small_image) {
                    if( File::exists("images/pblock/".$pblock->small_image) ){
                        File::delete("images/pblock/".$pblock->small_image);
                    }
                    $image = $request->file('small_image');
                    $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/pblock/'.$img);
                    Image::make($image)->save($location);
                    $pblock->small_image = $img;
                }

                if( $pblock->save() ){
                    if( $request['categories'] ){
                        $pblock->category()->detach();
                        foreach( $request['categories'] as $category ){
                            $pblock->category()->attach($category);
                        }
                    }
    
                    if( $request['brands'] ){
                        $pblock->brand()->detach();
                        foreach( $request['brands'] as $brand ){
                            $pblock->brand()->attach($brand);
                        }
                    }
                    
                    return response()->json(['update' => 'Updated'], 200);
                }

            }
            catch( Exception $e ){
                return response()->json(['error' => $e->getMessage()],200);
            }
        }
    }
    //update end

}

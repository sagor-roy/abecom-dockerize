<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Product Block</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('block.update', $pblock->id) }}" class="ajax-form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Block Name</label>
            <input type="text" class="form-control" name="name" value="{{ $pblock->name }}">
        </div>

        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" name="position" value="{{ $pblock->position }}">
        </div>

        <div class="form-group">
            <label>How many category show?</label>
            <input type="number" class="form-control" name="per_category" value="{{ $pblock->per_category }}">
        </div>

        <div class="form-group">
            <label>How many brand show?</label>
            <input type="number" class="form-control" name="per_brand" value="{{ $pblock->per_brand }}">
        </div>

        <div class="form-group">
            <label>How many product show?</label>
            <input type="number" class="form-control" name="per_product" value="{{ $pblock->per_product }}">
        </div>

        <div class="form-group">
            <label>Block status</label>
            <select name="is_active" class="form-control">
                <option value="1" @if( $pblock->is_active == true ) selected @endif >Active</option>
                <option value="0" @if( $pblock->is_active == false ) selected @endif >inactive</option>
            </select>
        </div>


        <div class="row">
            <div class="col-md-6">
                <input type="radio" class="form-control-check" name="select_thumbnail"
                    placeholder="Select Thumbnail Product" value="1" @if( $pblock->product_id ) checked @endif >
                <label for="select_thumbnail">Block Thumbnail Product</label>
                <div class="form-group" id="thumbnail_product">
                    <select name="product" class="form-control " id="chosen3">
                        @foreach (\App\Models\Product::orderBy('id', 'desc')->where('is_active', true)->get() as
                        $product)
                        <option value="{{ $product->id }}" @if( $product->id == $pblock->product_id ) selected @endif >
                            {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <input type="radio" class="form-control-check" name="select_thumbnail"
                    placeholder="Select Thumbnail Image" value="2" @if( $pblock->block_thumbnail ) checked @endif>
                <label for="select_thumbnail">Block Thumbnail Image( Max 50 Kb, Width: 360px, Height
                    : 550px )</label>
                <div class="form-group">
                    @if( $pblock->block_thumbnail )
                    <img src="{{ asset('images/pblock/'.$pblock->block_thumbnail) }}" id="image_preview_container"
                        class="default-thhumbnail" width="100px" alt="">
                    @else
                    <p class="badge badge-danger">No image added</p>
                    @endif
                    <br><br>
                    <input type="file" class="form-control-file" name="thumbnail_image" id="image">
                </div>
            </div>

            <div class="col-md-12">
                <input type="radio" class="form-control-check" name="select_thumbnail" placeholder="Only show products"
                    value="3" @if( !$pblock->block_thumbnail && !$pblock->product_id ) checked @endif >
                <label for="select_thumbnail">Only Show Products</label>
            </div>
        </div>


        <div class="form-group">
            <label>Block Small Image( Max 50 Kb, Width: 800px, Height :
                600px
                )</label>
            @if( $pblock->small_image )
            <img src="{{ asset('images/pblock/'.$pblock->small_image) }}" id="image_preview_container2"
                class="default-thhumbnail" width="100px" alt="">
            @else
            <p class="badge badge-danger">No image added</p>
            @endif
            <br><br>
            <input type="file" class="form-control-file" name="small_image" id="image2">
        </div>

        <div class="form-group" id="thumbnail_product">
            <label>Choose Category</label>
            <select name="categories[]" class="form-control chosen" id="chosen1" multiple>
                @foreach (\App\Models\Category::orderBy('id', 'desc')->where('is_active', true)->get() as $category)
                <option value="{{ $category->id }}"
                    @foreach( $pblock->category as $pblock_cat )
                        @if( $pblock_cat->id == $category->id )
                            selected
                        @endif
                    @endforeach
                >
                    {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="thumbnail_product">
            <label>Choose brands</label>
            <select name="brands[]" class="form-control" id="chosen2" multiple>
                @foreach (\App\Models\Brand::orderBy('id', 'desc')->where('is_active', true)->get() as $brand)
                <option value="{{ $brand->id }}"
                    @foreach( $pblock->brand as $pblock_brand )
                        @if( $pblock_brand->id == $brand->id )
                            selected
                        @endif
                    @endforeach    
                >
                    {{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Choose block color</label>
            <input type="text" id="demo" class="demo form-control" name="color" value="{{ $pblock->color }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>
<link rel="stylesheet" href="{{ asset('backend/dist/css/jquery.minicolors.css') }}">
<script src="{{ asset('backend/dist/js/jquery.minicolors.js') }}"></script>

<script type="text/javascript">
    $("#chosen1").chosen()
    $("#chosen2").chosen()
    $("#chosen3").chosen()
    $('.demo').minicolors();

</script>
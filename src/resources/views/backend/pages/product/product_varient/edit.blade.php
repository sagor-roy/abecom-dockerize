<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Attribute Value</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('update.product.varient', $product_varient_value->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Attribute name* (required)</label>
                  <select name="varient" class="form-control">
                        @foreach( App\Models\Varient::orderBy('id','desc')->get() as $varient)
                        <option value="{{ $varient->id }}" @if( $varient->id == $product_varient_value->varient_id ) selected @endif >{{ $varient->name }}</option>
                        @endforeach
                  </select>  
            </div>
            <div class="form-group">
                  <label>Value* (required)</label>
                  <select name="cat_varient_id" class="form-control">
                        @foreach( App\Models\Category::where('is_active', true)->where('id', $product_varient_value->product->category_id)->get() as $category )
                        @if( $category->category_varient->count() > 0 )
                        <option disabled>----{{ $category->name }}</option>
                              @foreach( $category->category_varient as $cat_varient)
                              <option value="{{ $cat_varient->id }}"  >{{ $cat_varient->value }}</option>
                              @endforeach
                        @endif
                        @endforeach
                  </select> 
                  
            </div>
            <div class="form-group">
                  <input type="hidden" value="{{ $product_varient_value->product->category_id }}" name="category_id">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/custom.js') }}"></script>

<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Category Attribute</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('cat.attr.update', $category_attribute->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <select name="varients" class="form-control">
                        @foreach (App\Models\Varient::orderBy('id', 'desc')->get() as $varient)
                            <option value="{{ $varient->id }}" @if( $category_attribute->varient_id == $varient->id ) selected @endif >
                                {{ $varient->name }}</option>
                        @endforeach
                  </select>
            </div>
            <div class="form-group">
                  <label>Value</label>
                  <input type="text" class="form-control" name="value" value="{{ $category_attribute->value }}">
            </div>
          <div class="form-group">
              <label>Select Varient Status</label>
              <select class="form-control" name="is_active" >
                    <option value="1" @if( $category_attribute->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $category_attribute->is_active == false ) selected @endif >Inactive</option>
              </select>
          </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

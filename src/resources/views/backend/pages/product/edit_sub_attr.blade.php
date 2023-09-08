<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit attribute set value</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('sub.attr.edit', $sub_attr->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Attribute</label>
                  <select name="attribute_id" class="form-control chosen" id="">
                        @foreach ( \App\Models\Attribute::orderBy('id','desc')->get() as $attribute)
                        <option value="{{ $attribute->id }}"
                              @foreach( \App\Models\SubAttributeSet::where('attribute_set_id',$sub_attr->attribute_set_id)->get() as $single_sub_attr )
                                    @if( $single_sub_attr->attribute_id ==  $attribute->id )
                                          @if( $sub_attr->attribute_id == $attribute->id )
                                                selected
                                          @else
                                                disabled
                                          @endif
                                    @endif
                              @endforeach
                              
                        >{{ $attribute->name }}</option>
                        @endforeach
                  </select>
                 
            </div>
            <div class="form-group">
                  <label>Value</label>
                  <input type="text" placeholder="red / xl / m" class="form-control" name="value" value="{{ $sub_attr->value }}" >
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $sub_attr->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $sub_attr->is_active == false ) selected @endif >Inactive</option>
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



 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>

 <script src="{{ asset('backend/dist/js/custom.js') }}"></script>

 <script>
       $(".chosen").chosen()
 </script>

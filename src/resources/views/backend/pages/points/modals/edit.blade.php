<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Purchase Point</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('purchase.point.update', $point->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Min Price</label>
                  <input type="number" class="form-control" name="min_price" value="{{ $point->min_price }}">
            </div>
            <div class="form-group">
                  <label>Max Price</label>
                  <input type="number" class="form-control" name="max_price" value="{{ $point->max_price }}">
            </div>
            <div class="form-group">
                  <label>Points</label>
                  <input type="number" class="form-control" name="points" value="{{ $point->points }}">
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $point->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $point->is_active == false ) selected @endif >Inactive</option>
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
 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

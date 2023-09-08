<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Charge</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('delivery.charge.update',$delivery_charge->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Size</label>
                  <input type="text" class="form-control" name="size" value="{{ $delivery_charge->size }}">
            </div>
            <div class="form-group">
                  <label>Amount</label>
                  <input type="number" class="form-control" name="amount" value="{{ $delivery_charge->amount }}">
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $delivery_charge->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $delivery_charge->is_active == false ) selected @endif >Inactive</option>
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

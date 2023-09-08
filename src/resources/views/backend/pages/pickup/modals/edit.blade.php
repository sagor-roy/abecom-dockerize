<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit pickup point</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('pickup.point.edit', $pickup->id) }}" class="ajax-form" method="post" >
            @csrf
            <div class="form-group">
                  <label>Pickup point name</label>
                  <input type="text" class="form-control" name="name" value="{{ $pickup->name }}">
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $pickup->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $pickup->is_active == false ) selected @endif >Inactive</option>
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

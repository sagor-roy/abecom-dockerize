<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Review Status</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('review.update', $review->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_approved" class="form-control">
                        <option value="0" @if( $review->is_approved == false ) selected @endif >Unapproved</option>
                        <option value="1" @if( $review->is_approved == true ) selected @endif >Approved</option>
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

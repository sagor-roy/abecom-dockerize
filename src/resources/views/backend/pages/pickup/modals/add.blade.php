<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add pickup point</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('pickup.point.add') }}" class="ajax-form" method="post" >
            @csrf
            <div class="form-group">
                  <label>Pickup point name</label>
                  <input type="text" class="form-control" name="name" >
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

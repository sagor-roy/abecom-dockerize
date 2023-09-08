<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('user.reset', $user->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" >
            </div>
            <div class="form-group">
                  <label>Confirmed Password</label>
                  <input type="password" class="form-control" name="password_confirmation" >
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Reset</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

 <script>
      $("#chosen2").chosen()
</script>
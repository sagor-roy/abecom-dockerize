<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('user.update', $user->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                  <label>Assign user role</label>
                  <select name="roles[]" class="form-control" id="chosen2" multiple >
                        @foreach( \App\Models\Role::orderBy('id','desc')->get() as $role  )
                        <option value="{{ $role->id }}"
                              @foreach( $user->role as $user_role )
                                    @if( $user_role->id == $role->id )
                                          selected
                                    @endif
                              @endforeach                              
                        >{{ $role->role }}</option>
                        @endforeach
                  </select>
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $user->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $user->is_active == false ) selected @endif >Inactive</option>
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

 <script>
      $("#chosen2").chosen()
</script>
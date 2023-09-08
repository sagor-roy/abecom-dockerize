<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('role.update', $role->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Role</label>
                  <input type="text" class="form-control" name="role" value="{{ $role->role }}">
            </div>
            <div class="form-group">
                  <label>Give access to the role</label>
                  <select name="menus[]" class="form-control " id="chosen2" multiple >
                        @foreach( \App\Models\Menu::orderBy('position','asc')->get() as $menu  )
                        <option value="{{ $menu->id }}"
                        @foreach( $role->menu as $role_menu )
                              @if( $menu->id == $role_menu->id )
                              selected
                              @endif
                        @endforeach                              
                        >{{ $menu->name }}</option>
                        @endforeach
                  </select>
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $role->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $role->is_active == false ) selected @endif >Inactive</option>
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
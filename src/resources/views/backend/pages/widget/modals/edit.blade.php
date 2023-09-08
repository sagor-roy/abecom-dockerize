<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $widget->widget }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('widget.update', $widget->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Widget</label>
                  <input type="text" class="form-control" name="widget" value="{{ $widget->widget }}">
            </div>
            <div class="form-group">
                  <label>Position</label>
                  <input type="number" class="form-control" name="position" min="1" value="{{ $widget->position }}">
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $widget->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $widget->is_active == false ) selected @endif >In active</option>
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
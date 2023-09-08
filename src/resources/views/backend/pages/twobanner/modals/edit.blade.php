<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Two Banner Image</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('two.banner.update', $two_banner->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Two Banner Image (  Width: 1920px, Height : 444px
                      ) </label> <br>
                  <img src="{{ asset('images/twobanner/'. $two_banner->image) }}"
                      id="image_preview_container" class="default-thhumbnail"
                      width="100px" alt="">
                  <br><br>
                  <input type="file" class="form-control-file" name="image"
                      id="image">
              </div>
            <div class="form-group">
                  <label>Position</label>
                  <input type="position" min="1" class="form-control" name="position" value="{{ $two_banner->position }}">
            </div>
            <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $two_banner->name }}">
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

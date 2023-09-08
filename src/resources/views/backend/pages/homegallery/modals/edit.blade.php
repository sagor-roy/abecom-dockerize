<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('home.gallery.update', $homegallery->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Home Banner Image
                        @if( $homegallery->position == 1 )
                        ( Image Dimension 705x300 )
                        @elseif( $homegallery->position == 2 )
                        ( Image Dimension 335x300 )
                        @elseif( $homegallery->position == 3 )
                        ( Image Dimension 335x300 )
                        @elseif( $homegallery->position == 4 )
                        ( Image Dimension 705x300 )
                        @elseif( $homegallery->position == 5 )
                        ( Image Dimension 493x600 )
                        @endif

                  </label> <br>
                  <img src="{{ asset('images/homegallery/'. $homegallery->image) }}" id="image_preview_container" class="default-thhumbnail" width="100px" alt=""> 
                  <br><br>
                  <input type="file" class="form-control-file" name="image" id="image"> 
            </div>
            <div class="form-group">
                  <label>Position</label>
                  <input type="number" readonly min="1" class="form-control" name="position" value="{{ $homegallery->position }}">
            </div>
            <div class="form-group">
                  <label>URL</label>
                  <input type="text"  class="form-control" name="url" value="{{ $homegallery->url }}">
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

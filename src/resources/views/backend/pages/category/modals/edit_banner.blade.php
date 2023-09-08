<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Category Banner</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('cat.banner.update', $category_banner->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label>Category Banner ( Width: 1150px, Height :
                400px
                ) </label> <br>
                <img src="{{ asset('images/category/'.$category_banner->image) }}" width="100px"
                alt="">
                <br><br>
                <input type="file" class="form-control-file image"
                name="image" >
            </div>
            <div class="form-group">
                  <label>Position</label>
                  <input type="number" class="form-control" name="position" value="{{ $category_banner->position }}">
            </div>
            <div class="form-group">
                  <label>Button</label>
                  <input type="text" class="form-control" name="button" value="{{ $category_banner->button }}">
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

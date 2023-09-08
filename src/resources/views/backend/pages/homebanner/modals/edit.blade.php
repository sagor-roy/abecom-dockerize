<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit home banner</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('home.banner.update', $homebanner->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <div class="form-group">
                        <label>Home Banner Image ( Width: 832, Height:410 )</label> <br>
                        <img src="{{ asset('images/homebanner/'. $homebanner->image) }}" id="image_preview_container" class="default-thhumbnail" width="100px" alt=""> 
                        <br><br>
                        <input type="file" class="form-control-file" name="image" id="image"> 
                  </div>
            </div>
            <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $homebanner->name }}">
            </div>
            <div class="form-group">
                  <label>Position</label>
                  <input type="number" value="{{ $homebanner->position }}" class="form-control" min="0" name="position">
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>


 <script>
      $('#image').change(function(){
          
          let reader = new FileReader();
          reader.onload = (e) => { 
          $('.default-thhumbnail').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });
</script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

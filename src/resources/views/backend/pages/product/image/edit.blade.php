
<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Product Image</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
</div>
<div class="modal-body">
      <form action="{{ route('edit.product.image', $product_image->id) }}" class="ajax-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                  <label>Product Image</label> <br>
                  <img src="{{ asset('images/product/'. $product_image->image) }}" id="image_preview_container"
                  width="100px" alt=""> 
                  <br><br>
                  <input type="file" class="form-control-file" name="image" id="image"> 
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-success">Update</button>
            </div>
      </form>
</div>
<div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


<script src="{{ asset('backend/dist/js/custom.js') }}"></script>

<script>
      $('#image').change(function(){
          
          let reader = new FileReader();
          reader.onload = (e) => { 
          $('#image_preview_container').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });
</script>
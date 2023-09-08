<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add New Banner</h5>
    <button type="button" class="close" data-dismiss="modal"
        aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('banner.add') }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Banner Image Width: 1150px, Height : 400px</label> <br>
            <br>

            <img src="{{ asset('backend/images/thumbnail.png') }}"
                id="image_preview_container" class="default-thhumbnail"
                width="100px" alt="">
            <br><br>
            <input type="file" class="form-control-file" name="image"
                id="image">
        </div>
        <div class="form-group">
            <label>Select Banner</label>
            <select name="type" class="form-control" id="banner_type">
                <option value="Shop">Shop Page Banner</option>
                <option value="Offer">Offer Page Banner</option>
            </select>
        </div>
        <div class="form-group row" id="for-offer">
                <div class="col-md-12">
                    <label>Link</label>
                    <input type="text" class="form-control" name="link">
                </div>
                <div class="col-md-12">
                    <label>Button Text</label>
                    <input type="text" class="form-control" name="button">
                </div>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" min="0"
                name="position">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-dark"
        data-dismiss="modal">Close</button>
</div>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

<script>
    
    $("#for-offer").hide()
    $("#banner_type").on("change", function(){
        const $this = $(this)
        const value = $this.val()
        if( value == 'Offer' ){
            $("#for-offer").show()
        }
        else{
            $("#for-offer").hide()
        }
    })
    
    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add New Certificate</h5>
    <button type="button" class="close" data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('about.certificate.add') }}" class="ajax-form"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Certificate Image ( Width: 597, Height:843 )</label> <br>
            <img src="{{ asset('backend/images/thumbnail.png') }}"
                 id="image_preview_container" class="default-thhumbnail"
                 width="100px" alt="">
            <br><br>
            <input type="file" class="form-control-file" name="image"
                   id="image">
        </div>
        <div class="form-group">
            <label>Link</label>
            <input type="text" class="form-control" name="link">
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
    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
</script>

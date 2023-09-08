<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Certificate</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('about.certificate.update', $certificate->id) }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        @csrf
        <div class="form-group">
            <label>Certificate Image ( Width: 597, Height:843 )</label> <br>
            <img src="{{ asset('images/certificate/'.$certificate->image) }}"
                id="image_preview_container" class="default-thhumbnail"
                width="100px" alt="">
            <br><br>
            <input type="file" class="form-control-file" name="image"
                id="image">
        </div>
        <div class="form-group">
            <label>Link</label>
            <input type="text" class="form-control" name="link" value="{{ $certificate->link }}">
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
<script>
</script>
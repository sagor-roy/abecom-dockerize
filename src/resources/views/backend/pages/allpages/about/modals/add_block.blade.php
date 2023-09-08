<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add New Block</h5>
    <button type="button" class="close" data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('about.block.add') }}" class="ajax-form"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="checkbox" class="form-control-check"
                   name="true_false" id="icon_text">
            <label>Want to add text?</label>
        </div>
        <div class="form-group" id="icon">
            <label>Font Awesome Icon</label>
            <input type="text" class="form-control" name="icon">
        </div>
        <div class="form-group" id="text">
            <label>Text</label>
            <input type="text" class="form-control" name="text">
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"
                      class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" name="position">
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
    $("#text").hide()
    $("#icon_text").click(function (e) {
        if (e.target.checked == true) {
            $("#text").show()
            $("#icon").hide()
        } else {
            $("#text").hide()
            $("#icon").show()
        }
    })
</script>

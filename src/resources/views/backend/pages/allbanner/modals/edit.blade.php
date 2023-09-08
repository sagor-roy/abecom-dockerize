<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit About</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('banner.update', $allbanner->id) }}" class="ajax-form" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Banner Image Width: 1150px, Height : 400px</label> <br>
            <br>
            <img src="{{ asset('images/allbanner/'. $allbanner->image) }}" class="default-thhumbnail" width="100px"
                alt="">
            <br><br>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <div class="form-group">
            <label>Select Banner</label>
            <select name="type" class="form-control banner_type">
                <option value="Shop" @if( $allbanner->type == 'Shop' ) selected @endif >Shop Page Banner</option>
                <option value="Offer" @if( $allbanner->type == 'Offer' ) selected @endif >Offer Page Banner</option>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $allbanner->name }}">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" min="0" name="position" value="{{ $allbanner->position }}">
        </div>
        <div  @if( $allbanner->type == 'Shop' ) class="form-group row for-offer d-none" @else class="form-group row for-offer" @endif>
            <div class="col-md-12">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ $allbanner->link }}">
            </div>
            <div class="col-md-12">
                <label>Button Text</label>
                <input type="text" class="form-control" name="button" value="{{ $allbanner->button }}" >
            </div>
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
    $(".banner_type").on("change", function(){
        const $this = $(this)
        const value = $this.val()
        if( value == 'Offer' ){
            $(".for-offer").show()
            $(".for-offer").removeClass("d-none")
        }
        else{
            $(".for-offer").hide()
            $(".for-offer").addClass("d-none")
        }
    })
</script>
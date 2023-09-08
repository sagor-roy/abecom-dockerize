<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit About Block</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('about.block.update', $about_block->id) }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="checkbox" class="form-control-check icon_text" name="true_false"
                @if( $about_block->icon == null )
                    checked
                @endif

                @if( $about_block->icon == null )
                    value="1"
                @else
                    value="0"
                @endif
            >
            <label>Want to add text?</label>
        </div>
        <div class="form-group icon" >
            <label>Font Awesome Icon</label>
            <input type="text" class="form-control" name="icon" value="{{ $about_block->icon }}">
        </div>
        <div class="form-group text" >
            <label>Text</label>
            <input type="text" class="form-control" name="text" value="{{ $about_block->text }}">
        </div>
        <div class="form-group" >
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{ $about_block->title }}">
        </div>
        <div class="form-group" >
            <label>Description</label>
            <textarea name="description" rows="3" class="form-control">
                {{ $about_block->description }}
            </textarea>
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" name="position" value="{{ $about_block->position }}">
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
    $(document).ready(function(){
        const id = $(".icon_text").val()
        if( id == 0 ){
            $(".text").hide()
        }else{
            $(".icon").hide()
        }
    })

    $(".icon_text").click(function (e) {
        if (e.target.checked == true) {
            $(".text").show()
            $(".icon").hide()
            $(".icon_text").val(1)
        } else {
            $(".text").hide()
            $(".icon").show()
            $(".icon_text").val(0)
        }
    })
    
</script>


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Banner Image</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('small.banner.update', $banner->id) }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Home Banner Image ( Width: 310, Height:132 )</label> <br>
            <img src="{{ asset('images/smallbanner/'. $banner->image) }}"
                width="100px" alt="">
            <br><br>
            <input type="file" class="form-control-file" name="image"
                id="image">
        </div>
        @if( $banner->parent_id != 0 )
        <div class="form-group">
            <label>Select Banner</label>
            <select name="banner_id" class="form-control">
                @foreach( App\Models\SmallBanner::where('parent_id',0)->get() as $small_banner )
                <option value="{{ $small_banner->id }}" @if( $small_banner->id == $banner->parent_id ) selected @endif >{{ $small_banner->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $banner->name }}">
        </div>
        <div class="form-group">
            <label>Link</label>
            <input type="text" class="form-control" name="link" value="{{ $banner->link }}">
        </div>

        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" min="0"
                name="position" value="{{ $banner->position }}" @if( $banner->parent_id == 0 ) readonly @endif >
        </div
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>


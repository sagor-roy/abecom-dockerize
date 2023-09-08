<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit About</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('about.update', $about->id) }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">ISO Image ( Width : 269, Height : 248 )</label> <br>
            <img src="{{ asset('images/'. $about->image) }}" width="100px" style="background: #000000" alt="">
            <input type="file" class="form-control-file" name="image">
        </div>
        <div class="form-group">
            <label>Title One</label>
            <input type="text" class="form-control" name="title_one"  value="{{ $about->title_one }}">
        </div>
        <div class="form-group">
            <label>Description One</label>
            <textarea class="form-control" name="description_one" >
                {{ $about->description_one }}
            </textarea>
        </div>

        <div class="form-group">
            <label>Title Two</label>
            <input type="text" class="form-control" name="title_two" value="{{ $about->title_two }}">
        </div>
        <div class="form-group">
            <label>Description Two</label>
            <textarea class="form-control" name="description_two">
                {{ $about->description_two }}
            </textarea>
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
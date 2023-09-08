<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Stores</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('stores.update', $stores->id) }}" class="ajax-form" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Showroom Title</label>
            <input type="text" class="form-control" name="title" value="{{ $stores->name }}">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="number" class="form-control" name="position" value="{{ $stores->position }}">
        </div>
        <div class="form-group">
            <button class="btn btn-primary set_add_button" type="button">+</button>
            @foreach( $stores->child as $child )
            <div class="list_wrapper">
                <div class="row set-row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="showroom_name[]" value="{{ $child->name }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Hotline</label>
                            <input type="text" class="form-control" name="hotline[]" value="{{ $child->hotline }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone[]" value="{{ $child->phone }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address[]" value="{{ $child->address }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Map Link</label>
                            <input type="text" class="form-control" name="map[]" value="{{ $child->map }}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0);" class="set_remove_button btn btn-danger">-</a>
                    </div>
                    

                </div>
            </div>
            @endforeach
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
    $(document).ready(function () {
        var x = 0; //Initial field counter
        var list_maxField = 10; //Input fields increment limitation

        //Once add button is clicked
        $('.set_add_button').click(function () {
            //Check maximum number of input fields
            if (x < list_maxField) {
                x++; //Increment field counter
                var list_fieldHTML = `<div class="row set-row">
                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="showroom_name[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Hotline</label>
                                                                        <input type="text" class="form-control"
                                                                            name="hotline[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <input type="text" class="form-control"
                                                                            name="phone[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input type="text" class="form-control"
                                                                            name="address[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Map Link</label>
                                                                        <input type="text" class="form-control"
                                                                            name="map[]">
                                                                    </div>
                                                                </div>
                                          <div class="col-md-1">
                                                <a href="javascript:void(0);" class="set_remove_button btn btn-danger">-</a>
                                          </div>
                                    </div>`; //New input field html 
                $('.list_wrapper').last().append(list_fieldHTML); //Add field html
            }
        });


        //Once remove button is clicked
        $('.list_wrapper').on('click', '.set_remove_button', function () {
            $(this).closest('div.row.set-row').remove(); //Remove field html
            x--; //Decrement field counter
        });
    })

</script>

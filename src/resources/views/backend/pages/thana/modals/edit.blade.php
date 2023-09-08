<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Thana</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('thana.update', $thana->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf

            <div class="form-group">
                <label for="">City</label>
                <select required class="form-control" name="city" id="">
                  <option value="">Select City</option>

                  @foreach ($cities as $city)
                      <option {{ $city->id == $thana->city_id ? "selected" : "" }}  value="{{ $city->id }}">{{ $city->city }}</option>
                  @endforeach

                </select>
              </div>


            <div class="form-group">
                  <label>Thana</label>
                  <input type="text" class="form-control" name="thana" value="{{ $thana->thana }}">
            </div>


            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $thana->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $thana->is_active == false ) selected @endif >Inactive</option>
                  </select>
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
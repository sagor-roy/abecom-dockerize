<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add Category Attribute</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('cat.attr.add', $id) }}" method="post" class="ajax-form">
          @csrf
          <div class="form-group">
                <div class="varient_wrapper">
                    <div class="row varient-row">
                        <div class="col-xs-5 col-sm-5 col-md-5">
                            <div class="form-group">
                                <label>Attribute name* (required)</label>
                                <select name="varients[]" class="form-control">
                                    @foreach (App\Models\Varient::orderBy('id', 'desc')->get() as $varient)
                                        <option value="{{ $varient->id }}">
                                            {{ $varient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Value* (required)</label>
                                <input autocomplete="off" name="varient_value[]"
                                    type="text" placeholder="Ex. 1 Ton"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1">
                            <br>
                            <button class="btn btn-primary add_varient"
                                type="button">+</button>
                        </div>
                    </div>
                </div>
          </div>
          <div class="form-group">
                <button type="submit" class="btn btn-outline-dark">Add</button>
          </div>
    </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>
 
 <script>
    $(document).on("click",".add_varient",function(){
            let varient = `<div class="row varient-row">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                        <div class="form-group">
                                              <label>Attribute name*</label>
                                              <select name="varients[]" class="form-control" >
                                                    @foreach (App\Models\Varient::orderBy('id', 'desc')->get() as $varient)
                                                    <option value="{{ $varient->id }}">{{ $varient->name }}</option>
                                                    @endforeach
                                              </select>
                                        </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                              <label>Value*</label>
                                              <input autocomplete="off" name="varient_value[]" type="text" placeholder="Ex. 1 Ton" class="form-control "/>
                                        </div>
                                  </div>
                                  <div class="col-xs-1 col-sm-1 col-md-1">
                                  <br>
                                  <a href="javascript:void(0);" class="remove_varient_button btn btn-danger">-</a>
                                  </div>
                            </div>`;
            $(".varient_wrapper").append(varient)
        })

        //Once remove button is clicked
        
        $('.varient_wrapper').on('click', '.remove_varient_button', function() {
            $(this).closest('div.row.varient-row').remove();
        });
 </script>

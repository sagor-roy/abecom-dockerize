<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('coupon.update', $coupon->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Code</label>
                  <input type="text" class="form-control" name="code" value="{{ $coupon->code }}">
            </div>
            <div class="form-group">
                  <label>Coupon Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $coupon->name }}">
            </div>
            <div class="form-group row">
                  <div class="form-group col-md-6" >
                        <label>Cash Discount</label>
                        <input type="number" min="0" class="form-control" name="cash_discount" id="cash_dis" oninput="cashDis()" value="{{ $coupon->cash_discount }}">
                  </div>
                  <div class="form-group col-md-6" >
                        <label>Percentage</label>
                        <input type="number" min="0" max="100" class="form-control" name="percent" id="percent" oninput="percentDis()" value="{{ $coupon->percentage }}">
                  </div>
            </div>
            
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $coupon->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $coupon->is_active == false ) selected @endif >Inactive</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>End Date</label>
                  <input type="date" class="form-control" name="end_date" value="{{ $coupon->end_date }}">
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script type="text/javascript">
      function percentDis(){
            $("#cash_dis").val(0)
      }
      function cashDis(){
            $("#percent").val(0)
      }
      
</script>
 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>


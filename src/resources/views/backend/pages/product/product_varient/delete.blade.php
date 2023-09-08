<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this item?</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

 <div class="modal-footer">
       <form action="{{ route('delete.product.varient',$product_varient_value->id) }}" class="ajax-form" method="post">
             @csrf
            <button type="submit" class="btn btn-primary">Yes</button>
       </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
 </div>

 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/custom.js') }}"></script>

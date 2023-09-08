<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Are you sure want to inactive this brand?</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-footer">
      <form action="{{ route('brand.inactive', $brand->id) }}" method="post" class="ajax-form">
            @csrf
            <button type="submit" class="btn btn-success">Yes</button>
      </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
 </div>


 <script src="{{ asset('backend/dist/js/custom.js') }}"></script>

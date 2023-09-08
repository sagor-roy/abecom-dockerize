<div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete '{{ $custom_page->name }}' page</h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
     </button>
</div>
<div class="modal-footer">
     <form action="{{ route('custom.page.delete', encrypt($custom_page->id)) }}" class="ajax-form" method="post">
          @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
     </form>
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this banner?</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-footer">
    <form action="{{ route('cat.banner.delete', $category_banner->id) }}" method="post" class="ajax-form">
        @csrf
        <button type="submit" class="btn btn-primary">Yes</button>
    </form>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
</div>


<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>




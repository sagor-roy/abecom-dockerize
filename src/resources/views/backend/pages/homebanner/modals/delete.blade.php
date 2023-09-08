<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this image?</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-footer">
       <form action="{{ route('home.banner.delete', $homebanner->id) }}" method="post" class="ajax-form">
             @csrf
             <button class="btn btn-outline-dark" type="submit">Yes</button>
       </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

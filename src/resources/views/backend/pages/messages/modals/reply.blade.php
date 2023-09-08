<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Reply this message</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
     <form action="{{ route('message.reply', $message->id) }}" class="ajax-form" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
               <label>{{ $message->message }}</label>
          </div>
          <div class="form-group">
               <label>Your Reply</label>
               <textarea name="reply" @if( $message->is_replied == true ) readonly @endif rows="3" class="form-control">
                    {{ $message->reply }}
               </textarea>
          </div>
          @if( $message->is_replied == false )
          <div class="form-group">
               <button type="submit" class="btn btn-primary">Send</button>
          </div>
          @endif
     </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

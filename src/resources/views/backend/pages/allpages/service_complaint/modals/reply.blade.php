<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Enter your reply</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('service.complaint.reply', $service_complaint->id) }}" class="ajax-form"
        method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Enquery: {{ $service_complaint->complain }}</label>
        </div> 
        @if( $service_complaint->is_replied == true )
        <div class="form-group">
            <p>Reply: {{ $service_complaint->reply }}</p>
            <small>Send at : {{ $service_complaint->updated_at->toDayDateTimeString() }}</small>
            <br>
            <small>Reply by {{ $service_complaint->user->name }}</small>
        </div>        
        @endif

        @if( $service_complaint->is_replied == false )
        <div class="form-group">
            <label>Enter your reply</label>
            <textarea name="reply" @if( $service_complaint->is_replied == true ) readonly @endif rows="5" class="form-control">
            {{ $service_complaint->reply }}
            </textarea>
        </div>
        
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
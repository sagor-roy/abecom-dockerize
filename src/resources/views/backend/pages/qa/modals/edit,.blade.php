<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit your reply</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('product.qa.update', $p_question->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
          @csrf
          <div class="form-group">
                <label>Question : {{ $p_question->question }}</label> <br>
                <label>Edit your Answer</label>
                <textarea name="answer" rows="5" class="form-control">{{ $p_question->answer->first()->answer }}</textarea>
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



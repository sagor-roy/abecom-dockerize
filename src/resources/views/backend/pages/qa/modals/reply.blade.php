<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Write your answer</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="{{ route('product.qa.answer', $p_question->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
          @csrf
          <div class="form-group">
                <label>Question : {{ $p_question->question }}</label> <br>
                <label>Write your Answer</label>
                <textarea name="answer" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>



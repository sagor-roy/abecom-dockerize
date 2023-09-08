<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Send birthday message to {{ $customer->name }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('add.wish', $customer->id) }}" class="ajax-form" method="post" >
            @csrf
            <div class="form-group">
                  <label>Birthday message</label>
                  <textarea name="message"  rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Send</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

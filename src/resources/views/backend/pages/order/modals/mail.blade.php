<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Send Mail</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('order.mail', $order->id) }}" method="post" class="ajax-form">
            @csrf
            <div class="form-group">
                  <label>Choose Delivery Status</label>
                  <select name="order_status" class="form-control">
                        <option value="OnProcess" @if( $order->order_status == 'OnProcess' ) selected @endif >OnProcess</option>
                        <option value="Shipped" @if( $order->order_status == 'Shipped' ) selected @endif >Shipped</option>
                        <option value="Delivered" @if( $order->order_status == 'Delivered' ) selected @endif >Delivered</option>
                        <option value="Cancelled" @if( $order->order_status == 'Cancelled' ) selected @endif >Cancelled</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Message ( required )</label>
                  <textarea class="form-control" id="div_editor1" name="message">
                  </textarea>
            </div>
            <div class="form-group">
                  <label>Estimate Date ( required for onprocess status )</label>
                  <input type="date" class="form-control" name="estimate_date">
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-outline-dark">Send</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>
<script>
      var editor1 = new RichTextEditor("#div_editor1");
</script>



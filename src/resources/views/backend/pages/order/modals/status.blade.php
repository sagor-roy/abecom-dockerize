<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Order Status</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('status.update', $order->id) }}" method="post" class="ajax-form">
            @csrf
            <div class="form-group">
                  <label>Payment Status</label>
                  <select name="payment_status" class="form-control">
                        <option value="Pending" @if( $order->payment_status == 'Pending' ) selected @endif >Pending</option>
                        <option value="Success" @if( $order->payment_status == 'Success' ) selected @endif >Success</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Order Delivery Status</label>
                  <select name="order_status" class="form-control">
                        <option value="Pending" @if( $order->order_status == 'Pending' ) selected @endif >Pending</option>
                        <option value="OnProcess" @if( $order->order_status == 'OnProcess' ) selected @endif >OnProcess</option>
                        <option value="Shipped" @if( $order->order_status == 'Shipped' ) selected @endif >Shipped</option>
                        <option value="Delivered" @if( $order->order_status == 'Delivered' ) selected @endif >Delivered</option>
                        <option value="Cancelled" @if( $order->order_status == 'Cancelled' ) selected @endif >Cancelled</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                        <option value="1" @if( $order->is_active == true ) selected @endif >Active</option>
                        <option value="0" @if( $order->is_active == false ) selected @endif >Inactive</option>
                  </select>
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-outline-dark">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>



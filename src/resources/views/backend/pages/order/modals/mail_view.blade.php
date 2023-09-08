<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Order Mail</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">

     <div class="row product-section">
          <!-- left part start -->
          <div class="col-md-3">
                <div class="left">
                      <ul>
                            <li class="product-step active-product" id="mail-1">OnProcess</li>
                            <li class="product-step" id="mail-2">Shipped</li>
                            <li class="product-step" id="mail-3">Delivered</li>
                            <li class="product-step" id="mail-4">Cancelled</li>
                      </ul>
                </div>
          </div>
          <!-- left part end -->

          <!-- right part start -->
          <div class="col-md-9">
                        <div class="row product-step-filter mail-1">
                              @forelse(  $order->order_mail->where('status','OnProcess') as $key_one => $order_mail )
                              <div class="col-md-12" style="background: #f9f9f9;
                              margin-bottom: 15px;">
                                    {!! $order_mail->message !!}
                                    <p>Estimate Delivery Date : {{ $order_mail->estimate_time }}</p>
                                    <p>Send Date : {{ $order_mail->created_at->toDayDateTimeString() }}</p>
                                    <p>Sender Name : {{ $order_mail->user->name }}</p>
                              </div>
                              @empty
                              <div class="col-md-12 alert alert-warning">
                                    <p>No mail send</p>
                              </div>
                              @endforelse
                        </div>

                        <div class="row product-step-filter mail-2 hide-product">
                              @forelse(  $order->order_mail->where('status','Shipped') as $key_two => $order_mail )
                              <div class="col-md-12" style="background: #f9f9f9;
                              margin-bottom: 15px;">
                                    {!! $order_mail->message !!}
                                    <p>Send Date : {{ $order_mail->created_at->toDayDateTimeString() }}</p>
                              </div>
                              @empty
                              <div class="col-md-12 alert alert-warning">
                                    <p>No mail send</p>
                              </div>
                              @endforelse
                        </div>

                        <div class="row product-step-filter mail-3 hide-product">
                              @forelse(  $order->order_mail->where('status','Delivered') as $key_two => $order_mail )
                              <div class="col-md-12" style="background: #f9f9f9;
                              margin-bottom: 15px;">
                                    {!! $order_mail->message !!}
                                    <p>Send Date : {{ $order_mail->created_at->toDayDateTimeString() }}</p>
                              </div>
                              @empty
                              <div class="col-md-12 alert alert-warning">
                                    <p>No mail send</p>
                              </div>
                              @endforelse
                        </div>

                        <div class="row product-step-filter mail-4 hide-product">
                              @forelse(  $order->order_mail->where('status','Cancelled') as $key_three => $order_mail )
                              <div class="col-md-12" style="background: #f9f9f9;
                              margin-bottom: 15px;">
                                    {!! $order_mail->message !!}
                                    <p>Send Date : {{ $order_mail->created_at->toDayDateTimeString() }}</p>
                              </div>
                              @empty
                              <div class="col-md-12 alert alert-warning">
                                    <p>No mail send</p>
                              </div>
                              @endforelse
                        </div>
          </div>
          <!-- right part end -->
    </div>


 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>


 <script>

      $(document).ready(function(){
          $(".product-section ul .product-step").click(function(){
               let product = $(this).attr('id')
               
               if( product  != 'all' ){
                    $(".product-section ul li").removeClass('active-product')
                    $(this).addClass('active-product')
                    $(".product-section .product-step-filter").addClass('hide-product');
                    $("." + product ).removeClass('hide-product');
               }
          })
     })
 </script>


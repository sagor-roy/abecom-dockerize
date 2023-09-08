<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">View Full Order</h5>
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
                            <li>Order : #{{ $order->order_id }}</li>
                            <li class="product-step active-product" id="order-1"> @if( $order->customer_id ) Customer @else Guest @endif Details</li>
                            <li class="product-step" id="order-2">Order Details</li>
                            <li class="product-step" id="order-3">Order Products</li>
                            <li class="product-step" id="order-4">Payment Details</li>
                      </ul>
                </div>
          </div>
          <!-- left part end -->

          <!-- right part start -->
          <div class="col-md-9">
                  <div class="row product-step-filter order-1">
                        <div class="col-md-12">
                              @if( $order->customer_id == 0 )
                              <p style="color: red!important">Guest Checkout</p>
                              @endif
                              <p><b>Name : </b> {{ $order->name }} </p>
                              <p><b>Email : </b> {{ $order->email }} </p>
                              <p><b>Phone : </b> {{ $order->phone }} </p>
                              <p><b>City : </b> {{ $order->city->city }} </p>
                              <p><b>Country : </b> {{ $order->country }} </p>
                              <p><b>Address : </b> {{ $order->shipping_address }} </p>
                              @if( $order->customer_id )
                              <p><b>Balance : </b> ৳{{ $order->customer_balance }} BDT </p>
                              <p><b>Member Since : </b> {{ $order->customer->created_at->toDayDateTimeString() }} </p>
                              @endif
                        </div>
                  </div>

                  <div class="row product-step-filter order-2 hide-product">
                        <div class="col-md-12">
                              <p><b>Shipping Charge : </b> 
                                    @if( $order->delivery_type == "Local" )

                                    No Charge

                                    @else

                                    @if( $order->shipping_charge == 0 )
                                    Courier Charge
                                    @else
                                    {{ $order->shipping_charge }} BDT
                                    @endif

                                    @endif
                                    
                              </p>
                              <p><b>Order Amount : </b> {{ $order->amount }} BDT</p>
                              <p><b>Amount After Discount : </b> @if( $order->amount_after_discount ) {{ $order->amount_after_discount }} BDT @else No Discount @endif  </p>
                              <p><b>Coupon Code : </b> @if( $order->coupon_id ) {{ $order->coupon->code }} @else N/A @endif </p>
                              <p><b>Order Product : </b> {{ $order->order_product->count() }} Product</p>

                              <p><b>Delivery Type : </b> {{ $order->delivery_type }}</p>
                              
                              <p><b>PickUp Point : </b> 

                              @if( $order->pickup_id )
                              {{ $order->pickup->name }}
                              @else
                              {{ $order->shipping_address }} 
                              @endif
                              
                              </p>

                              @if( $order->courier_id )
                              <p>
                                    <b>Courier :</b>
                                    {{ $order->courier->courier }}
                              </p>
                              @endif

                              @if( $order->delivery_type == "Local" )

                              <p> <b>Total</b> : 
                              ৳ {{ $order->amount_after_discount ? $order->amount_after_discount : $order->amount }}
                              </p>

                              @else

                              @php
                                    $total = $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
                              @endphp
                              @if( $order->customer_balance > $total )
                              <p> <b>Total</b> : 
                                    @if( $order->shipping_charge == 0 )
                                    Courier Charge
                                    @else
                                    ৳{{  $order->shipping_charge  }} BDT
                                    @endif
                              </p>
                              @else
                              <p> <b>Total</b> : ৳{{  ( $order->shipping_charge + $total ) - $order->customer_balance }} BDT @if( $order->shipping_charge == 0 ) + Courier Charge @endif </p>
                              @endif

                              @endif

                              <p><b>Order Date : </b>{{ $order->created_at->toDayDateTimeString() }}</p>
                              <p><b>Last Updated : </b>{{ $order->updated_at->toDayDateTimeString() }}</p>
                              <p><b>Order Note : </b>{{ $order->note }}</p>

                        </div>
                  </div>

                  <div class="row product-step-filter order-3 hide-product">
                        @foreach( $order->order_product as $order_product )
                        <div class="col-md-12">
                              <div class="row"> 
                                    <div class="col-md-3 col-3">
                                          <img src="{{ asset('images/product/'. $order_product->product->thumbnail) }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-9 col-9">
                                          <p>{{ $order_product->product->name }}</p>
                                          <p>৳{{ $order_product->unit_price }}x{{ $order_product->quantity }} BDT</p>
                                          @if( $order_product->product_varient_value_id )
                                          <p>Color : {{ $order_product->product_attribute->value }}</p>
                                          @endif
                                    </div>
                              </div>
                        </div>
                        @endforeach
                  </div>

                  <div class="row product-step-filter order-4 hide-product">
                        <div class="col-md-12">
                              <p><b>Payment Status : </b> {{ $order->payment_status }}</p>
                              <p><b>Paid By : </b> {{ $order->paid_by }} </p>
                              <p><b>Order Status : </b> {{ $order->order_status }} </p>
                              <p><b>Is Active : </b> @if( $order->is_active == true ) Active @else Inactive @endif </p>
                        </div>
                  </div>
          </div>
          <!-- right part end -->
    </div>


 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <!-- <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
 <!-- <script src="{{ asset('backend/dist/js/custom.js') }}"></script> -->

 <script>
      $(document).ready( function () {
            $('.datatable').DataTable();
      });

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


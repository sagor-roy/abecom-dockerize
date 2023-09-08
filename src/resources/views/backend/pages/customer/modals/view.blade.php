<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">

     <div class="row product-section">
          <!-- left part start -->
          <div class="col-md-3">
                <div class="left">
                      <p>Customer ID : #{{ $customer->id }}</p>
                      <p>Balance : {{ $customer->balance }} BDT</p>
                      <ul>
                            <li class="product-step active-product" id="product-1">Basic information</li>
                            <li class="product-step" id="product-2">Shipping details</li>
                            <li class="product-step" id="product-3">Order history</li>
                      </ul>
                </div>
          </div>
          <!-- left part end -->

            <!-- right part start -->
            <div class="col-md-9">
                  <div class="row product-step-filter product-1">
                        <div class="col-md-12">
                              <p><b>Name</b></p>
                              <p>{{ $customer->name }}</p>
                        </div>
                        <div class="col-md-12">
                              <p><b>Phone</b></p>
                              @if( $customer->phone != $customer->email )
                              <p>{{ $customer->phone }}</p>
                              @endif
                        </div>
                        <div class="col-md-12">
                              <p><b>Email</b></p>
                              <p>{{ $customer->email }}</p>
                        </div>
                        <div class="col-md-12">
                              <p><b>Status</b></p>
                              @if( $customer->is_active == true )
                              <p>Active</p>
                              @else
                              <p>Inactive</p>
                              @endif
                        </div>
                        <div class="col-md-12">
                              <p><b>Customer since</b></p>
                              <p>{{ $customer->created_at->toDayDateTimeString() }}</p>
                        </div>
                  </div>

                  <div class="row product-step-filter product-2 hide-product">
                        <div class="col-md-12">
                              <p><b>City</b></p>
                              @if( $customer->city )
                              <p>{{ $customer->city }}</p>
                              @else
                              <p>N/A</p>
                              @endif
                        </div>
                        <div class="col-md-12">
                              <p><b>Country</b></p>
                              @if( $customer->country )
                              <p>{{ $customer->country }}</p>
                              @else
                              <p>N/A</p>
                              @endif
                        </div>
                        <div class="col-md-12">
                              <p><b>Address</b></p>
                              @if( $customer->address )
                              <p>{{ $customer->address }}</p>
                              @else
                              <p>N/A</p>
                              @endif
                        </div>
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


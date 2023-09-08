<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">View all birthday message of {{ $customer->name }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
       @if( $customer->wish->count() > 0 )
      <div class="row product-section">
            <!-- left part start -->
            <div class="col-md-3">
                  <div class="left">
                        <ul>
                              <li class="product-step active-product" id="product-1">Wishes</li>
                        </ul>
                  </div>
            </div>
            <!-- left part end -->
  
            <!-- right part start -->
            <div class="col-md-9">
                  <div class="row product-step-filter product-1">
                        @foreach( $customer->wish as $wish )
                        <div class="col-md-12">
                              <p>{{ $wish->message }}</p>
                              <p>{{ $wish->created_at->toDayDateTimeString() }}</p>
                              <p>Sender Name : {{ $wish->user->name }}</p>
                        </div>
                        @endforeach
                  </div>
            </div>
            <!-- right part end -->
      </div>
      @else
      <div class="row">
            <div class="col-md-12 alert alert-warning">
                  <p>No birthday wish</p>
            </div>
      </div>
      @endif
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="{{ asset('backend/dist/js/custom.js') }}"></script>
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

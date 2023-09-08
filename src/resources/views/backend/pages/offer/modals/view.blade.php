<div class="modal-header">
    <h5 class="modal-title" id="largeModal">Offer Details</h5>
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
                    <li class="product-step active-product" id="product-1">Offer Information</li>
                    <li class="product-step" id="product-2">Offer Category</li>
                    <li class="product-step" id="product-3">Offer Product</li>
                </ul>
            </div>
        </div>
        <!-- left part end -->

        <!-- right part start -->
        <div class="col-md-9">
            <div class="row product-step-filter product-1">
                <div class="col-md-12">
                    <p>{{ $offer->name }}</p>
                    @if( $offer->percent == 0 )
                        <p>{{ $offer->cash_discount }} BDT</p>
                    @elseif( $offer->cash_discount == 0 )
                        <p>{{ $offer->percent }} %</p>
                    @endif
                    <p>End Date : {{ $offer->end_date }}</p>
                </div>
                <div class="col-md-6">
                    <p>Offer Image</p>
                    <img src="{{ asset('images/offer/'. $offer->image) }}" width="50px" alt="">
                </div>
                <div class="col-md-6">
                    <p>Offer Column Image</p>
                    <img src="{{ asset('images/offer/'. $offer->column_image) }}" width="100px" alt="">
                </div>
            </div>

            <div class="row product-step-filter product-2 hide-product">
                <div class="col-md-12">
                    @foreach( $offer->category as $category )
                    <small class="badge badge-success mt-1">{{ $category->name }}</small>
                    @endforeach
                </div>
            </div>

            <div class="row product-step-filter product-3 hide-product">
                <div class="col-md-12">
                    @forelse( $offer->product as $product )
                    <small class="badge badge-success mt-1">{{ $product->name }}</small>
                    @empty
                    <small class="badge badge-success">
                        All Products in category
                    </small>
                    @endforelse
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
    $(document).ready(function () {
        $(".product-section ul .product-step").click(function () {
            let product = $(this).attr('id')

            if (product != 'all') {
                $(".product-section ul li").removeClass('active-product')
                $(this).addClass('active-product')
                $(".product-section .product-step-filter").addClass('hide-product');
                $("." + product).removeClass('hide-product');
            }
        })
    })

</script>

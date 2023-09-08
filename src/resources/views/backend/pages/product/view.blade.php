
      <div class="modal-header">
            <h3>Product Full Details</h3>
      </div>

      <div class="modal-body">

            <div class="row product-section">
                  <!-- left part start -->
                  <div class="col-md-3">
                        <div class="left">
                              <ul>
                                    <li class="product-step active-product" id="product-1">Basic Information</li>
                                    <li class="product-step" id="product-2">Thumbnail</li>
                                    <li class="product-step" id="product-3">Product Gallery</li>
                                    <li class="product-step" id="product-4">Short description</li>
                                    <li class="product-step" id="product-5">Description</li>
                                    <li class="product-step" id="product-6">Specification</li>
                                    @if( $product->qty == null )
                                    <li class="product-step" id="product-7">Attributes</li>
                                    <li class="product-step" id="product-8">Varient</li>
                                    @endif
                                    <li class="product-step" id="product-9">Status</li>
                                    <li class="product-step" id="product-10">All Review</li>
                              </ul>
                        </div>
                  </div>
                  <!-- left part end -->
        
                  <!-- right part start -->
                  <div class="col-md-9">
                        <div class="row product-step-filter product-1">
                              <div class="col-md-12">
                                    <p><b>Name</b></p>
                                    <p>{{ $product->name }}</p>
                              </div>
                              @if( $product->qty != null )
                              <div class="col-md-12">
                                    <p><b>In Stock</b></p>
                                    <p>{{ $product->qty }}</p>
                              </div>
                              @endif
                              <div class="col-md-12">
                                    <p><b>Category</b></p>
                                    <p>{{ $product->category->name }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Sub Category</b></p>
                                    <p>{{ $product->sub_category->name }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Brand</b></p>
                                    <p>{{ $product->brand->name }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Price</b></p>
                                    <p>{{ $product->price }} BDT</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Offer Price</b></p>
                                    @if( $product->offer_price )
                                    <p>{{ $product->offer_price }} BDT</p>
                                    @else
                                    <p>N/A</p>
                                    @endif
                              </div>
                        </div>
      
                        <div class="row product-step-filter product-2 hide-product">
                              <div class="col-md-12">
                                    <div class="row">
                                          <div class="col-md-12">
                                                <img src="{{ asset('images/product/'. $product->thumbnail ) }}" width="100px" alt="">
                                          </div>
                                    </div>
                              </div>
                        </div>

                        <div class="row product-step-filter product-3 hide-product">
                              <div class="col-md-12">
                                    <div class="row">
                                          <div class="col-md-12">
                                                @if( $product->product_image->count() > 0 )
                                                      @foreach( $product->product_image as $single_image )
                                                      <img src="{{ asset('images/product/'. $single_image->image ) }}" width="100px" alt="">
                                                      @endforeach
                                                @else
                                                <p class="alert alert-warning">No gallery image</p>
                                                @endif
                                          </div>
                                    </div>
                              </div>
                        </div>
      
                        <div class="row product-step-filter product-4 hide-product">
                              <div class="col-md-12">
                                    {!! $product->short_description !!}
                              </div>
                        </div>

                        <div class="row product-step-filter product-5 hide-product">
                              <div class="col-md-12">
                                    {!! $product->description !!}
                              </div>
                        </div>

                        <div class="row product-step-filter product-6 hide-product">
                              <div class="col-md-12">
                                    {!! $product->specification !!}
                              </div>
                        </div>
      
                        <div class="row product-step-filter product-7 hide-product">
                              <div class="col-md-12">
                                    <ul>
                                          @foreach( App\Models\Varient::all() as $varient )
                                          @if( $varient->product_varient_value->count() > 0 )
                                          <li>
                                                {{ $varient->name }}
                                          </li>
                                          @endif
                                          @endforeach
                                    </ul>
                              </div>
                        </div>

                        <div class="row product-step-filter product-8 hide-product">
                              <div class="col-md-12">
                                    <ul>
                                          @if( $product->category->attribute->count() > 0 )
                                          @foreach( $product->category->attribute as $attribute )
                                          <li>
                                                {{ $attribute->name }} :
                                                <ul>
                                                      @if( $attribute->product_attribute->where('product_id', $product->id)->count() > 0 )
                                                      @foreach( $attribute->product_attribute->where('product_id', $product->id) as $product_attribute )
                                                      <li>{{ $product_attribute->value }} ( In Stock : {{ $product_attribute->qty }} )</li>
                                                      @endforeach
                                                      @else
                                                      <li class="alert alert-warning">No varient value found</li>
                                                      @endif
                                                </ul>
                                          </li>
                                          @endforeach
                                          @else
                                          <li class="alert alert-warning">No varient found</li>
                                          @endif
                                    </ul>
                              </div>
                        </div>

                        <div class="row product-step-filter product-9 hide-product">
                              <div class="col-md-12">
                                    <p><b>Is Featured ?</b></p>
                                    <p>{{ $product->is_featured ? 'Yes' : 'No' }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Is on sale ?</b></p>
                                    <p>{{ $product->is_onsale ? 'Yes' : 'No' }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Is top rated ?</b></p>
                                    <p>{{ $product->is_top_rated ? 'Yes' : 'No' }}</p>
                              </div>
                              <div class="col-md-12">
                                    <p><b>Status</b></p>
                                    <p>{{ $product->is_active ? 'Active' : 'Inactive' }}</p>
                              </div>
                        </div>

                        <div class="row product-step-filter product-10 hide-product">
                              <div class="col-md-12">
                                    @forelse( $product->review as $review )
                                    <div class="row">
                                          <div class="col-md-2">
                                                <a href="{{ route('productdetails',$review->product->thumbnail) }}">
                                                      <img src="{{ asset('images/product/'. $review->product->thumbnail) }}" class="img-fluid" alt="">
                                                </a>
                                          </div>
                                          <div class="col-md-10">
                                                <p>
                                                      {{ $review->review }}
                                                </p>
                                                <p>{{ auth('customer')->user()->name }} - {{ $review->created_at->toDayDateTimeString() }}</p>
                                          </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                          <div class="col-md-12 alert alert-warning">
                                                <p>No product review found</p>
                                          </div>
                                    </div>
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

      $(document).ready(function(){
          $(".product-section .left ul .product-step").click(function(){
               let product = $(this).attr('id')
               console.log(product)
               if( product  != 'all' ){
                    $(".product-section ul li").removeClass('active-product')
                    $(this).addClass('active-product')
                    $(".product-section .product-step-filter").addClass('hide-product');
                    $("." + product ).removeClass('hide-product');
               }
          })
     })
 </script>
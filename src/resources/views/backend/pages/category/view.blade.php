<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Category Details</h5>
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
                            <li class="product-step active-product" id="product-1">Name</li>
                            <li class="product-step" id="product-2">Images</li>
                            <li class="product-step" id="product-3">Sub Categories</li>
                            <li class="product-step" id="product-4">Brands</li>
                            <li class="product-step" id="product-5">Varient</li>
                            <li class="product-step" id="product-6">Attributes</li>
                      </ul>
                </div>
          </div>
          <!-- left part end -->

          <!-- right part start -->
          <div class="col-md-9">
                    <p>Total product in this category : {{ $category->product->count() }}</p>
                      <div class="row product-step-filter product-1">
                            <div class="col-md-12">
                                   <p>{{ $category->name }}</p>
                            </div>
                      </div>

                      <div class="row product-step-filter product-2 hide-product">
                         <div class="col-md-12">
                              <div class="row">
                                   <div class="col-md-6">
                                        <label>Category Image</label> <br>
                                        <img src="{{ asset('images/category/'. $category->image) }}" width="150px" alt="">
                                   </div>
                                   <div class="col-md-6">
                                        <label>Banner Image</label> <br>
                                        @if($category->banner_image)
                                        <img src="{{ asset('images/category/'. $category->banner_image) }}" width="150px" alt="">
                                        @else
                                        <p class="badge badge-danger">No image found</p>
                                        @endif
                                   </div>
                              </div>
                         </div>
                      </div>

                      <div class="row product-step-filter product-3 hide-product">
                            <div class="col-md-12">
                              @foreach( $category->brand as $brand )
                              <p class="badge badge-success" style="display: inline">{{ $brand->name }}</p>
                              @endforeach
                            </div>
                      </div>

                      <div class="row product-step-filter product-4 hide-product">
                            <div class="col-md-12">
                              @foreach( $category->subcategory as $subcategory )
                              <p class="badge badge-success" style="display: inline">{{ $subcategory->name }}</p>
                              @endforeach
                            </div>
                      </div>

                      <div class="row product-step-filter product-5 hide-product">
                         @foreach( $category->attribute as $attribute )
                         <p class="badge badge-success" style="display: inline">{{ $attribute->name }}</p>
                         @endforeach
                      </div>

                      <div class="row product-step-filter product-6 hide-product">
                         @foreach( App\Models\Varient::all() as $varient )
                         @if( $varient->category_varient->count() > 0 )
                         <p class="badge badge-success" style="display: inline">{{ $varient->name }}</p>
                         @endif
                         @endforeach
                      </div>
                      
                </form>
          </div>
          <!-- right part end -->
    </div>

     {{-- <div class="row" style="margin-top: 30px;">
          <div class="col-md-12 table-responsive">
               <p>Category Offers</p>
               <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Percent</th>
                        <th scope="col">Start time</th>
                        <th scope="col">End time</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach( $category->offer as $key => $offer )
                         <tr>
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>
                                   @if( $offer->image )
                                   <img src="{{ asset('images/offer/'. $offer->image) }}" width="50px" alt="">
                                   @else
                                   No image uploaded
                                   @endif
                              </td>
                              <td>{{ $offer->name }}</td>
                              <td>{{ $offer->percent }}%</td>
                              <td>{{ $offer->created_at->toDateString() }}</td>
                              <td>{{ $offer->end_date }}</td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div> --}}

 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
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


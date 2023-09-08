<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('cat.offer.update', $offer->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <label>Offer name</label>
                  <input type="text" class="form-control" name="name" value="{{ $offer->name }}">
            </div>
            <div class="form-group">
                  <label>Choose Category (required)</label>
                  <select name="categories[]" class="form-control " id="chosen2"  multiple>
                        @foreach( \App\Models\Category::orderBy('id','desc')->where('is_active', true)->get() as $category  )
                        @if( $category->product->count() > 0 )
                        <option value="{{ $category->id }}"
                              @foreach( $offer->category as $offer_category )
                                    @if( $offer_category->id == $category->id )
                                    selected
                                    @endif
                              @endforeach
                        >{{ $category->name }}</option>
                        @endif
                        @endforeach
                  </select>
            </div>
            <div class="row form-group">
                  <div class="col-md-12">
                        <input type="checkbox" class="form-control-check" name="all_product" id="all_product2" value="1" @if( $offer->product->count() == 0 ) checked @endif >
                        <label for="all_product">Add this offer to all product in your selected category</label>
                  </div>
                  
                  <div @if( $offer->product->count() == 0 ) style="display: none" @else style="display: block" @endif  class="col-md-12" id="choose_product2">
                  
                        <label>Choose Product (required)</label>
                        <select name="products[]" class="form-control " id="chosen3"  multiple="multiple">
                              @foreach( \App\Models\Product::orderBy('id','desc')->where('is_active', true)->get() as $product  )
                              <option value="{{ $product->id }}"
                              @foreach( $offer->product as $offer_product )
                                    @if( $offer_product->id == $product->id )
                                    selected
                                    @endif
                              @endforeach      
                              >{{ $product->name }}</option>
                              @endforeach
                        </select>
                  </div>
            </div>
            <div class="form-group row">
                  <div class="form-group col-md-6" >
                        <label>Cash Discount</label>
                        <input type="number" min="0" class="form-control" name="cash_discount" id="cash_dis2" oninput="cashDis2()" value="{{ $offer->cash_discount }}">
                  </div>
                  <div class="form-group col-md-6" >
                        <label >Percentage</label>
                        <input type="number" min="0" max="100" class="form-control" name="percent" id="percent2" oninput="percentDis2()" value="{{ $offer->percent }}">
                  </div>
            </div>
            <div class="form-group">
                  <label>Select end date</label>
                  <input type="date" class="form-control" value="{{ $offer->end_date }}" name="date">
            </div>
            <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                        <option value="1" @if( $offer->status == true ) selected @endif >Active</option>
                        <option value="0" @if( $offer->status == false ) selected @endif >Inactive</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Offer Image ( Max : 50KB, Width: 90px, Height : 90px )</label> <br>
                  <img src="{{ asset('images/offer/'. $offer->image) }}" id="image_preview_container" class="default-thhumbnail" width="100px" alt=""> 
                  <br><br>
                  <input type="file" class="form-control-file" name="image" id="image"> 
            </div>
            <div class="form-group">
                  <label>Offer Banner ( Max : 50KB, Width: 1150px, Height : 400px )</label> <br>
                  <img src="{{ asset('images/offer/'. $offer->banner) }}" id="image_preview_container" class="default-thhumbnail" width="100px" alt=""> 
                  <br><br>
                  <input type="file" class="form-control-file" name="banner" id="image"> 
            </div>
            <div class="form-group">
                <label for="">Choose Offer Color</label>
                <input type="text" id="demo" class="demo form-control" name="color" value="{{ $offer->color }}">
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>



<link rel="stylesheet" href="{{ asset('backend/dist/css/jquery.minicolors.css') }}">
<script src="{{ asset('backend/dist/js/jquery.minicolors.js') }}"></script>

<script>
    $('.demo').minicolors();
</script>


 <script type="text/javascript">
      function percentDis2(){
            $("#cash_dis2").val(0)
      }
      function cashDis2(){
            $("#percent2").val(0)
      }
</script>




 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

 <script>
    
      $("#chosen2").chosen()
      $("#chosen3").chosen()
      $("#all_product2").click(function(e){
            if( e.target.checked == true ){
                  $("#choose_product2").hide()
            }else{
                  $("#choose_product2").show()
            }
      })
      
 </script>

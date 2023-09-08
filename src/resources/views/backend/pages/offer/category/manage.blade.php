@extends('backend.template.layout')

<style>
      .chosen-container .chosen-results li.disabled-result {
            background: gainsboro!important;
      }
</style>

@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      
      <!-- title row start -->
      <div class="row">
            <div class="col-md-12">
                  <!--begin:: Widgets/Application Sales-->
                  <div class="kt-portlet kt-portlet--height-fluid">
                        
                        <div class="kt-portlet__head">
                              <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                          All Offer 
                                    </h3>
                              </div>
                              <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                          <li class="nav-item">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#exampleModal">
                                                      Add
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Create new offer</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('cat.offer.add') }}" class="ajax-form" method="post" enctype="multipart/form-data" >
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <label>Offer name</label>
                                                                                    <input type="text" class="form-control" name="name">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Choose Category (required)</label>
                                                                                    <select name="categories[]" class="form-control chosen2"  multiple>
                                                                                          @foreach( \App\Models\Category::orderBy('id','desc')->where('is_active', true)->get() as $category  )
                                                                                          @if( $category->product->count() > 0 )
                                                                                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                                          @endif
                                                                                          @endforeach
                                                                                    </select>
                                                                              </div>
                                                                              <div class="row form-group">
                                                                                    <div class="col-md-12">
                                                                                          <input type="checkbox" class="form-control-check" name="all_product" id="all_product" value="1">
                                                                                          <label for="all_product">Add this offer to all product in your selected category</label>
                                                                                    </div>
                                                                                    <div class="col-md-12" id="choose_product">
                                                                                          <label>Choose Product (required)</label>
                                                                                          <select name="products[]" class="form-control chosen2"  multiple="multiple">
                                                                                                @foreach( \App\Models\Category::orderBy('id','desc')->where('is_active', true)->get() as $category  )
                                                                                                <option disabled>{{ $category->name }}</option>
                                                                                                      @foreach( $category->product->where('is_active', true) as $product )
                                                                                                      <option value="{{ $product->id }}" style="padding-left: 15px">{{ $product->name }}</option>
                                                                                                      @endforeach
                                                                                                @endforeach
                                                                                          </select>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="form-group row">
                                                                                    <div class="form-group col-md-6" >
                                                                                          <label>Cash Discount</label>
                                                                                          <input type="number" min="0" class="form-control" name="cash_discount" id="cash_dis" oninput="cashDis()"value="0">
                                                                                    </div>
                                                                                    <div class="form-group col-md-6" >
                                                                                          <label>Percentage</label>
                                                                                          <input type="number" min="0" max="100" class="form-control" name="percent" id="percent" oninput="percentDis()" value="0">
                                                                                    </div>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Select end date</label>
                                                                                    <input type="date" class="form-control" name="date">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Offer Image ( Max : 50KB, Width: 90px, Height : 90px )</label> <br>
                                                                                    <img src="{{ asset('backend/images/thumbnail.png') }}" class="default-thhumbnail image_preview_container" width="100px" alt=""> 
                                                                                    <br><br>
                                                                                    <input type="file" class="form-control-file image" name="image"> 
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Offer banner ( Max : KB, Width: 1150px, Height : 400px )</label> <br>
                                                                                    <img src="{{ asset('backend/images/thumbnail.png') }}" class="default-thhumbnail image_preview_container" width="100px" alt=""> 
                                                                                    <br><br>
                                                                                    <input type="file" class="form-control-file image" name="banner"> 
                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="">Choose Offer Color</label>
                                                                                <input type="text" id="demo" class="demo form-control" name="color" value="#ff6161">
                                                                            </div>
                                                                              <div class="form-group">
                                                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                                              </div>
                                                                        </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </li>
                                    </ul>
                              </div>
                        </div>

                        <div class="kt-portlet__body">
                              <div class="tab-content">
                                    <div class="tab-pane active" id="kt_widget11_tab1_content">
                                          <!--begin::Widget 11--> 
                                          <div class="kt-widget11">
                                                <div class="table-responsive">					 
                                                      <table class="table offer-category" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>ID</th>
                                                                        <th>Offer Image</th>
                                                                        <th>Offer Details</th>
                                                                        <th>Category</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                   </tr>
                                                            </thead>									     
                                                      </table>
                                                </div>
                                          </div>
                                          <!--end::Widget 11--> 						             
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!--end:: Widgets/Application Sales-->	
            </div>
      </div>
      <!-- title row end -->
  
</div>
<!-- end:: Content -->
@endsection

@section('per_page_js')

<link rel="stylesheet" href="{{ asset('backend/dist/css/jquery.minicolors.css') }}">
<script src="{{ asset('backend/dist/js/jquery.minicolors.js') }}"></script>

<script>
    $("#thumbnail_image").hide();
    $(".chosen").chosen()
    $('.demo').minicolors();

</script>

<script>
      $(".chosen").chosen()
      $("#chosen").chosen()
      $(".chosen2").chosen({
            search_contains: true,
      })
      $("#chosen2").chosen()
      $(".chosen3").chosen()
</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
      $(function() {
            $('.offer-category').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('cat.offer.data') }}",
                  order: [[0,'Desc']],
                  columns: [
                        {
                        data: 'id',
                        name: 'id'
                        }, 
                        {
                        data: 'image',
                        name: 'image'
                        }, 
                        {
                        data: 'offer',
                        name: 'offer'
                        },      
                        {
                        data: 'category',
                        name: 'category'
                        },
                        {
                        data: 'status',
                        name: 'status'
                        },
                        {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        },
                  ]
            });
      });
      
      $('.image').change(function(){
          const $this = $(this)
          let reader = new FileReader();
          reader.onload = (e) => { 
          $this.closest(".form-group").find(".image_preview_container").attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });


      function percentDis(){
            $("#cash_dis").val(0)
      }
      function cashDis(){
            $("#percent").val(0)
      }

      $("#all_product").click(function(e){
            if( e.target.checked == true ){
                  $("#choose_product").hide()
            }else{
                  $("#choose_product").show()
            }
      })
      

</script>
@endsection
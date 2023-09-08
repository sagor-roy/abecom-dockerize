@extends('backend.template.layout')



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
                                          All Coupon code 
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
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('coupon.add') }}" class="ajax-form" method="post" enctype="multipart/form-data" >
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <label>Code</label>
                                                                                    <input type="text" class="form-control" name="code">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Coupon Name</label>
                                                                                    <input type="text" class="form-control" name="name">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <input type="checkbox" class="form-control-check" name="is_cash" id="is_cash">
                                                                                    <label for="is_cash">Want to add cash discount?</label>
                                                                              </div>
                                                                              <div class="form-group" id="percentage">
                                                                                    <label>Percentage</label>
                                                                                    <input type="number" min="1" max="100" class="form-control" name="percent">
                                                                              </div>
                                                                              <div class="form-group" id="cash_discount">
                                                                                    <label>Cash Discount</label>
                                                                                    <input type="number" min="1" class="form-control" name="cash_discount">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>End Date</label>
                                                                                    <input type="date" class="form-control" name="end_date">
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
                                                      <table class="table coupon-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>Code</th>
                                                                        <th>Name</th>
                                                                        <th>Percentage</th>
                                                                        <th>Cash</th>
                                                                        <th>Status</th>
                                                                        <th>End Date</th>
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

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
      $(function() {
            $('.coupon-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('coupon.data') }}",
                  columns: [
                        {
                        data: 'code',
                        name: 'code'
                        },
                        {
                        data: 'name',
                        name: 'name'
                        },
                        {
                        data: 'percentage',
                        name: 'percentage'
                        },
                        {
                        data: 'cash_discount',
                        name: 'cash_discount'
                        },
                        {
                        data: 'status',
                        name: 'status'
                        },
                        {
                        data: 'end_date',
                        name: 'end_date'
                        },
                        {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        },
                  ]
            });
      });
      
      $('#image').change(function(){
          
          let reader = new FileReader();
          reader.onload = (e) => { 
          $('#image_preview_container').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });


      $("#cash_discount").hide();
      $("#is_cash").click(function(e){
            if( e.target.checked == true ){
                  $("#cash_discount").show();
                  $("#percentage").hide();
            }else{
                  $("#cash_discount").hide();
                  $("#percentage").show();
            }
      })
      

</script>
@endsection
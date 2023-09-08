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
                                          Product Question and Answer
                                    </h3>
                              </div>
                        </div>

                        <div class="kt-portlet__body">
                              <div class="tab-content">
                                    <div class="tab-pane active" id="kt_widget11_tab1_content">
                                          <!--begin::Widget 11--> 
                                          <div class="kt-widget11">
                                                <div class="table-responsive">					 
                                                      <table class="table product-qa-datatables" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>ID</th>
                                                                        <th>Question</th>
                                                                        <th>Answer</th>
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
            $('.product-qa-datatables').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('product.qa.data') }}",
                  order: [[0,'Desc']],
                  columns: [
                        {
                        data: 'id',
                        name: 'id'
                        },
                        {
                        data: 'question',
                        name: 'question'
                        },
                        {
                        data: 'answer',
                        name: 'answer'
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
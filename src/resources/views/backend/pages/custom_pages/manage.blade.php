@extends('backend.template.layout')


@section('per_page_css')
<style>
     .link{
          display: none;
     }
</style>
@endsection

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
                                   Custom Pages
                              </h3>
                         </div>
                         <div class="kt-portlet__head-toolbar">
                              <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                   <li class="nav-item">

                                        <!-- Button trigger modal -->
                                        <button type="button" data-content="{{ route('custom.page.add.modal') }}" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                                             Add
                                        </button>

                                        
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
                                             <table class="table widget-datatable" id="datatable">
                                                  <thead>
                                                       <tr>
                                                            <th>Position</th>
                                                            <th>Name</th>
                                                            <th>Widget</th>
                                                            <th>Type</th>
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

<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>

<script>
     $(function() {
          $('.widget-datatable').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ route('custom.page.data') }}",
               columns: [{
                         data: 'position',
                         name: 'position'
                    },
                    {
                         data: 'name',
                         name: 'name'
                    },
                    {
                         data: 'footer_widget_id',
                         name: 'footer_widget_id'
                    },
                    {
                         data: 'type',
                         name: 'type'
                    },
                    {
                         data: 'is_active',
                         name: 'is_active'
                    },
                    {
                         data: 'action',
                         name: 'action',
                         orderable: false,
                    },
               ]
          });
     });

     var editor1 = new RichTextEditor("#div_editor1");
</script>

<script>
     $(document).on('change','.type-onchange', function(){
          let value = $('.type-onchange option:selected').val()
          
          if( value == "Page" ){
               $(".link").hide();
               $(".content").show();
          }
          else{
               $(".link").show();
               $(".content").hide();
          }
     });
</script>
@endsection
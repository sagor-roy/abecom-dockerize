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
                                          Attribute set value page
                                    </h3>
                              </div>
                              <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                          <li class="nav-item">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#exampleModal">
                                                      Add set value
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add set value</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('sub.attr.add') }}" class="ajax-form" method="post">
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <label>Attribute</label>
                                                                                    <select name="attribute_id" class="form-control" id="chosen">
                                                                                          @foreach ( \App\Models\Attribute::orderBy('id','desc')->get() as $attribute)
                                                                                          <option value="{{ $attribute->id }}"
                                                                                          >{{ $attribute->name }}</option>
                                                                                          @endforeach
                                                                                    </select>
                                                                                   
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Value</label>
                                                                                    <input type="text" placeholder="red / xl / m" class="form-control" name="value" >
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <input type="hidden" name="attr_set_id" value="{{ $attr_set->id }}">
                                                                                    <button type="submit" class="btn btn-success">Add</button>
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
                                                      <table class="table sub-attr-set-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>Set name</th>
                                                                        <th>Attribute</th>
                                                                        <th>Value</th>
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




<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>


<script>
      
      $("#chosen").chosen()

      $(function() {
            $('.sub-attr-set-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('sub.attr.data', $attr_set->id) }}",
                  columns: [
                        {
                        data: 'attr_set',
                        name: 'attr_set'
                        },
                        {
                        data: 'attr',
                        name: 'attr'
                        },
                        {
                        data: 'value',
                        name: 'value'
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

      

</script>
@endsection
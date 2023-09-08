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
                                          All User 
                                    </h3>
                              </div>
                              <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                          <li class="nav-item">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#exampleModal">
                                                      Add New User
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('user.add') }}" class="ajax-form" method="post" enctype="multipart/form-data" >
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <label>Name</label>
                                                                                    <input type="text" class="form-control" name="name">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Email</label>
                                                                                    <input type="email" class="form-control" name="email">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Password</label>
                                                                                    <input type="password" class="form-control" name="password">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Confirm Password</label>
                                                                                    <input type="password" class="form-control" name="password_confirmation">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Assign user role</label>
                                                                                    <select name="roles[]" class="form-control chosen2" multiple >
                                                                                          @foreach( \App\Models\Role::orderBy('id','desc')->get() as $role  )
                                                                                          <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                                                          @endforeach
                                                                                    </select>
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
                                                      <table class="table user-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>id</th>
                                                                        <th>User</th>
                                                                        <th>Role</th>
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

<script>
      $(".chosen2").chosen()
</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
      $(function() {
            $('.user-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('user.data') }}",
                  order: [ [0,'desc'] ],
                  columns: [
                        {
                        data: 'id',
                        name: 'id'
                        },
                        {
                        data: 'user',
                        name: 'user'
                        },
                        {
                        data: 'role',
                        name: 'role'
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
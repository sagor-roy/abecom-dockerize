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
                                          All Thana
                                    </h3>
                              </div>
                              <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                          <li class="nav-item">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#addThanaModal">
                                                      Add
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="addThanaModal" tabindex="-1" role="dialog" aria-labelledby="addThanaModalModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title" id="addThanaModalModalLabel">Add New Thana</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('thana.add') }}" class="ajax-form" method="post">
                                                                              @csrf

                                                                              <div class="form-group">
                                                                                <label for="">City</label>
                                                                                <select required class="form-control" name="city" id="">
                                                                                  <option value="">Select City</option>

                                                                                  @foreach ($cities as $city)
                                                                                      <option value="{{ $city->id }}">{{ $city->city }}</option>
                                                                                  @endforeach

                                                                                </select>
                                                                              </div>


                                                                              <div class="form-group">
                                                                                    <label>Thana</label>
                                                                                    <input required type="text" class="form-control" name="thana">
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
                                                      <table class="table thana-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>ID</th>
                                                                        <th>City</th>
                                                                        <th>Thana</th>
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

<script>

      $(function() {
            $('.thana-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('thana.data') }}",
                  order: [ [0,'desc'] ],
                  columns: [
                        {
                        data: 'id',
                        name: 'id'
                        },
                        {
                        data: 'city.city',
                        name: 'city'
                        },
                        {
                        data: 'thana',
                        name: 'thana'
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

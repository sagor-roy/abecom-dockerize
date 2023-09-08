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
                            All Stores
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">
                                    Add
                                </button>

                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Stores</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('stores.add') }}" class="ajax-form"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Showroom Title</label>
                                                        <input type="text" class="form-control" name="title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <input type="number" class="form-control" name="position">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="list_wrapper">
                                                            <div class="row set-row">
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="showroom_name[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Hotline</label>
                                                                        <input type="text" class="form-control"
                                                                            name="hotline[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <input type="text" class="form-control"
                                                                            name="phone[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input type="text" class="form-control"
                                                                            name="address[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Map Link</label>
                                                                        <input type="text" class="form-control"
                                                                            name="map[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <br>
                                                                    <button class="btn btn-primary set_add_button"
                                                                        type="button">+</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">Close</button>
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
                                    <table class="table stores-datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Location</th>
                                                <th>Stores</th>
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
    $(document).ready(function () {
        var x = 0; //Initial field counter
        var list_maxField = 10; //Input fields increment limitation

        //Once add button is clicked
        $('.set_add_button').click(function () {
            //Check maximum number of input fields
            if (x < list_maxField) {
                x++; //Increment field counter
                var list_fieldHTML = `<div class="row set-row">
                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="showroom_name[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Hotline</label>
                                                                        <input type="text" class="form-control"
                                                                            name="hotline[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <input type="text" class="form-control"
                                                                            name="phone[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input type="text" class="form-control"
                                                                            name="address[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Map Link</label>
                                                                        <input type="text" class="form-control"
                                                                            name="map[]">
                                                                    </div>
                                                                </div>
                                          <div class="col-xs-1 col-sm-7 col-md-1">
                                                <a href="javascript:void(0);" class="set_remove_button btn btn-danger">-</a>
                                          </div>
                                    </div>`; //New input field html 
                $('.list_wrapper').append(list_fieldHTML); //Add field html
            }
        });


        //Once remove button is clicked
        $('.list_wrapper').on('click', '.set_remove_button', function () {
            $(this).closest('div.row.set-row').remove(); //Remove field html
            x--; //Decrement field counter
        });
    })


    $(function () {
        $('.stores-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('stores.data') }}",
            order: [
                [0, 'Asc']
            ],
            columns: [{
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'location',
                    name: 'location'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });

    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

</script>
@endsection

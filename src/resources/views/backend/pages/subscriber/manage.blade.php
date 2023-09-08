@extends('backend.template.layout')

@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!-- title row start -->
    <div class="row">

        @if( session()->has('success') )
        <div class="col-md-12 alert alert-success" style="margin-bottom: 15px">
            <p>{{ session()->get('success') }}</p>
        </div>
        @endif

        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            All subscriber
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#csv">
                                    Download CSV
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="csv" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Subscribers list in csv
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('subscribers.csv') }}" method="get">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Date From</label>
                                                        <input type="date" id="start_date_2" class="form-control"
                                                            required name="from" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date To</label>
                                                        <input type="date" id="end_date_2" class="form-control" required
                                                            name="to" required>
                                                    </div>
                                                    <script>
                                                        var today = new Date();
                                                        var dd = String(today.getDate()).padStart(2, '0');
                                                        var mm = String(today.getMonth() + 1).padStart(2,
                                                        '0'); //January is 0!
                                                        var yyyy = today.getFullYear();
                                                        today = yyyy + "-" + mm + "-" + dd;
                                                        document.getElementById('end_date_2').setAttribute("max", today)
                                                        document.getElementById('start_date_2').setAttribute("max",
                                                            today)
                                                        document.getElementById('end_date_2').onchange = (e) => {
                                                            document.getElementById('start_date_2').setAttribute(
                                                                "max", e.target.value)
                                                        }
                                                        document.getElementById('start_date_2').onchange = (e) => {
                                                            document.getElementById('end_date_2').setAttribute(
                                                                "max", e.target.value)
                                                        }

                                                    </script>
                                                    <div class="col-md-12" style="text-align: right">
                                                        <button class="btn btn-success" type="submit">Download</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Delete all
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to
                                                    delete all subscriber?</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('subscribers.delete.all') }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">yes</button>
                                                </form>
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">No</button>
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
                                    <table class="table subscriber-datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Emails</th>
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
    $(function () {
        $('.subscriber-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('subscribers.data') }}",
            order: [
                [0, 'desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'email',
                    name: 'email'
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

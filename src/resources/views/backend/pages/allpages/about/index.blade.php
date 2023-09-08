@extends('backend.template.layout')

@section('body-content')

<!-- ISO CERTIFIED BLOCK START-->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!-- title row start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            ISO Certified Block
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget11_tab1_content">
                            <!--begin::Widget 11-->
                            <div class="kt-widget11">
                                <div class="table-responsive">
                                    <table class="table about-datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title One</th>
                                                <th>Title Two</th>
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
<!-- ISO CERTIFIED BLOCK START-->

<!-- ABOUT BLOCK START-->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!-- title row start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            About Us Block Section
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <button type="button" data-content="{{ route('about.block.add.modal') }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
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
                                    <table class="table about-block-datatable datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Block</th>
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
<!-- ABOUT BLOCK END-->


<!-- ABOUT CERTIFICATE START-->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!-- title row start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            About Us Certificate Section
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" data-content="{{ route('about.certificate.add.modal') }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
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
                                    <table class="table about-certificate-datatable datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>image</th>
                                                <th>Link</th>
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
<!-- ABOUT CERTIFICATE END-->

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
        $('.about-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('about.data') }}",
            order: [
                [0, 'Asc']
            ],
            columns: [{
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'title_one',
                    name: 'title_one'
                },

                {
                    data: 'title_two',
                    name: 'title_two'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });

        $('.about-block-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('about.block.data') }}",
            order: [
                [0, 'Asc']
            ],
            columns: [{
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });

        $('.about-certificate-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('about.certificate.data') }}",
            order: [
                [0, 'Desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'link',
                    name: 'link'
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

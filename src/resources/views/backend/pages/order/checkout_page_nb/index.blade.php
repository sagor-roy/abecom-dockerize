@extends('backend.template.layout')

@section('per_page_css')

<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
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
                            Checkout Page NB
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">

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
                                    <form action="{{ route('checkout.page.nb.update', ['id' => encrypt($checkout_page_nb->id)]) }}" class="ajax-form" method="post" >
                                        @csrf
                                        <div class="form-group">
                                              <label>Checkout Page NB</label>
                                              <textarea class="form-control" id="checkout_page_nb" name="checkout_page_nb" >{{ $checkout_page_nb->checkout_page_nb }}</textarea>
                                        </div>
                                        <div class="form-group">
                                              <button type="submit" class="btn btn-primary">Update Information</button>
                                        </div>
                                    </form>
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



<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>

<script>
    
    var editor2 = new RichTextEditor("#checkout_page_nb");

</script>

@endsection

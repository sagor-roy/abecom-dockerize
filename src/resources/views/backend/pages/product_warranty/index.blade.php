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
                                Product Warranty
                            </h3>
                        </div>

                    </div>

                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if( session('success') )
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ session('success') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @endif
                            <div class="tab-pane active" id="kt_widget11_tab1_content">
                                <!--begin::Product Warranty-->
                                <div class="kt-widget11">
                                    <form action="{{ route('product.warranty.update', ['id' => encrypt($product_warranty->id)]) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>Product Warranty</label>
                                                <textarea name="product_warranty" id="product_warranty" rows="3"
                                                    class="form-control">{{ $product_warranty->product_warranty }}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Product Warranty-->
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

<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />

@section('per_page_js')
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

<script>
    var product_warranty = new RichTextEditor("#product_warranty");
</script>

@endsection

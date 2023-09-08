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
                                All Counting
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
                            @if( session()->has('success') )
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ session()->has('success') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @endif
                            <div class="tab-pane active" id="kt_widget11_tab1_content">
                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <form action="{{ route('count.edit') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Home page left category count</label>
                                                <input type="number" class="form-control" name="left_category"
                                                    value="{{ App\Models\Counting::first()->left_category }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Home page slider category count</label>
                                                <input type="number" class="form-control" name="slider_category"
                                                    value="{{ App\Models\Counting::first()->slider_category }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Home page offer</label>
                                                <input type="number" class="form-control" name="home_offer"
                                                    value="{{ App\Models\Counting::first()->home_offer }}">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="hidden" name="id"
                                                    value="{{ App\Models\Counting::first()->id }}">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
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

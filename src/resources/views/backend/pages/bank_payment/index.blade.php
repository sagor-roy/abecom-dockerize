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
                                          Bank Payment
                                    </h3>
                              </div>
                        </div>

                        <div class="kt-portlet__body">

                            <form action="{{ route('bank_payment.update') }}" class="ajax-form" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label> Description</label>
                                    <textarea class="form-control" id="div_editor1" name="description">{{ $bank_payment ? $bank_payment->description : '' }}</textarea>
                                </div>

                                <button class="btn btn-success">Update</button>
                            </form>

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
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>

<script>
    new RichTextEditor("#div_editor1");
</script>

@endsection

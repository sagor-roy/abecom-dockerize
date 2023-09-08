<!--begin::Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->



<!--begin:: Global Mandatory Vendors -->
<link href="{{ asset('backend/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
{{-- <link href="{{ asset('backend/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/quill/dist/quill.snow.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/@yaireo/tagify/dist/tagify.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/dual-listbox/dist/dual-listbox.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ asset('backend/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ asset('backend/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Styles(used by all pages) -->

<link href="{{ asset('backend/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles -->

<!--begin::Layout Skins(used by all pages) -->

<link href="{{ asset('backend/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />        <!--end::Layout Skins -->

<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<!-- custom css -->
<link rel="stylesheet" href="{{ asset('backend/dist/css/custom.css') }}">


@yield('per_page_css')
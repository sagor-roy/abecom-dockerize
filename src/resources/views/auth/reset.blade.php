<!DOCTYPE html>
<!--
   Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
   Author: KeenThemes
   Website: http://www.keenthemes.com/
   Contact: support@keenthemes.com
   Follow: www.twitter.com/keenthemes
   Dribbble: www.dribbble.com/keenthemes
   Like: www.facebook.com/keenthemes
   Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
   Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
   License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
   -->
<html lang="en" >
   <!-- begin::Head -->
   <head>
      <!--begin::Base Path (base relative path for assets of this page) -->
      <base href="../../../../">
      <!--end::Base Path -->
      <meta charset="utf-8"/>
      <title>AB Electronics</title>
      <meta name="description" content="Login page example">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('frontend/assets/img/fav.png') }}">
      <!--begin::Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
      <!--end::Fonts -->
      <!--begin::Page Custom Styles(used by this page) -->
      <link href="{{ asset('backend/css/demo1/pages/login/login-4.css') }}" rel="stylesheet" type="text/css" />
      <!--end::Page Custom Styles -->
      <!--begin:: Global Mandatory Vendors -->
{{-- <link href="{{ asset('backend/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" /> --}}
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
{{-- <link href="{{ asset('backend/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('backend/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<!--end:: Global Optional Vendors -->
      <!--begin::Global Theme Styles(used by all pages) -->
      <link href="{{ asset('backend/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
      <!--end::Global Theme Styles -->
      <!--begin::Layout Skins(used by all pages) -->
      <link href="{{ asset('backend/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('backend/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('backend/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('backend/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
      <!--end::Layout Skins -->
   </head>
   <!-- end::Head -->
   <!-- begin::Body -->
   <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >
      <!-- begin:: Page -->
      <div class="kt-grid kt-grid--ver kt-grid--root">
         <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor auth-banner" style="background-image: url({{ asset('backend/images/order_email_banner.jpg') }});">
               <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper auth-box">
                  <div class="kt-login__container">
                     <div class="kt-login__logo">
                        <a href="#">
                        <img src="{{ asset('images/contact/'.App\Models\ContactDetail::first()->logo) }}" width="300px">  	
                        </a>
                     </div>
                     <div class="kt-login__signin">
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
                        <div class="alert alert-success">
                           {{ session()->get('success') }}
                        </div>
                        @endif
                        @if( session()->has('failed') )
                        <div class="alert alert-danger">
                           {{ session()->get('failed') }}
                        </div>
                        @endif
                        <div class="kt-login__head">
                           <h3 class="kt-login__title">Reset your password</h3>
                        </div>
                        <form class="kt-form" action="{{ route('password.reset',$email) }}" method="post">
                           @csrf
                           <div class="input-group">
                            <input type="email" readonly class="form-control @error('email') is-valid @enderror" placeholder="Email Address" name="email" value="{{ $email }}">
                           </div>
                           <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                           </div>
                           <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                           </div>
                           <div class="kt-login__actions">
                              <button id="kt_login_signin_submit" type="submit" class="btn btn-brand btn-pill kt-login__btn-primary">Reset Password</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end:: Page -->
      <!-- begin::Global Config(global config for global JS sciprts) -->
      <script>
         var KTAppOptions = {"colors":{"state":{"brand":"#5d78ff","dark":"#282a3c","light":"#ffffff","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
      </script>
      <!-- end::Global Config -->
      <!--begin:: Global Mandatory Vendors -->
      <script src="{{ asset('backend/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
      {{-- <script src="{{ asset('backend/vendors/general/popper.js') }}/dist/umd/popper.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/tooltip.js') }}/dist/umd/tooltip.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script> --}}
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
{{-- <script src="{{ asset('backend/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/bootstrap-timepicker.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/bootstrap-switch.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/typeahead.js') }}/dist/typeahead.bundle.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/dropzone.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/quill/dist/quill.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/@yaireo/tagify/dist/tagify.polyfills.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/@yaireo/tagify/dist/tagify.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/bootstrap-markdown.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/bootstrap-notify.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/dual-listbox/dist/dual-listbox.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/morris.js') }}/morris.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/chart.js') }}/dist/Chart.bundle.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script> --}}
<!--end:: Global Optional Vendors -->
      <!--begin::Global Theme Bundle(used by all pages) -->
      <script src="./assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
      <!--end::Global Theme Bundle -->
      <!--begin::Page Scripts(used by this page) -->
      <script src="./assets/js/demo1/pages/login/login-general.js') }}" type="text/javascript"></script>
      <!--end::Page Scripts -->
   </body>
   <!-- end::Body -->
</html>
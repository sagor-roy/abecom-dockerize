<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
  var KTAppOptions = {"colors":{"state":{"brand":"#5d78ff","dark":"#282a3c","light":"#ffffff","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>
<!-- end::Global Config -->
<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('backend/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->
<!--begin:: Global Optional Vendors -->

<!--end:: Global Optional Vendors -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('backend/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!-- sweet alert start -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- multiple choosen start -->
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>


<!-- custom js -->
<script src="{{ asset('backend/dist/js/custom.js') }}"></script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

@yield('per_page_js')
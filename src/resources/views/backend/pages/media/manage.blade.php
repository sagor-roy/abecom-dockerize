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
                                          All Social Media
                                    </h3>
                              </div>
                              <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                          <li class="nav-item">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#exampleModal">
                                                      Add
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Social Media</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('media.add') }}" class="ajax-form" method="post" enctype="multipart/form-data" >
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <select name="icon" class="form-control" id="chosen">
                                                                                          <option value="fa-behance">&#xf1b4; fa-behance</option>
                                                                                          <option value="fa-behance-square">&#xf1b5; fa-behance-square</option>
                                                                                          <option value="fa-facebook">&#xf09a; fa-facebook</option>
                                                                                          <option value="fa-facebook-f">&#xf09a; fa-facebook-f</option>
                                                                                          <option value="fa-facebook-official">&#xf230; fa-facebook-official</option>
                                                                                          <option value="fa-facebook-square">&#xf082; fa-facebook-square</option>
                                                                                          <option value='fa-linkedin'>&#xf0e1; fa-linkedin</option>
		                                                                              <option value='fa-linkedin-square'>&#xf08c; fa-linkedin-square</option>
                                                                                          <option value="fa-flickr">&#xf16e; fa-flickr</option>
                                                                                          <option value="fa-git">&#xf1d3; fa-git</option>
                                                                                          <option value="fa-git-square">&#xf1d2; fa-git-square</option>
                                                                                          <option value="fa-github">&#xf09b; fa-github</option>
                                                                                          <option value="fa-github-alt">&#xf113; fa-github-alt</option>
                                                                                          <option value="fa-github-square">&#xf092; fa-github-square</option>
                                                                                          <option value="fa-google">&#xf1a0; fa-google</option>
                                                                                          <option value="fa-google-plus">&#xf0d5; fa-google-plus</option>
                                                                                          <option value="fa-google-plus-square">&#xf0d4; fa-google-plus-square</option>
                                                                                          <option value="fa-google-wallet">&#xf1ee; fa-google-wallet</option>
                                                                                          <option value="fa-instagram">&#xf16d; fa-instagram</option>
                                                                                          <option value="fa-joomla">&#xf1aa; fa-joomla</option>
                                                                                          <option value="fa-jpy">&#xf157; fa-jpy</option>
                                                                                          <option value="fa-linkedin">&#xf0e1; fa-linkedin</option>
                                                                                          <option value="fa-linkedin-square">&#xf08c; fa-linkedin-square</option>
                                                                                          <option value="fa-paypal">&#xf1ed; fa-paypal</option>
                                                                                          <option value="fa-pinterest">&#xf0d2; fa-pinterest</option>
                                                                                          <option value="fa-pinterest-p">&#xf231; fa-pinterest-p</option>
                                                                                          <option value="fa-pinterest-square">&#xf0d3; fa-pinterest-square</option>
                                                                                          <option value='fa-twitter'>&#xf099; fa-twitter</option>
		                                                                              <option value='fa-twitter-square'>&#xf081; fa-twitter-square</option>
                                                                                          <option value='fa-youtube'>&#xf167; fa-youtube</option>
                                                                                          <option value='fa-youtube-play'>&#xf16a; fa-youtube-play</option>
                                                                                          <option value='fa-youtube-square'>&#xf166; fa-youtube-square</option>
                                                                                    </select>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Link</label>
                                                                                    <input type="text" class="form-control" name="link">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                                              </div>
                                                                        </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
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
                                                      <table class="table media-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>ID</th>
                                                                        <th>Icon</th>
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
<!-- end:: Content -->
@endsection

@section('per_page_js')

<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<script>
      $("#chosen").chosen()
</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>


      $(function() {
            $('.media-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('media.data') }}",
                  columns: [
                        {
                        data: 'id',
                        name: 'id'
                        },
                        {
                        data: 'icon',
                        name: 'icon'
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

      
      $('#image').change(function(){
          
          let reader = new FileReader();
          reader.onload = (e) => { 
          $('#image_preview_container').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });

      

</script>
@endsection
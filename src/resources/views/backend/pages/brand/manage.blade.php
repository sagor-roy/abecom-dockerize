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
                                          All Brand
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
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <form action="{{ route('brand.add') }}" class="ajax-form" method="post" enctype="multipart/form-data" >
                                                                              @csrf
                                                                              <div class="form-group">
                                                                                    <label>Brand Name</label>
                                                                                    <input type="text" class="form-control" name="name">
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Brand Position</label>
                                                                                    <input type="number" class="form-control" name="position" >
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Select Category</label>
                                                                                    <select name="categories[]" class="form-control chosen2" multiple >
                                                                                          @foreach( \App\Models\Category::orderBy('id','desc')->get() as $category  )
                                                                                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                                          @endforeach
                                                                                    </select>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Select Sub Category</label>
                                                                                    <select name="sub_categories[]" class="form-control chosen2" multiple >
                                                                                          @foreach( \App\Models\SubCategory::orderBy('id','desc')->get() as $subcategory  )
                                                                                          <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                                                          @endforeach
                                                                                    </select>
                                                                              </div>
                                                                              <div class="form-group" id="banner_block">
                                                                                    <div class="varient_wrapper">
                                                                                          <div class="row varient-row">
                                                                                          <div class="col-md-5">
                                                                                                <div class="form-group">
                                                                                                      <label>Brand Banner ( Width: 1150px, Height :
                                                                                                      400px )*</label> <br>
                                                                                                      <input type="file"
                                                                                                      class="form-control-file image"
                                                                                                      name="banner_image[0]">
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-md-5">
                                                                                                <div class="form-group">
                                                                                                      <label>Position*</label>
                                                                                                      <input type="number" class="form-control"
                                                                                                      name="banner_position[0]">
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-md-2">
                                                                                                <br>
                                                                                                <button class="btn btn-primary add_banner"
                                                                                                      type="button">+</button>
                                                                                          </div>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                    <label>Brand Image ( Max 50KB, Width: 200, Height : 150px )</label> <br>
                                                                                    <img src="{{ asset('backend/images/thumbnail.png') }}" id="image_preview_container" class="default-thhumbnail" width="100px" alt=""> 
                                                                                    <br><br>
                                                                                    <input type="file" class="form-control-file" name="image" id="image"> 
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
                                                      <table class="table brand-datatable" id="datatable">
                                                            <thead>
                                                                  <tr>
                                                                        <th>Position</th>
                                                                        <th>Brand</th>
                                                                        <th>Category</th>
                                                                        <th>Sub Category</th>
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

<script>
      $(".chosen").chosen()
      $("#chosen").chosen()
      $(".chosen2").chosen()
      $("#chosen2").chosen()
      $(".chosen3").chosen()
</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
      $(function() {
            $('.brand-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('brand.data') }}",
                  order: [[0,'Desc']],
                  columns: [
                        {
                        data: 'position',
                        name: 'position'
                        },
                        {
                        data: 'brand',
                        name: 'brand'
                        },
                        {
                        data: 'category',
                        name: 'category'
                        },
                        {
                        data: 'subcategory',
                        name: 'subcategory'
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

      $('#image3').change(function(){
          
          let reader = new FileReader();
          reader.onload = (e) => { 
          $('#image_preview_container3').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
      
      });

      $(".add_banner").click(function () {
        let varient = `<div class="row varient-row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                        <label>Brand Banner ( Width: 1150px, Height :
                                                                            400px
                                                                            )* </label> <br>
                                                                        <input type="file" class="form-control-file image"
                                                                            name="banner_image[]" >
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Position*</label>
                                            <input type="number" class="form-control" name="banner_position[]">
                                        </div>
                                    </div>
                                  <div class="col-md-2">
                                    <br>
                                    <a href="javascript:void(0);" class="remove_banner_button btn btn-danger">-</a>
                                  </div>
                            </div>`;
        $("#banner_block .varient_wrapper").append(varient)
    })

    //Once remove button is clicked
    $('#banner_block .varient_wrapper').on('click', '.remove_banner_button', function () {
        $(this).closest('div.row.varient-row').remove();
    });
      

</script>
@endsection
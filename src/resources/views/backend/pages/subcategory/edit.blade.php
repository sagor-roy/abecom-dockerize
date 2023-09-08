@extends('backend.template.layout')

@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="row">
        <div class="col-md-12">
            @if( session()->has('update') )
            <div class="alert alert-success">
                {{ session()->get('update') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    <!-- title row start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit Sub Category
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget11_tab1_content">
                            <!--begin::Widget 11-->
                            <div class="kt-widget11">
                                <div class="row product-section">
                                    <!-- left part start -->
                                    <div class="col-md-3">
                                        <div class="left">
                                            <ul>
                                                <li class="product-step active-product" id="cat-1">Basic Information
                                                </li>
                                                <li class="product-step" id="cat-2">Subcategory Banner</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- left part end -->

                                    <!-- right part start -->
                                    <div class="col-md-9">

                                        <p>Total product in this Subcategory : {{ $subcategory->product->count() }}</p>
                                        <div class="row product-step-filter cat-1">
                                            <div class="col-md-12">
                                                <form action="{{ route('subcategory.update', $subcategory->id) }}"
                                                    class="ajax-form" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Subcategory Name</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $subcategory->name }}" name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Select Category</label>
                                                        <select name="category_id" class="form-control " id="chosen">
                                                            @foreach( \App\Models\Category::orderBy('id','desc')->get()
                                                            as
                                                            $category )
                                                            <option value="{{ $category->id }}" @if( $subcategory->
                                                                category_id == $category->id ) selected @endif
                                                                >{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Subcategory Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1" @if( $subcategory->is_active == true )
                                                                selected @endif >Active</option>
                                                            <option value="0" @if( $subcategory->is_active == false )
                                                                selected @endif >Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="row product-step-filter cat-2 hide-product">
                                                <div class="col-md-12 table-responsive">
                                                      <!-- Button trigger modal -->
                                                      <button type="button" style="margin-bottom: 15px" class="btn btn-primary" data-toggle="modal" data-target="#addbanner">
                                                            Add
                                                      </button>
                                                      
                                                      <!-- Modal -->
                                                      <div class="modal fade" id="addbanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                              <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                              <form action="{{ route('subcat.banner.add', $subcategory->id) }}" method="post" class="ajax-form">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                          <label>Subcategory Banner ( Width: 1150px, Height :
                                                                                          400px
                                                                                          ) </label> <br>
                                                                                          <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                                                          class="default-thhumbnail image_preview_container" width="100px"
                                                                                          alt="">
                                                                                          <br><br>
                                                                                          <input type="file" class="form-control-file image"
                                                                                          name="image" >
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                          <label>Position</label>
                                                                                          <input type="number" class="form-control" name="position">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                          <button type="submit" class="btn btn-outline-dark">Add</button>
                                                                                    </div>
                                                                              </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>

                                                      <table class="table subcategory-banner datatable" >
                                                            <thead>
                                                                  <tr>
                                                                        <th>Position</th>
                                                                        <th>Image</th>
                                                                        <th>Action</th>
                                                                  </tr>
                                                            </thead>	
                                                      </table>
                                                </div>
                                        </div>

                                    </div>
                                    <!-- right part end -->
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

<!-- yajra start -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- yajra end -->


<script>
    $(".chosen").chosen()
    $("#chosen").chosen()
    $(".chosen2").chosen()
    $("#chosen2").chosen()
    $(".chosen3").chosen()

</script>

<script>
    //category attribute start
    $(function () {
          $('.subcategory-banner').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('subcat.banner.data', $subcategory->id) }}",
              columns: [{
                      data: 'position',
                      name: 'position'
                  },
                  {
                      data: 'image',
                      name: 'image'
                  },
                  {
                      data: 'action',
                      name: 'action',
                      orderable: false,
                  },
              ]
          });
    });
    //category attribute end

    $('.image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('.image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $(document).ready(function () {
        $(".product-section ul .product-step").click(function () {
            let product = $(this).attr('id')

            if (product != 'all') {
                $(".product-section ul li").removeClass('active-product')
                $(this).addClass('active-product')
                $(".product-section .product-step-filter").addClass('hide-product');
                $("." + product).removeClass('hide-product');
            }
        })
    })


</script>
@endsection

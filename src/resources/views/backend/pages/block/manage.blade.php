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
                            All Home Page Block
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('block.add') }}" class="ajax-form" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Block Name</label>
                                                        <input type="text" class="form-control" name="name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>position</label>
                                                        <input type="number" class="form-control" name="position">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>How many category show?</label>
                                                        <input type="number" class="form-control" name="per_category">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>How many brand show?</label>
                                                        <input type="number" class="form-control" name="per_brand">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>How many product show?</label>
                                                        <input type="number" class="form-control" name="per_product">
                                                    </div>
                                                    


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="radio" class="form-control-check" name="select_thumbnail" placeholder="Select Thumbnail Product" value="1">
                                                            <label for="select_thumbnail">Block Thumbnail Product</label>
                                                            <div class="form-group" id="thumbnail_product">
                                                                <select name="product" class="form-control chosen"
                                                                        >
                                                                        @foreach (\App\Models\Product::orderBy('id', 'desc')->where('is_active', true)->get() as $product)
                                                                            <option value="{{ $product->id }}">
                                                                                {{ $product->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <input type="radio" class="form-control-check" name="select_thumbnail" placeholder="Select Thumbnail Image" value="2" checked>
                                                            <label for="select_thumbnail">Block Thumbnail Image( Max 50 Kb, Width: 360px, Height
                                                                : 550px )</label>
                                                            <div class="form-group">
                                                                <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                                    id="image_preview_container" class="default-thhumbnail"
                                                                    width="100px" alt="">
                                                                <br><br>
                                                                <input type="file" class="form-control-file" name="thumbnail_image"
                                                                    id="image">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <input type="radio" class="form-control-check" name="select_thumbnail" placeholder="Only show products" value="3" >
                                                            <label for="select_thumbnail">Only Show Products</label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Block Small Image( Max 50 Kb, Width: 800px, Height :
                                                            600px
                                                            )</label> 
                                                        <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                            id="image_preview_container2" class="default-thhumbnail"
                                                            width="100px" alt="">
                                                        <br><br>
                                                        <input type="file" class="form-control-file" name="small_image"
                                                            id="image2">
                                                    </div>

                                                    <div class="form-group" id="thumbnail_product">
                                                        <label>Choose Category</label>
                                                        <select name="categories[]" class="form-control chosen"
                                                        multiple
                                                        >
                                                                @foreach (\App\Models\Category::orderBy('id', 'desc')->where('is_active', true)->get() as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="form-group" id="thumbnail_product">
                                                        <label>Choose brands</label>
                                                        <select name="brands[]" class="form-control chosen"
                                                                 multiple>
                                                                @foreach (\App\Models\Brand::orderBy('id', 'desc')->where('is_active', true)->get() as $brand)
                                                                    <option value="{{ $brand->id }}">
                                                                        {{ $brand->name }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Choose block color</label>
                                                        <input type="text" id="demo" class="demo form-control" name="color" value="#ff6161">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">Close</button>
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
                                    <table class="table pblock-datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Block Info</th>
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
<link rel="stylesheet" href="{{ asset('backend/dist/css/jquery.minicolors.css') }}">
<script src="{{ asset('backend/dist/js/jquery.minicolors.js') }}"></script>

<script>
    $("#thumbnail_image").hide();
    $(".chosen").chosen()
    $('.demo').minicolors();

</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(function () {
        $('.pblock-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('block.data') }}",
            columns: [{
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'block_info',
                    name: 'block_info'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });

    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#image2').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });




    $("#cash_discount").hide();
    $("#is_cash").click(function (e) {
        if (e.target.checked == true) {
            $("#cash_discount").show();
            $("#percentage").hide();
        } else {
            $("#cash_discount").hide();
            $("#percentage").show();
        }
    })

</script>
@endsection

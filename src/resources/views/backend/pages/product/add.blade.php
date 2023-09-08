@extends('backend.template.layout')

<style>
    .attribute-block {
        display: none;
    }

</style>

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
                            Add new product
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="row product-section">
                            <!-- left part start -->
                            <div class="col-md-3">
                                <div class="left">
                                    <ul>
                                        <li class="product-step active-product" id="product-1">Basic information</li>
                                        <li class="product-step" id="product-2">Description</li>
                                        <li class="product-step" id="product-3">Details</li>
                                        <li class="product-step" id="product-4">Feature Image</li>
                                        <li class="product-step" id="product-5">Product Gallery</li>
                                        <li class="product-step" id="product-6">Attribute</li>
                                        <li class="product-step" id="product-7">Varients</li>
                                        <li class="product-step" id="product-8">Product Status</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- left part end -->

                            <!-- right part start -->
                            <div class="col-md-9">
                                <form action="{{ route('product.add') }}" method="post" class="product-form"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row product-step-filter product-1">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Name (required)</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Short Description (required)</label>
                                                <textarea class="form-control" id="div_editor1"
                                                    name="short_description">
                                                                        </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-2 hide-product">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Description (required)</label>
                                                <textarea class="form-control" id="div_editor2" name="description">
                                                                        </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Specification (required)</label>
                                                <textarea class="form-control" id="div_editor3" name="specification">
                                                                        </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-3 hide-product">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Category (required)</label>
                                                <select name="category_id" class="form-control chosen2">
                                                    <option>Select Category</option>
                                                    @foreach(
                                                    \App\Models\Category::orderBy('id','desc')->where('is_active',
                                                    true)->get() as $category )
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Sub Category (required)</label>
                                                <select name="sub_cat_id" class="form-control ">

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Brand (required)</label>
                                                <select name="brand_id" class="form-control chosen2">
                                                    @foreach( \App\Models\Brand::orderBy('id','desc')->get() as $brand )
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Regular Price (required)</label>
                                                <input type="number" class="form-control" name="price">
                                            </div>
                                            <div class="form-group">
                                                <label>Select Delivery Charges</label>
                                                <select name="delivery_charge_id" class="form-control">
                                                    @foreach( App\Models\DeliveryCharge::where('is_active', true)->get()
                                                    as $delivery_charge )
                                                    <option value="{{ $delivery_charge->id }}">
                                                        {{ $delivery_charge->size }} ( {{ $delivery_charge->amount }}
                                                        BDT )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Product Offer</label>
                                                <select class="form-control" name="offer_id">
                                                    <option value="0">No offer in this product</option>
                                                    @foreach( App\Models\Offer::where("status", true)->get()  as $offer )
                                                        <option value="{{  $offer->id }}">{{  $offer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-4 hide-product">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Thumbnail Image ( Height: 600px, Width: 600px )
                                                        (required)</label> <br>
                                                    <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                        id="image_preview_container" class="default-thhumbnail"
                                                        width="100px" alt="">
                                                    <br><br>
                                                    <input type="file" class="form-control-file" name="thumbnail"
                                                        id="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-5 hide-product">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Multiple Image</label>
                                                    <div class="input-images" style="cursor: pointer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-6 hide-product">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="varient_wrapper">
                                                    <div class="row varient-row">
                                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                                            <div class="form-group">
                                                                <label>Attribute name* (required)</label>
                                                                <select name="varients[]" class="form-control">
                                                                    @foreach(
                                                                    App\Models\Varient::orderBy('id','desc')->get() as
                                                                    $varient)
                                                                    <option value="{{ $varient->id }}">
                                                                        {{ $varient->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-7 col-sm-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>Value* (required)</label>
                                                                <select name="varient_value[]" class="form-control">
                                                                    @foreach( App\Models\Category::where('is_active',
                                                                    true)->get() as $category )
                                                                    @if( $category->category_varient->count() > 0 )
                                                                    <option disabled>----{{ $category->name }}</option>
                                                                    @foreach( $category->category_varient as
                                                                    $cat_varient)
                                                                    <option value="{{ $cat_varient->id }}">
                                                                        {{ $cat_varient->value }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-1 col-sm-1 col-md-1">
                                                            <br>
                                                            <button class="btn btn-primary add_varient"
                                                                type="button">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row product-step-filter product-7 hide-product">
                                        <!-- product attribute have -->
                                        <div class="col-md-12 product-attr-check">
                                            <p style="margin-bottom: 0">Product Varient have? </p>
                                            <input type="checkbox" style="margin: 15px 0" value="1" name="true_false">
                                            Yes/No
                                        </div>
                                        <!-- product attribute have end-->

                                        <div class="col-md-12 product-quantity">
                                            <div class="form-group">
                                                <label>Quantity (required)</label>
                                                <input type="number" class="form-control" name="quantity">
                                            </div>
                                        </div>

                                        <div class="col-md-12 attribute-block">
                                            <div class="form-group">
                                                <div class="list_wrapper">
                                                    <div class="row set-row">
                                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                                            <div class="form-group">
                                                                <label>Varient name (required)</label>
                                                                <select name="attributes[]" class="form-control">
                                                                    @foreach(
                                                                    App\Models\Attribute::orderBy('id','desc')->get() as
                                                                    $attribute )
                                                                    <option value="{{ $attribute->id }}">
                                                                        {{ $attribute->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <div class="form-group">
                                                                <label>Value (required)</label>
                                                                <input autocomplete="off" name="value[]" type="text"
                                                                    placeholder="Ex. Red" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                                            <div class="form-group">
                                                                <label>Quantity (required)</label>
                                                                <input autocomplete="off" name="qty[]" type="number"
                                                                    placeholder="Type set quantity"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-1 col-sm-1 col-md-1">
                                                            <br>
                                                            <button class="btn btn-primary set_add_button"
                                                                type="button">+</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row product-step-filter product-8 hide-product">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Is featured?</label>
                                                <select name="is_featured" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Is onsale?</label>
                                                <select name="is_onsale" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Is top rated?</label>
                                                <select name="is_top_rated" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-dark product-add-btn">Add
                                                    Product</button>
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <small style="color: red" class="validinfo">Something went wrong .
                                                    please give valid information</small>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- right part end -->
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

    $(".chosen").chosen()
    $("#chosen").chosen()
    $(".chosen2").chosen()
    $("#chosen2").chosen()
    $(".chosen3").chosen()

    $(".product-attr-check input[type=checkbox]").click(function (e) {
        if (e.target.checked == true) {
            $(".product-quantity").hide();
            $(".attribute-block").show();
            $("input[name=qty]").val('')
        } else {
            $(".product-quantity").show();
            $(".attribute-block").hide();
        }
    })

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".product-form").submit(function (e) {
            console.log('a')
            e.preventDefault()
            $(".spinner-border").show();
            $(".product-add-btn").hide();

            let $this = $(this);
            let formData = new FormData(this);

            $this.find(".has-danger").removeClass('has-error');
            $this.find(".form-errors").remove();

            $.ajax({
                type: $this.attr('method'),
                url: $this.attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $(".spinner-border").hide()
                    $(".product-add-btn").show();

                    if (response.product_url) {
                        swal("", "Product Added Successfully. Redirecting Please Wait",
                            "success")
                        return window.location.href = response.product_url
                    }

                },
                error: function (response) {
                    $(".spinner-border").hide()
                    $(".product-add-btn").show();

                    let data = JSON.parse(response.responseText);
                    if (data.errors) {
                        swal("", "You did not fill up required fields properly!", "error")
                    }
                    $.each(data.errors, (key, value) => {

                        $("[name^=" + key + "]").parent().addClass('has-error')
                        $("[name^=" + key + "]").parent().append(
                            '<small class="danger text-muted form-errors">' +
                            value[0] + '</small>');
                    })

                }
            })
        })


    })

</script>

<link rel="stylesheet" href="{{ asset('backend/dist/css/image-uploader.min.css') }}">
<script src="{{ asset('backend/dist/js/image-uploader.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>


<script>
    var editor1 = new RichTextEditor("#div_editor1");
    var editor2 = new RichTextEditor("#div_editor2");
    var editor3 = new RichTextEditor("#div_editor3");

    $(document).ready(function () {
        var x = 0; //Initial field counter
        var list_maxField = 10; //Input fields increment limitation

        //Once add button is clicked
        $('.set_add_button').click(function () {
            //Check maximum number of input fields
            if (x < list_maxField) {
                x++; //Increment field counter
                var list_fieldHTML = `<div class="row set-row">
                                          <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                      <label>Varient name*</label>
                                                      <select name="attributes[]" class="form-control">
                                                            @foreach( App\Models\Attribute::orderBy('id','desc')->get() as $attribute )
                                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                            @endforeach
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                      <label>Value*</label>
                                                      <input autocomplete="off" name="value[]" type="text" placeholder="Ex. Red" class="form-control"/>
                                                </div>
                                          </div>
                                          <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                      <label>Quantity*</label>
                                                      <input autocomplete="off" name="qty[]" type="number" placeholder="Type set quantity" class="form-control"/>
                                                </div>
                                          </div>
                                          <div class="col-xs-1 col-sm-7 col-md-1">
                                                <a href="javascript:void(0);" class="set_remove_button btn btn-danger">-</a>
                                          </div>
                                    </div>`; //New input field html
                $('.list_wrapper').append(list_fieldHTML); //Add field html
            }
        });


        //Once remove button is clicked
        $('.list_wrapper').on('click', '.set_remove_button', function () {
            $(this).closest('div.row.set-row').remove(); //Remove field html
            x--; //Decrement field counter
        });


        //varient
        $(".add_varient").click(function () {
            let varient = `<div class="row varient-row">
                              <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                          <label>Attribute name* (required)</label>
                                          <select name="varients[]" class="form-control">
                                                @foreach( App\Models\Varient::orderBy('id','desc')->get() as $varient)
                                                <option value="{{ $varient->id }}">{{ $varient->name }}</option>
                                                @endforeach
                                          </select>
                                    </div>
                              </div>
                              <div class="col-xs-7 col-sm-7 col-md-7">
                                    <select name="varient_value[]" class="form-control">
                                          @foreach( App\Models\Category::where('is_active', true)->get() as $category )
                                          @if( $category->category_varient->count() > 0 )
                                          <option disabled>----{{ $category->name }}</option>
                                                @foreach( $category->category_varient as $cat_varient)
                                                <option value="{{ $cat_varient->id }}">{{ $cat_varient->value }}</option>
                                                @endforeach
                                          @endif
                                          @endforeach

                                    </select>
                              </div>
                              <div class="col-xs-1 col-sm-1 col-md-1">
                              <br>
                              <a href="javascript:void(0);" class="remove_varient_button btn btn-danger">-</a>
                              </div>
                        </div>`;
            $(".varient_wrapper").append(varient)
        })

        //Once remove button is clicked
        $('.varient_wrapper').on('click', '.remove_varient_button', function () {
            $(this).closest('div.row.varient-row').remove();
        });
    });



    $('.input-images').imageUploader();






    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

</script>
@endsection

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

    <!-- edit product part start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit product
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('images/product/'. $product->thumbnail) }}" width="100px" alt="">
                            @foreach( $product->product_image as $single_image )
                            <img src="{{ asset('images/product/'. $single_image->image) }}" width="100px" alt="">
                            @endforeach
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Name : {{ $product->name }} </p>
                                    <p>Category : {{ $product->category->name }} </p>
                                    <p>Sub category : {{ $product->sub_category->name }} </p>
                                    <p>Brand : {{ $product->brand->name }} </p>
                                    <p>Attributes :

                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>Price : {{ $product->price }}</p>
                                    <p>Offer Price : {{ $product->offer_price ? $product->offer_price : 'N/A' }}</p>
                                    <p>Is featured : {{ $product->is_featured ? 'Yes' : 'No' }}</p>
                                    <p>Is on sale : {{ $product->is_onsale ? 'Yes' : 'No' }}</p>
                                    <p>Is top rated : {{ $product->is_top_rated ? 'Yes' : 'No' }}</p>
                                    <p>Status : {{ $product->is_active ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-section">
                        <!-- left part start -->
                        <div class="col-md-3">
                            <div class="left">
                                <ul>
                                    <li class="product-step active-product" id="product-1">Basic information</li>
                                    <li class="product-step" id="product-2">Descriptions</li>
                                    <li class="product-step" id="product-3">Thumbnail</li>
                                    <li class="product-step" id="product-4">Details</li>
                                    <li class="product-step" id="product-5">Product Status</li>
                                </ul>
                            </div>
                        </div>
                        <!-- left part end -->

                        <!-- right part start -->
                        <div class="col-md-9">
                            <form action="{{ route('product.edit.basic', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row product-step-filter product-1">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $product->name }}">
                                        </div>
                                        @if( $product->qty != null )
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="quantity"
                                                value="{{ $product->qty }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="add_varient" class="form-control-check mt-1"
                                                name="add_varient" value="1">
                                            <label for="add_varient">Do you want to add product varient?</label>
                                        </div>
                                        <div class="form-group row extra-product-attr">
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
                                                                placeholder="Type set quantity" class="form-control" />
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
                                        @endif
                                        <div class="form-group">
                                            <label>Product Short Description (required)</label>
                                            <textarea class="form-control" id="div_editor1" name="short_description">
                                                                            {{ $product->short_description }}
                                                                        </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row product-step-filter product-2 hide-product">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Description (required)</label>
                                            <textarea class="form-control" id="div_editor2" name="description">
                                                                        {{ $product->description }}
                                                                    </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Specification (required)</label>
                                            <textarea class="form-control" id="div_editor3" name="specification">
                                                                        {{ $product->specification }}
                                                                    </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row product-step-filter product-3 hide-product">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Thumbnail Image ( Width: 600px, Height: 600px )</label> <br>
                                            <img src="{{ asset('images/product/'. $product->thumbnail) }}"
                                                id="image_preview_container" class="default-thhumbnail" width="100px"
                                                alt="">
                                            <br><br>
                                            <input type="file" class="form-control-file" name="thumbnail" id="image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row product-step-filter product-4 hide-product">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control chosen2">
                                                @foreach( \App\Models\Category::orderBy('id','desc')->where('is_active', true)->get() as $category
                                                )
                                                <option value="{{ $category->id }}" @if( $category->id ==
                                                    $product->category->id )
                                                    selected
                                                    @endif
                                                    >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <select name="sub_cat_id" class="form-control">
                                                @foreach( \App\Models\SubCategory::orderBy('id','desc')->get() as
                                                $sub_category )
                                                <option value="{{ $sub_category->id }}" @if( $sub_category->id ==
                                                    $product->sub_category->id )
                                                    selected
                                                    @endif
                                                    >{{ $sub_category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand_id" class="form-control chosen2">
                                                @foreach( \App\Models\Brand::orderBy('id','desc')->get() as $brand )
                                                <option value="{{ $brand->id }}" @if( $brand->id == $product->brand->id
                                                    )
                                                    selected
                                                    @endif
                                                    >{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" name="price"
                                                value="{{ $product->price }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Delivery Charges</label>
                                            <select name="delivery_charge_id" class="form-control">
                                                @foreach( App\Models\DeliveryCharge::where('is_active', true)->get() as
                                                $delivery_charge )
                                                <option value="{{ $delivery_charge->id }}" @if( $delivery_charge->id ==
                                                    $product->delivery_charge_id ) selected @endif
                                                    >{{ $delivery_charge->size }} ( {{ $delivery_charge->amount }} BDT )
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Product Offer</label>
                                            <select class="form-control" name="offer_id">
                                                <option value="0">No offer in this product</option>
                                                @foreach( App\Models\Offer::where("status", true)->get()  as $offer )
                                                    <option value="{{  $offer->id }}"@if($product->offer_id == $offer->id) selected @endif>{{  $offer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row product-step-filter product-5 hide-product">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Is featured?</label>
                                            <select name="is_featured" class="form-control">
                                                <option value="1" @if( $product->is_featured == true ) selected @endif
                                                    >Yes</option>
                                                <option value="0" @if( $product->is_featured == false ) selected @endif
                                                    >No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Is onsale?</label>
                                            <select name="is_onsale" class="form-control">
                                                <option value="1" @if( $product->is_onsale == true ) selected @endif
                                                    >Yes</option>
                                                <option value="0" @if( $product->is_onsale == false ) selected @endif
                                                    >No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Is top rated?</label>
                                            <select name="is_top_rated" class="form-control">
                                                <option value="1" @if( $product->is_top_rated == true ) selected @endif
                                                    >Yes</option>
                                                <option value="0" @if( $product->is_top_rated == false ) selected @endif
                                                    >No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1" @if( $product->is_active == true ) selected @endif
                                                    >Active</option>
                                                <option value="0" @if( $product->is_active == false ) selected @endif
                                                    >Inactive</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="text-align: right">
                                            <button type="submit" class="btn btn-outline-dark">Update Product</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- right part end -->
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Application Sales-->
        </div>
    </div>
    <!-- edit product part end -->


    <!-- edit product attribute, image, varient start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit product images, attributes and varients
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="row product-section">
                        <!-- left part start -->
                        <div class="col-md-3">
                            <div class="left">
                                <ul>
                                    <li class="product-step-2 active-product" id="detail-1">Product Images</li>
                                    @if( $product->qty == null )
                                    <li class="product-step-2" id="detail-2">Product Varient</li>
                                    @endif
                                    <li class="product-step-2" id="detail-3">Product Attribute</li>
                                </ul>
                            </div>
                        </div>
                        <!-- left part end -->

                        <!-- right part start -->
                        <div class="col-md-9">

                            <!-- product images tab start -->
                            <div class="row product-step-filter-2 detail-1">
                                <div class="col-md-12 tab-content table-responsive tab-1">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" style="margin: 15px 0"
                                        data-toggle="modal" data-target="#add_image">
                                        Add Image
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="add_image" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Product Image
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('add.product.image', $product->id) }}"
                                                        class="ajax-form" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Product Image</label> <br>
                                                            <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                                id="image_preview_container2" class="default-thhumbnail"
                                                                width="100px" alt="">
                                                            <br><br>
                                                            <input type="file" class="form-control-file" name="image"
                                                                id="image2">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table product-images" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- product images tab end -->

                            <!-- product varient tab start -->
                            <div class="row product-step-filter-2 detail-2 hide-product">
                                <div class="col-md-12 table-responsive">
                                    <!-- Button trigger modal -->
                                    <button type="button" style="margin-bottom: 15px" class="btn btn-primary"
                                        data-toggle="modal" data-target="#addProductAttribute">
                                        Add
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="addProductAttribute" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Varient</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('add.product.attribute', $product->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Varient</label>
                                                            <select name="attribute_id" class="form-control">
                                                                @foreach(
                                                                App\Models\Attribute::orderBy('id','desc')->get() as
                                                                $attribute )
                                                                <option value="{{ $attribute->id }}">
                                                                    {{ $attribute->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Value</label>
                                                            <input type="text" class="form-control" name="value">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="number" class="form-control" name="qty">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="btn btn-outline-dark">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Varient</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $product->product_attribute as $key => $product_attribute )
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $product_attribute->attribute->name }}</td>
                                                <td>{{ $product_attribute->value }}</td>
                                                <td>{{ $product_attribute->qty }}</td>
                                                <td>
                                                    @if( $product_attribute->is_active == true )
                                                    <p class="badge badge-success">Active</p>
                                                    @else
                                                    <p class="badge badge-danger">Inactive</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit_product_attribute{{ $product_attribute->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="edit_product_attribute{{ $product_attribute->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Varient</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('update.product.attribute', $product_attribute->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label>Value</label>
                                                                            <input type="text" class="form-control"
                                                                                name="value"
                                                                                value="{{ $product_attribute->value }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Quantity</label>
                                                                            <input type="number" class="form-control"
                                                                                name="qty"
                                                                                value="{{ $product_attribute->qty }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select name="is_active"
                                                                                class="form-control">
                                                                                <option value="1" @if(
                                                                                    $product_attribute->is_active ==
                                                                                    true ) selected @endif >Active
                                                                                </option>
                                                                                <option value="0" @if(
                                                                                    $product_attribute->is_active ==
                                                                                    false ) selected @endif >Inctive
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-outline-dark">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- product varient tab end -->

                            <!-- product attribute start tab start -->
                            <div class="row product-step-filter-2 detail-3 hide-product">
                                <div class="col-md-12 table-responsive">
                                    <!-- Button trigger modal -->
                                    <button type="button" style="margin-bottom: 15px" class="btn btn-primary"
                                        data-toggle="modal" data-target="#addProductVarient">
                                        Add
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="addProductVarient" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Attribute</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('add.product.varient', $product->id) }}"
                                                        class="ajax-form" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Attribute name* (required)</label>
                                                            <select name="varients" class="form-control">
                                                                @foreach(
                                                                App\Models\Varient::orderBy('id','desc')->get() as
                                                                $varient)
                                                                <option value="{{ $varient->id }}">{{ $varient->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Value* (required)</label>
                                                            <select name="varient_value" class="form-control">
                                                                @foreach( App\Models\Category::where('is_active',
                                                                true)->where('id', $product->category_id)->get() as
                                                                $category )
                                                                @if( $category->category_varient->count() > 0 )
                                                                <option disabled>----{{ $category->name }}</option>
                                                                @foreach( $category->category_varient as $cat_varient)
                                                                <option value="{{ $cat_varient->id }}">
                                                                    {{ $cat_varient->value }}</option>
                                                                @endforeach
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{ $product->category_id }}"
                                                                name="category_id">
                                                            <button type="submit"
                                                                class="btn btn-outline-dark">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table product-varient-value" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Attribute</th>
                                                <th>Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- product attribute start tab end -->


                        </div>
                        <!-- right part end -->
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Application Sales-->
        </div>
    </div>
    <!-- edit product attribute, image, varient end -->



</div>
<!-- end:: Content -->
@endsection



@section('per_page_js')




<script>
    $(".chosen").chosen()
    $("#chosen").chosen()
    $(".chosen2").chosen()
    $("#chosen2").chosen()
    $("#chosen3").chosen()
    $(".chosen3").chosen()
    $(".chosen4").chosen()

    $("#add_varient").click(function (e) {
        if (e.target.checked == true) {
            $(".extra-product-attr").css({
                "display": "flex"
            })
        } else {
            $(".extra-product-attr").hide()
        }
    })

    $('#image2').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });
    $(document).ready(function () {
        jQuery('select[name="category_id"]').on('change', function () {
            var cat_id = jQuery(this).val()

            console.log(cat_id)

            if (cat_id) {
                $.ajax({
                    url: 'category_dependent/' + cat_id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data) {
                        $('select[name="sub_cat_id"]').empty();
                        $.each(data, function (key, value) {

                            $('select[name="sub_cat_id"]').append(
                                '<option value="' + value.id +
                                '"  id="menu_price" >' + value.name +
                                '</option>');
                        })
                    }
                })
            }
        })
    })

</script>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>


<!-- yajra start -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- yajra end -->

<script>
    $(function () {
        $('.product-varient-value').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.varient.val.data', $product->id) }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'varient_id',
                    name: 'varient_id'
                },
                {
                    data: 'category_varient_id',
                    name: 'category_varient_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });

    $(function () {
        $('.product-images').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.image.data', $product->id) }}",
            columns: [{
                    data: 'id',
                    name: 'id'
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
                                                                <label>Varient name (required)</label>
                                                                <select name="attributes[]" class="form-control">
                                                                        @foreach( App\Models\Attribute::orderBy('id','desc')->get() as $attribute )
                                                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <div class="form-group">
                                                                <label>Value (required)</label>
                                                                <input autocomplete="off" name="value[]" type="text" placeholder="Ex. Red" class="form-control"/>
                                                            </div>
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                                            <div class="form-group">
                                                                <label>Quantity (required)</label>
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



    $(document).ready(function () {
        $('.datatable').DataTable();
    });



    $(document).ready(function () {
        $(".product-section ul .product-step").click(function () {
            let product = $(this).attr('id')

            if (product != 'all') {
                $(".product-section ul .product-step").removeClass('active-product')
                $(this).addClass('active-product')
                $(".product-section .product-step-filter").addClass('hide-product');
                $("." + product).removeClass('hide-product');
            }
        })
    })

    $(document).ready(function () {
        $(".product-section ul .product-step-2").click(function () {
            let product = $(this).attr('id')

            if (product != 'all') {
                $(".product-section ul .product-step-2").removeClass('active-product')
                $(this).addClass('active-product')
                $(".product-section .product-step-filter-2").addClass('hide-product');
                $("." + product).removeClass('hide-product');
            }
        })
    })


    //Once remove button is clicked
    $('.varient_wrapper').on('click', '.remove_varient_button', function () {
        $(this).closest('div.row.varient-row').remove();
    });

</script>

<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>

<script>
    var editor1 = new RichTextEditor("#div_editor1");
    var editor1 = new RichTextEditor("#div_editor2");
    var editor1 = new RichTextEditor("#div_editor3");

</script>
@endsection

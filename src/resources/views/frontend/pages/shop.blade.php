@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - All Product</title>
@endsection

@section('css')
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/contact/'.App\Models\ContactDetail::first()->fav) }}">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome-5.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="{{ asset('frontend/assets/vendor/font-awesome/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-electro.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/vendor/animate.css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl-carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
@endsection
<style>
    /* This line can be removed it was just for display on CodePen: */

    .slider-labels {
        margin-top: 10px;
    }



    /* Functional styling;
* These styles are required for noUiSlider to function.
* You don't need to change these rules to apply your design.
*/
    .noUi-target,
    .noUi-target * {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -ms-touch-action: none;
        touch-action: none;
        -ms-user-select: none;
        -moz-user-select: none;
        user-select: none;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .noUi-target {
        position: relative;
        direction: ltr;
    }

    .noUi-base {
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1;
        /* Fix 401 */
    }

    .noUi-origin {
        position: absolute;
        right: 0;
        top: 0;
        left: 0;
        bottom: 0;
    }

    .noUi-handle {
        position: relative;
        z-index: 1;
    }

    .noUi-stacking .noUi-handle {
        /* This class is applied to the lower origin when
its values is > 50%. */
        z-index: 10;
    }

    .noUi-state-tap .noUi-origin {
        -webkit-transition: left 0.3s, top .3s;
        transition: left 0.3s, top .3s;
    }

    .noUi-state-drag * {
        cursor: inherit !important;
    }

    /* Painting and performance;
* Browsers can paint handles in their own layer.
*/
    .noUi-base,
    .noUi-handle {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    /* Slider size and handle placement;
*/
    .noUi-horizontal {
        height: 4px;
    }

    .noUi-horizontal .noUi-handle {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        left: -7px;
        top: -7px;
        background-color: #ae0000;
    }

    /* Styling;
*/
    .noUi-background {
        background: #D6D7D9;
    }

    .noUi-connect {
        background: #031b4e;
        -webkit-transition: background 450ms;
        transition: background 450ms;
    }

    .noUi-origin {
        border-radius: 2px;
    }

    .noUi-target {
        border-radius: 2px;
    }

    .noUi-target.noUi-connect {}

    /* Handles and cursors;
*/
    .noUi-draggable {
        cursor: w-resize;
    }

    .noUi-vertical .noUi-draggable {
        cursor: n-resize;
    }

    .noUi-handle {
        cursor: default;
        -webkit-box-sizing: content-box !important;
        -moz-box-sizing: content-box !important;
        box-sizing: content-box !important;
    }

    .noUi-handle:active {
        border: 8px solid #345DBB;
        border: 8px solid rgba(53, 93, 187, 0.38);
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        left: -14px;
        top: -14px;
    }

    /* Disabled state;
*/
    [disabled].noUi-connect,
    [disabled] .noUi-connect {
        background: #B8B8B8;
    }

    [disabled].noUi-origin,
    [disabled] .noUi-handle {
        cursor: not-allowed;
    }

    .product-row {
        margin-top: 2px!important;
        padding: 0 15px;
    }
    .banner-carousel .item img {
        border-radius:  5px!important;
    }


    #product-row .right .left ul li{
        display: inline;
        font-size: 25px;
        color: #c5c5c5;
        cursor: pointer;
        font-size: 30px;
    }
    .active-th{
        color: #031b4e!important;
    }
    @media (min-width: 320px) and (max-width: 500px){
        .product-row {
            padding-right: 0!important;
        }
        .banner-carousel .item img {
            height: 150px !important;
        }
    }



</style>

@section('body-content')

<!-- Slider & Banner Section -->
<div class="mb-4">
    <div class="container overflow-hidden">
        <div class="row">

            <!-- left part mob start-->
            <div class="col-12 banner-left for-mob">
                <div class="overflow-hidden banner">
                    <div class="left">
                        <p> <i class="fas fa-bars"></i> All CATEGORIES</p>
                        <ul>
                            <li>
                                <a href="">
                                    <i class="fas fa-home"></i>
                                    Home
                                </a>
                            </li>

                            @foreach ($categories
                            as $category)
                            @if( $category->subcategory->count() > 0 )
                            <li id="{{ $category->id }}">

                                <i class="{{ $category->icon }}"></i>
                                {{ $category->name }}
                                <i class="fas fa-angle-down"></i>

                                <!-- subcategory dropdown start -->
                                <div class="category-dropdown {{ $category->id }}">
                                    <ul>
                                        @foreach ($category->subcategory->where("is_active", true) as $sub_cat)
                                        <li>
                                            <a
                                                href="{{ route('subcategory', $sub_cat->slug) }}">{{ $sub_cat->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- subcategory dropdown end -->

                            </li>
                            @endif
                            @endforeach
                            <li>
                                <a href="#go-category">
                                    <i class="fas fa-plus"></i>
                                    More
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- left part mob end-->

        </div>
    </div>
</div>
<!-- End Slider & Banner Section -->


<!-- page indicator start -->
<section class="page-indicator">
    <div class="container">
        <div class="row">
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                    <i class="fas fa-angle-right"></i>
                </li>
                <li>
                    <a href="{{ route('shop',) }}">
                        Shop
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->


<!-- shop banner start -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="banner-carousel owl-carousel owl-theme">
                        @foreach( App\Models\AllBanner::orderBy("position","asc")->where("type","Shop")->get() as $shop_banner )
                        <div class="item">
                            <div class="col-md-12 shop-left">
                                <img src="{{ asset('images/allbanner/'.$shop_banner->image) }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop banner end -->

<!-- slide category start -->
<section class="slide-category">
    <div class="container">

        <div class="row">
            <div class="category-carousel owl-carousel owl-theme">

                <!-- item start -->
                @foreach ( $categories as $category )
                <div class="item">
                    <a href="{{ route('category', $category->slug) }}">
                        <div class="col-md-12">
                            <div class="img-background">
                                <img src="{{ asset('images/category/' . $category->image) }}" alt="">
                            </div>
                            <p class="text-center">{{ Str::limit($category->name, 15, '...') }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
                <!-- item end -->

            </div>
        </div>
    </div>
</section>
<!-- slide category end -->

<!-- category product start -->
<section class="category-product">
    <div class="container">

        <!-- pagination row start -->
        <div class="row" style="    margin-bottom: 15px;">

            <!-- left start -->
            <div class="col-md-2">
                <div class="left">
                    <h2></h2>
                </div>
            </div>
            <!-- left end -->



        </div>
        <!-- pagination row end -->

        <div class="row">

            <!-- left part start -->
            <div class="col-md-3 full-col" style="padding:0;border: 1px solid #e0dfdf;">
                <div class="left cat-left">

                    <div class="title">
                        <h2>
                            <i class="fas fa-filter"></i>
                            <span>
                                Filter Products
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </h2>
                    </div>

                    <div class="category-filter-block">

                        <div class="price-range">
                            <div class="container">
                                <div class="row">
                                     <div class="col-md-12">
                                        <p style="margin-bottom: 10px;font-weight:bold">Price</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="row slider-labels">
                                    <div class="col-md-6 col-6 caption text-right">
                                        <strong>৳</strong> <span id="slider-range-value1"
                                            style="border: 1px solid #fbfbfb;padding: 0px 10px;"></span>
                                    </div>
                                    <div class="col-md-6 col-6 text-left caption">
                                        <strong>৳</strong> <span id="slider-range-value2"
                                            style="border: 1px solid #fbfbfb;padding: 0px 10px;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form>
                                            <input type="hidden" name="min-value" value="">
                                            <input type="hidden" name="max-value" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div>
                                <input type="number" value="1" min="1" class="min-value">
                                <input type="number" value="1" min="1" class="max-value">
                                <input type="hidden" id="cat_id" value="{{ $category->id }}">

                            <div class="form-group">
                                <button onclick="priceFilter()" class="filter-button" style="position: relative">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div> Filter
                                </button>
                                <small class="failed"></small>

                            </div>
                        </div> --}}
                    </div>


                    <!-- category start -->
                    <div class="manufacturer" id="category">
                        <h2>Category</h2>
                        <ul>
                            @foreach( $categories as $category )
                            @if( $category->product->where("is_active", true)->count() > 0 )
                            <li id="{{ $category->id }}">
                                {{ $category->name }}
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <!--  category end -->

                    <!-- sub category start -->
                    <div class="manufacturer" id="subcategory">
                        <h2>Sub Category</h2>
                        <ul>
                            @foreach( $subcategories as $subcategory )
                            @if( $subcategory->product->where("is_active", true)->count() > 0 )
                            <li id="{{ $subcategory->id }}">
                                {{ $subcategory->name }}
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- sub category end -->

                    <!-- brands start -->
                    <div class="manufacturer" id="brand">
                        <h2>Brands</h2>
                        <ul>
                            @foreach( $brands as $brand )
                            @if( $brand->product->where("is_active", true)->count() > 0 )
                            <li id="{{ $brand->id }}">
                                {{ $brand->name }}
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- brands end -->

                </div>
            </div>
        </div>
        <!-- left part end -->


        <!-- right part start -->
        <div class="col-md-9 full-col" id="product-row">
            <div class="right">


                <!-- toolbar start -->
                <div class="row" style="margin-top: 5px;">
                    <div class="col-md-12">
                        <div class="left">
                            <ul>
                                <li class="active-th" data-id="th-large">
                                    <i class="fas fa-th-large"></i>
                                </li>
                                <li data-id="th-list">
                                    <i class="fas fa-th-list"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- toolbar end -->


                <!-- product row start -->
                <div class="row product-row">

                    <div class="col-md-12 no-product-found">

                    </div>

                    @foreach( $products as $product )
                    <div class="col-md-3 col-6">
                        <div class="product-box">
                            <a href="{{ route('productdetails', $product->slug) }}">
                                <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid"
                                    alt="">
                            </a>
                            <p class="product_name">{{ Str::limit($product->name, 45) }}</p>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    @if ($product->offer_price == null)
                                    <p class="offer_price" style="text-align: left">
                                        ৳{{ $product->price }}
                                    </p>
                                    @else
                                    <p class="regular_price">
                                        ৳{{ $product->price }}
                                    </p>
                                    @endif
                                </div>
                                <div class="col-md-6 col-6">
                                    @if ($product->offer_price != null)
                                    <p class="offer_price">
                                        ৳{{ $product->offer_price }}
                                    </p>
                                    @endif
                                </div>
                            </div>


                            <!-- product info start -->
                            <!-- <div class="product-info">
                                <div class="row">
                                    <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                        <p onclick="addToWishlist({{ $product->id }})" data-toggle="tooltip"
                                            data-placement="bottom" title="Wishlist">
                                            <i class="fas fa-heart"></i>
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                        <p onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                                            data-placement="bottom" title="Compare">
                                            <i class="fas fa-balance-scale"></i>
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <p data-toggle="tooltip" data-placement="bottom" title="Cart">
                                            <a href="{{ route('productdetails', $product->slug) }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- product info end -->

                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- product row end -->



            </div>
        </div>
        <!-- right part end -->

    </div>

        <!-- toolbar start -->
        <div class="row" style="margin-top: 15px;">
            <!-- right start -->
            <div class="col-md-12 right-pagination-div">
                <div class="right right-pagination">
                    <ul class="pagination">
                        {{ $products->onEachSide(3)->links() }}
                    </ul>
                </div>
            </div>
            <!-- right end -->
        </div>
        <!-- toolbar end -->
    </div>
</se                ct                ion>
<!-- category product end -->


<!-- featured, on sale, top rated start -->
<secti    on class="type-wise-filter-product">
    <div class="container">

        <!-- top row start -->
        <div class="row top-row">
            <div class="col-md-12">
                <ul>
                    <li class="select-type active-offer" id="featured">
                        Featured
                    </li>
                    <li class="select-type" id="onsale">
                        On Sale
                    </li>
                    <li class="select-type" id="toprated">
                        Top Rated
                    </li>
                </ul>
            </div>
        </div>
        <!-- top row end -->


        <!-- type wise product row start -->
        <div class="row type-wise-row">

            <!-- item start -->
            @foreach (App\Models\Product::orderBy('id', 'desc')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get()
            as $product)
            <div class="col-md-2 col-6" style="padding: 0">
                <div class="product-box">
                    <a href="{{ route('productdetails', $product->slug) }}">
                        <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid" alt="">
                    </a>
                    <a class="product_name">{{ Str::limit($product->name, 45, '...') }}</a>
                    <div class="row">
                        <div class="col-md-6 col-6">
                            @if ($product->offer_price == null)
                            <p class="offer_price" style="text-align: left">
                                ৳{{ $product->price }}
                            </p>
                            @else
                            <p class="regular_price">
                                ৳{{ $product->price }}
                            </p>
                            @endif
                        </div>
                        <div class="col-md-6 col-6">
                            @if ($product->offer_price != null)
                            <p class="offer_price">
                                ৳{{ $product->offer_price }}
                            </p>
                            @endif
                        </div>
                    </div>


                    <!-- product info start -->
                    <!-- <div class="product-info">
                        <div class="row">
                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                <p onclick="addToWishlist({{ $product->id }})" data-toggle="tooltip"
                                    data-placement="bottom" title="Wishlist">
                                    <i class="fas fa-heart"></i>
                                </p>
                            </div>
                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                <p onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                                    data-placement="bottom" title="Compare">
                                    <i class="fas fa-balance-scale"></i>
                                </p>
                            </div>
                            <div class="col-md-4 col-4">
                                <p data-toggle="tooltip" data-placement="bottom" title="Cart">
                                    <a href="{{ route('productdetails', $product->slug) }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div> -->
                    <!-- product info end -->

                </div>
            </div>
            @endforeach
            <!-- item start -->

        </div>
        <!-- type wise product row end -->


    </div>
</section>
<!-- featured, on sale, top rated end -->

@endsection

@section('per_page_js')
<script src="{{ asset('frontend/assets/js/jquery_ui.js') }}"></script>

<script>

    //th filter
    $("#product-row .right .left ul li").click(function(){
        $(".loader").show()

        const $this = $(this)
        const value = $this.attr("data-id")

        $("#product-row .right .left ul li").removeClass("active-th")
        $this.addClass("active-th")

        const min_value = $("#slider-range-value1").html()
        const max_value = $("#slider-range-value2").html()
        let brand;
        let subcat;
        let cat;

        //category check
        if( $("#category ul .active-cat").attr("id") ){
            cat = $("#category ul .active-cat").attr("id")
        }
        else{
            cat = null
        }

        //sub category check
        if( $("#sub_cat ul .active-sub-cat").attr("id") ){
            subcat = $("#sub_cat ul .active-sub-cat").attr("id")
        }
        else{
            subcat = null
        }

        //brand check
        if( $("#brand ul .active-brand").attr("id") ){
            brand = $("#brand ul .active-brand").attr("id")
        }
        else{
            brand = null
        }


        if( value ){
            $.ajax({
                type: "GET",
                url: "{{ route('shop.th') }}",
                data: {
                    cat : cat,
                    subcat : subcat,
                    brand : brand,
                    min_value : min_value,
                    max_value : max_value,
                    value : value,
                },
                success: function(response) {
                    $(".loader").hide()
                    if( response.large ){
                        $(".product-row .col-6").remove()
                        $(".product-row .col-12").remove()
                        $.each(response.large, (key, value) => {
                            $(".product-row").append(`
                            <div class="col-md-3 col-6">
                                <div class="product-box">
                                    <a href="${value.product_detail}">
                                        <img src="${value.image}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <p class="product_name">${value.name}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="offer_price" style="text-align: left">
                                                ৳${value.price}
                                            </p>
                                        </div>
                                    </div>


                                    <!-- product info start
                                    <div class="product-info">
                                        <div class="row">
                                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToCompare(${value.id})"  data-to ggle="tooltip" data-placement="bottom"  title="Compare">
                                                    <i class="fas fa-balance-scale"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                    <a href="${value.product_detail}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    product info end -->

                                </div>
                            </div>`)
                        })
                    }
                    else if( response.list ){
                        $(".product-row .col-6").remove()
                        $(".product-row .col-12").remove()
                        $.each( response.list , (key, value) => {
                            $(".product-row").append(`
                            <div class="col-md-6 col-12 product-div" style="padding: 0;">
                                <div class="product-box">
                                    <div class="row">
                                        <div class="col-md-4 col-4">
                                            <a href="${value.product_detail}">
                                                    <img src="${value.image}" class="img-fluid"
                                                        alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <p style="font-weight: unset " class="product_name_2">${value.name_2}</p>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <p class="offer_price" style="text-align: left">
                                                        ৳${value.offer_price}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- product info start
                                            <div class="product-info">
                                                <div class="row">
                                                    <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                        <p onclick="addToWishlist(${value.id})" data-toggle="tooltip"
                                                            data-placement="bottom" title="Wishlist">
                                                            <i class="fas fa-heart"></i>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                         <p onclick="addToCompare(${value.id})" data-toggle="tooltip"
                                                            data-placement="bottom" title="Compare">
                                                            <i class="fas fa-balance-scale"></i>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-4">
                                                        <p data-toggle="tooltip" data-placement="bottom" title="Cart">
                                                            <a href="${value.product_detail}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            product info end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                        })
                    }

                },
                error: function(response) {
                    $(".loader").hide()
                }
            })
        }
        else{
            swal("","Something went wrong","error")
        }
    })

    let min_value = $("#slider-range-value1").html()
    let max_value = $("#slider-range-value2").html()

    $(document).on('update','#slider-range-value2', function(){
        console.log("Hi")
    })

    //price filter
    $(".price-range").on('click', '.noUi-origin', function () {
        let min_value = $("#slider-range-value1").html()
        let max_value = $("#slider-range-value2").html()

        $(".loader").show()

        if (min_value < 0 || max_value < 0) {
            $(".loader").hide()
            swal("", "Price cann't be negative", "error")

        } else if (min_value && min_value) {
            $.ajax({
                type: "GET",
                url: "price/min/" + min_value + "/max/" + max_value,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $(".loader").hide()


                    if (response.products.data.length > 0) {
                        $(".product-row .no-product-found").hide()

                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()

                        $.each(response.products.data, (key, value) => {
                            $(".product-row").append(`
                        <div class="col-md-3 col-6">
                            <div class="product-box">
                                <a href="${value.product_detail}">
                                    <img src="${value.image}"
                                        class="img-fluid" alt="">
                                </a>
                                <p>${value.name}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="offer_price" style="text-align: left">
                                            ${value.price}
                                        </p>
                                    </div>
                                </div>


                                <!-- product info start
                                <div class="product-info">
                                        <div class="row">
                                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                    <i class="fas fa-balance-scale"></i>
                                                 </p>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                    <a href="${value.product_detail}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                product info end -->

                            </div>
                        </div>`)
                        })
                    } else {
                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()
                        $(".product-row .no-product-found").show()
                        $(".product-row .no-product-found").html(
                            'No product found in your search result')
                    }


                },
                error: function (response) {
                    $(".loader").hide()

                }
            })
        } else {
            $(".loader").hide()
            swal("", "Price field is required!", "error")
        }
    })


    //category filter start
    $("#category ul li").click(function () {
        let id = $(this).attr('id')
        $(".loader").show()

        const $this = $(this)
        $("#category ul li").removeClass("active-cat")
        $("#sub_cat ul li").removeClass("active-sub-cat")
        $("#brand ul li").removeClass("active-brand")
        $this.addClass("active-cat")


        $(".manufacturer ul li").css({
            'background': 'unset',
            'color' : 'unset'
        })
        $(this).css({
            'background': '#031b4e',
            'color' : 'white'
        })

        if (id && id > 0) {
            $.ajax({
                type: "GET",
                url: "shop/category/" + id,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $(".loader").hide()

                    $("#subcategory ul li").remove()
                    $.each(response.subcategories, function(key, value){
                        $("#subcategory ul").append(`
                            <li id="${value.id}">
                                ${value.name}
                            </li>
                        `);
                    })

                    $("#brand ul li").remove()
                    $.each(response.brands, function(key, value){
                        $("#brand ul").append(`
                            <li id="${value.id}">
                                ${value.name}
                            </li>
                        `);
                    })


                    if (response.products.data) {
                        $(".product-row .no-product-found").hide()

                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()

                        $.each(response.products.data, (key, value) => {
                            $(".product-row").append(`
                        <div class="col-md-3 col-6">
                            <div class="product-box">
                                <a href="${value.product_detail}">
                                    <img src="${value.image}"
                                        class="img-fluid" alt="">
                                </a>
                                <p>${value.name}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="offer_price" style="text-align: left">
                                            ${value.price}
                                        </p>
                                    </div>
                                </div>


                                <!-- product info start
                                <div class="product-info">
                                        <div class="row">
                                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                    <i class="fas fa-balance-scale"></i>
                                                </p>
                                            </div>
                                             <div class="col-md-4 col-4">
                                                <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                    <a href="${value.product_detail}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                product info end -->

                            </div>
                        </div>`)
                        })
                    } else {
                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()
                        $(".product-row .no-product-found").show()
                        $(".product-row .no-product-found").html(
                            'No product found in your search result')
                    }


                },
                error: function (response) {
                    $(".loader").hide()

                }
            })
        } else {
            $(".loader").hide()
            swal("", "Invalid category", "error")
        }
    })


    //subcategory filter start
    $(document).on('click','#subcategory ul li', function(){
        let id = $(this).attr('id')
        $(".loader").show()

        const $this = $(this)
        $("#category ul li").removeClass("active-cat")
        $("#sub_cat ul li").removeClass("active-sub-cat")
        $("#brand ul li").removeClass("active-brand")
        $this.addClass("active-sub-cat")

        $(".manufacturer ul li").css({
            'background': 'unset',
            'color' : 'unset'
        })
        $(this).css({
            'background': '#031b4e',
            'color' : 'white'
        })

        if (id && id > 0) {
            $.ajax({
                type: "GET",
                url: "shop/subcategory/" + id,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $(".loader").hide()
                    if (response.products) {
                        $(".product-row .no-product-found").hide()

                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()

                        $.each(response.products, (key, value) => {
                            $(".product-row").append(`
                        <div class="col-md-3 col-6">
                            <div class="product-box">
                                <a href="${value.product_detail}">
                                    <img src="${value.image}"
                                        class="img-fluid" alt="">
                                </a>
                                <p>${value.name}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="offer_price" style="text-align: left">
                                            ${value.price}
                                        </p>
                                    </div>
                                </div>


                                <!-- product info start
                                <div class="product-info">
                                        <div class="row">
                                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                    <i class="fas fa-balance-scale"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                 <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                    <a href="${value.product_detail}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                product info end -->

                            </div>
                        </div>`)
                        })
                    } else {
                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()
                        $(".product-row .no-product-found").show()
                        $(".product-row .no-product-found").html(
                            'No product found in your search result')
                    }


                },
                error: function (response) {
                    $(".loader").hide()

                }
            })
        } else {
            $(".loader").hide()
            swal("", "Invalid sub category", "error")
        }
    })


    //brand filter start
    $("#brand ul li").click(function () {
        let id = $(this).attr('id')
        $(".loader").show()

        const $this = $(this)
        $("#category ul li").removeClass("active-cat")
        $("#sub_cat ul li").removeClass("active-sub-cat")
        $("#brand ul li").removeClass("active-brand")
        $this.addClass("active-brand")


        $(".manufacturer ul li").css({
            'background': 'unset',
            'color' : 'unset'
        })
        $(this).css({
            'background': '#031b4e',
            'color' : 'white'
        })

        if (id && id > 0) {
            $.ajax({
                type: "GET",
                url: "shop/brand/" + id,
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    $(".loader").hide()

                    if (response.products.data) {

                        $(".product-row .no-product-found").hide()

                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()

                        $.each(response.products.data, (key, value) => {
                            $(".product-row").append(`
                        <div class="col-md-3 col-6">
                            <div class="product-box">
                                <a href="${value.product_detail}">
                                    <img src="${value.image}"
                                        class="img-fluid" alt="">
                                </a>
                                <p>${value.name}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="offer_price" style="text-align: left">
                                            ${value.price}
                                        </p>
                                    </div>
                                </div>


                                <!-- product info start
                                <div class="product-info">
                                                                <div class="row">
                                            <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                                <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                    <i class="fas fa-balance-scale"></i>
                                                </p>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                     <a href="${value.product_detail}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                                product info end -->

                            </div>
                        </div>`)
                        })
                    } else {
                        $(".product-row .col-md-3.col-6").remove()
                        $(".product-row .col-12").remove()
                        $(".product-row .no-product-found").show()
                        $(".product-row .no-product-found").html(
                            'No product found in your search result')
                    }


                },
                error: function (response) {
                    $(".loader").hide()

                }
            })
        } else {
            $(".loader").hide()
            swal("", "Invalid sub category", "error")
        }
    })

    if( $(".relative.z-0.inline-flex.shadow-sm.rounded-md span[aria-current='page']").next() ){
        $(".relative.z-0.inline-flex.shadow-sm.rounded-md span[aria-current='page']").next().show()
    }
    if( $(".relative.z-0.inline-flex.shadow-sm.rounded-md span[aria-current='page']").prev() ){
        $(".relative.z-0.inline-flex.shadow-sm.rounded-md span[aria-current='page']").prev().show()
    }



</script>
@endsection

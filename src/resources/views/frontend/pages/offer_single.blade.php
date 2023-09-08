@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - {{ $offer->name }} Offer</title>
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


    .offer-filter {
        padding-bottom: 15px;
    }

    .offer-filter .row .col-md-12 {
        padding: 0;
    }

    .offer-filter .row .col-md-12 .form-control {
        border-radius: unset;
    }
    .offer_filter{
        cursor: pointer;
    }
    .offer-carousel .item{
      padding: 10px 0;
      transition: 0.4s ease-in-out;
      overflow: hidden;
    }
    .offer-carousel .item:hover .img-background{
        transform: scale(1.1);
        transition: 0.4s ease-in-out;
    }


    .offer-carousel .owl-dots{
        display: none;
    }
    .offer-carousel .item .col-md-12{
        border: 1px solid #e0dfdf;
        padding: 15px 10px;
        border-radius: 5px;
    }

    .offer-carousel .item .col-md-12 .img-background img{
        width: 50%;
        display: block;
        margin: 0 auto;
        transition: 0.4s ease-in-out;
    }
    .offer-carousel .owl-stage-outer{
        margin: 0px -1px;
    }

    .offer-banner .col-md-12{
        padding: 0;
    }
    .offer-banner img {
        height: 400px;
    }
    .filter_product{
        padding: 15px 0;
    }

    @media (min-width: 320px) and (max-width: 500px){
        .offer-banner img {
            height: 150px !important;
        }
        .offer-banner .col-md-12{
            padding: 0 15px;
        }
        .filter_product select{
            margin-bottom: 15px
        }
    }

     @media (min-width: 500px) and (max-width: 990px){
        .offer-banner img {
            height: 200px !important;
        }
    }

    @media (min-width: 990px) and (max-width: 1024px){
        .offer-banner img {
            height: 300px !important;
        }
    }

    @media (min-width: 576px) and (max-width: 1199px){
       .offer-product .product-row {
         border-right: none!important;
    }
    }

</style>

@section('body-content')

<!-- Slider & Banner Section -->
<div class="">
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

                            @foreach (App\Models\Category::orderBy('position', 'asc')
                            ->where('is_active', true)
                            ->take(App\Models\Counting::first()->left_category)
                            ->get()
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
                    <a href="{{ route('offer.single', $offer->id) }}">
                        {{ $offer->name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->


<!-- offer banner start -->
<section class="offer-banner" style="margin-bottom: 0px">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('images/offer/'.$offer->banner) }}" style="width: 100%;" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>
<!-- offer banner end -->




<!-- slide category start -->
<section class="slide-category">
    <div class="container">

        <div class="row">

        </div>

        <div class="row">

            <div class="col-md-10 col-12 filter_product" >

                <div class="row">

                    <div class="col-md-4">
                        <select name="category_id" id="category-select" class="form-control">
                            <option selected disabled>Select a category</option>
                            @foreach( $offer->category as $category )
                            <option value="{{ $category->id }}" data-id="{{ $offer->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4" >
                        <select name="" class="form-control" id="subcategory-select">
                            <option selected disabled>Select a subcategory</option>
                        </select>
                    </div>

                </div>


            </div>

        </div>
    </div>
</section>
<!-- slide category end -->


<!-- offer wise product start -->
<section class="offer-product">
    <div class="container">

        <!-- title part start -->
        <div class="row offer-product-title">
            <div class="col-md-12 offer-product-title-div">
                <div class="left" style="background : {{ $offer->color }}">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 style="color: #000000;">{{ $offer->name }}</h2>
                            @if($offer->percent)
                            <p>Upto {{ $offer->percent }}% discount</p>
                            @elseif($offer->cash_discount)
                            <p>Upto {{ $offer->cash_discount }} taka discount</p>
                            @endif
                        </div>
                        <div class="col-md-4 right" style="position: relative">
                            <ul>
                                <li>
                                    <p>Days</p>
                                    <span
                                        class="day">{{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($offer->end_date)) }}
                                    </span>
                                </li>
                                <li>
                                    <p>Hours</p>
                                    <span class="hour">{{ 24 - \Carbon\Carbon::now()->format('H') }} </span>
                                </li>
                                <li>
                                    <p>Mins</p>
                                    <span class="minute">{{ 60 - \Carbon\Carbon::now()->format('i') }}
                                    </span>
                                </li>
                                <li>
                                    <p>Secs</p>
                                    <span class="second">60 </span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- title part end -->



        <!-- product row start -->
        <div class="row product-row" style="margin-top: 0">

            @foreach( $products as $product )
            <div class="col-md-2 col-6">
                <div class="product-box">
                    <a href="{{ route('productdetails', $product->slug) }}">
                        <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid" alt="">
                    </a>
                    <p class="product_name" >{{ Str::limit($product->name, 45, '...') }}</p>
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

        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <div class="right">
                    <ul class="pagination">
                        {{ $products->onEachSide(3)->links() }}
                    </ul>
                </div>
            </div>
        </div>

    <!-- view all product end -->

    </div>
</section>

<!-- offer wise product end -->

@endsection

@section('per_page_js')
<script>
    setInterval(function () {
        let day = $(".day").html()
        let hour = $(".hour").html()
        let min = $(".minute").html()
        let sec = $(".second").html();
        let sixty = 60
        let new_min = 2

        if (day == 0 && min < 58) {
            $(".day").html(0)
            if (sec < 1) {
                if (min < 1) {
                    if (day != 0) {
                        day = day - 1
                    }
                    if (hour != 0) {
                        hour = hour - 1
                    }
                    $(".day").html(day)
                    $(".minute").html(new_min)
                    $(".second").html(sixty)
                } else {
                    min = min - 1
                    $(".minute").html(min)
                    $(".second").html(sixty)
                }

            }
            else {
                if (min < 1) {
                    if (day != 0) {
                        day = day - 1
                    }
                    if (hour != 0) {
                        hour = hour - 1
                    }
                    $(".day").html(day)
                    $(".minute").html(new_min)
                    $(".second").html(sixty)
                } else {
                    sec = sec - 1;
                    $(".second").html(sec)
                }
            }
        } else {
            if (sec < 1) {
                if (min < 1) {
                    if (day != 0) {
                        day = day - 1
                    }
                    if (hour != 0) {
                        hour = hour - 1
                    }
                    $(".day").html(day)
                    $(".minute").html(new_min)
                    $(".second").html(sixty)
                } else {
                    min = min - 1
                    $(".minute").html(min)
                    $(".second").html(sixty)
                }

            } else {
                if (min < 1) {
                    if (day != 0) {
                        day = day - 1
                    }
                    if (hour != 0) {
                        hour = hour - 1
                    }
                    $(".day").html(day)
                    $(".minute").html(new_min)
                    $(".second").html(sixty)
                } else {
                    sec = sec - 1;
                    $(".second").html(sec)
                }
            }
        }


    }, 1000)

    $(document).on('change','#category-select', function(){
        $(".loader").show();
        let $this = $(this);
        const cat_id = $("#category-select option:selected").val()
        const offer =  $("#category-select option:selected").data("id")

        if( cat_id && offer ){
            $.ajax({
                type: 'GET',
                url: "{{ route('offer.filter') }}",
                data: {
                    category_id : cat_id,
                    offer_id : offer
                },
                success: function (response) {
                    $(".loader").hide();
                    $(".product-row .col-6").remove()
                    $(".product-row .col-md-12").remove()

                    $("#subcategory-select option").remove();

                    $("#subcategory-select").append(`
                        <option selected disabled>Select a subcategory</option>
                    `)

                    $.each(response.sub_categories,(key, value) => {
                        $("#subcategory-select").append(`
                            <option value="${value.id}" data-id="{{ $offer->id }}">${value.name}</option>
                        `)
                    });

                    if( response.products.data.length == 0 ){
                        $(".product-row").append(`
                            <div class="col-md-12">
                                <p class="text-center mt-10">No products found</p>
                            </div>
                        `);
                    }
                    else{
                        $.each(response.products.data,(key, value) => {
                            $(".product-row").append(`
                                <div class="col-md-2 col-6">
                                    <div class="product-box">
                                        <a href="${value.product_detail}">
                                            <img src="${value.image}" class="img-fluid" alt="">
                                        </a>
                                        <p>${value.name}</p>
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <p class="regular_price" style="text-align: left">
                                                    ৳${value.price}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <p class="offer_price">
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
                            `);
                        });
                    }

                },
                error: function (response) {
                    $(".loader").hide();

                    data = response.responseJSON

                    $.each(data.errors, (key, value) => {

                        $("[name^=" + key + "]").parent().addClass('has-error')
                        $("[name^=" + key + "]").parent().append(
                            '<small class="danger text-muted form-errors">' +
                            value[0] + '</small>');
                    })


                }
            })
        }else{
            swal("error","Something Went Wrong","error")
            $(".loader").hide();
        }

    })

    $(document).on('change','#subcategory-select', function(){
        $(".loader").show();
        let $this = $(this);
        const sub_cat_id = $("#subcategory-select option:selected").val()
        const offer =  $("#subcategory-select option:selected").data("id")


        if( sub_cat_id && offer ){
            $.ajax({
                type: 'GET',
                url: "{{ route('offer.subcategory.filter') }}",
                data: {
                    sub_category_id : sub_cat_id,
                    offer_id : offer
                },
                success: function (response) {
                    $(".loader").hide();
                    $(".product-row .col-6").remove()
                    $(".product-row .col-md-12").remove()

                    if( response.products.data.length == 0 ){
                        $(".product-row").append(`
                            <div class="col-md-12">
                                <p class="text-center mt-10">No products found</p>
                            </div>
                        `);
                    }
                    else{
                        $.each(response.products.data,(key, value) => {
                            $(".product-row").append(`
                                <div class="col-md-2 col-6">
                                    <div class="product-box">
                                        <a href="${value.product_detail}">
                                            <img src="${value.image}" class="img-fluid" alt="">
                                        </a>
                                        <p>${value.name}</p>
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <p class="regular_price" style="text-align: left">
                                                    ৳${value.price}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <p class="offer_price">
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
                            `);
                        });
                    }

                },
                error: function (response) {
                    $(".loader").hide();

                    data = response.responseJSON

                    $.each(data.errors, (key, value) => {

                        $("[name^=" + key + "]").parent().addClass('has-error')
                        $("[name^=" + key + "]").parent().append(
                            '<small class="danger text-muted form-errors">' +
                            value[0] + '</small>');
                    })


                }
            })
        }else{
            swal("error","Something Went Wrong","error")
            $(".loader").hide();
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

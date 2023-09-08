@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Offers</title>
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

    .banner-button{
            position: absolute;
        top: 15px;
        background: white;
        color: #031b4e;
        padding: 5px 10px;
        right: 30px;
        border-radius: 5px;
        border: 2px solid #031b4e;
        font-weight: bold;
    }
    .banner-button:hover{
        background: #031b4e;
        color: white;
    }
    .banner-carousel .item img {
        border-radius: 5px!important;
    }
    .product-row {
        overflow: hidden;
    }

    .product-box {
        margin-right: -1px;
        
    }
    .offer-banner .col-md-12{
        padding: 0;
    }
    
    @media (min-width: 320px) and (max-width: 500px){        
        .banner-carousel .item img {
            height: 150px !important;
        }
        .offer-banner .col-md-12{
            padding: 0 15px;
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
                    <a href="">
                        Offer Page
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->



<!-- offer banner start -->
<section class="offer-banner" style="margin-bottom: 30px">
    <div class="container">
        <div class="row">
            <div class="offer-banner-carousel owl-carousel owl-theme">
                @foreach( App\Models\AllBanner::orderBy("position","asc")->where("type","Offer")->get() as $offer_banner )
                <div class="item">
                    <div class="col-md-12">
                        <img src="{{ asset('images/allbanner/'.$offer_banner->image) }}"
                            style="width: 100%" class="img-fluid" alt="">
                        @if( $offer_banner->button != null )
                        <a class="banner-button" href="{{ $offer_banner->link }}">{{ $offer_banner->button }}</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- offer banner end -->



<!-- offer wise product start -->
@forelse( App\Models\Offer::orderBy('id','desc')->where('status', true)->get() as $offer )
<section class="offer-product">
    <div class="container">

        <!-- title part start -->
        <div class="row offer-product-title">
            <div class="col-md-12 offer-product-title-div">
                <div class="left" style="background : {{ $offer->color }}">
                    <div class="row" style="position: relative;">
                        <a href="{{ route('offer.single', $offer->slug) }}" class="click_here_image">
                            <img src="{{ asset('images/ppppp.png') }}">
                            <p>See all products in this offer</p>
                        </a>
                        <div class="col-md-8 col-12">
                            <h2 style="color: #000000">{{ $offer->name }}</h2>
                            @if($offer->percent)
                            <p>Upto {{ $offer->percent }}% discount</p>
                            @elseif($offer->cash_discount)
                            <p>Upto {{ $offer->cash_discount }} taka discount</p>
                            @endif

                        </div>
                        <div class="col-md-4 col-12 right" style="position: relative">
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
        <div class="row product-row" style="margin-top: 0;">
        
            @if( isset($offer->category[0]) ) 
                @foreach( $offer->category[0]->product->where("is_active",true)->take(6) as $product )
                <div class="col-md-2 col-6">
                    <div class="product-box">
                        <a href="{{ route('productdetails', $product->slug) }}">
                            <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid" alt="">
                        </a>
                        <a href="{{ route('productdetails', $product->slug) }}" class="product_name">{{ Str::limit($product->name, 45, '...') }}</a>
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
            @else
                @foreach( $offer->product->where("is_active",true)->take(6) as $product )
                <div class="col-md-2 col-6">
                    <div class="product-box">
                        <a href="{{ route('productdetails', $product->slug) }}">
                            <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid" alt="">
                        </a>
                        <a href="{{ route('productdetails', $product->slug) }}" class="product_name">{{ Str::limit($product->name, 45, '...') }}</a>
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
            @endif

        </div>
        <!-- product row end -->


    </div>
</section>
@empty
<div class="alert alert-warning">No offer found</div>
@endforelse
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

</script>
@endsection

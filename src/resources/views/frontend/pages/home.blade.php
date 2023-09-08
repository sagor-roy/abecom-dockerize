@extends('frontend.template.layout')

@section('meta')
    <!-- Title -->
    <title>AB Electronics - Global Brand 1983</title>

    <meta property="og:title" content="AB Electronics">
    <meta property="og:description"
        content="Since 1986, AB Electronics providing different kinds of Electronics products as an importer and sole distributor of many worlds famous brands. With the reliable after sales service and affordable price, AB Electronics become the most trustworthy shop over 30 years in Bangladesh.">
    <meta property="og:image" content="{{ asset('images/contact/' . App\Models\ContactDetail::first()->logo) }}">
    <meta property="og:url" content="https://www.abelectronicsbd.com/">


    <style>
        @charset "utf-8";


        ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        a {
            color: #333
        }

        a:hover,
        a:active {
            text-decoration: none
        }

        h1 {
            text-align: center;
            font-size: 6vw;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin: 30px 0
        }

        p {
            margin: 0 10px 10px 10px;
            word-wrap: break-word
        }

        .bannerblock {
            overflow: hidden;
            margin-top: 15px;
        }

        .bannerblock a img {
            transition: 0.4s ease-in-out;
            width: 100%;
            border-radius: 5px;
            height: 100%;
        }

        .bannerblock a:hover img {
            transform: scale(1.1);
            transition: 0.4s ease-in-out;
        }

        .bannerblock a {
            display: block;
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .bannerblock a::after {
            content: "";
            position: absolute;
            background: rgba(1, 1, 1, 0.2);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
        }

        .bannerblock a:hover::after {
            opacity: 1;
            visibility: unset;
            animation: bounceIn;
            animation-duration: 1s;
            transition: 0.4s ease-in-out
        }

        .product-info .row p {
            margin: 2px 0 !important;
        }

        .banner-button {

            background: #031b4e;
            color: white;
            border-radius: 5px;
            border: 2px solid #031b4e;
            font-weight: bold;
            display: inline-block;
            margin-top: 15px;
            padding: 5px 10px;
        }

        .banner-button:hover {
            background: white;
            color: #031b4e;
        }


        .bannerblock1,
        .bannerblock5,
        .bannerblock3 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .small-banner-carousel .item img:hover {
            transform: scale(1.1);
            transition: 0.4s ease-in-out;
        }

        .small-banner-carousel .item img {
            transition: 0.4s ease-in-out;
        }

        .no-product-find {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            text-align: center;
            width: 100%;
        }

        .no-product-find p {
            color: #ae0101;
            font-size: 18px;
        }

        .category-product-right {
            border-right: 1px solid #e0dfdf;
            border-bottom: 1px solid #e0dfdf;
        }


        @media(min-width: 320px) and (max-width: 500px) {
            .no-product-find {
                position: unset;
                transform: unset;
            }
        }
    </style>
@endsection


@section('body-content')



    <!-- Slider & Banner Section -->
    <div class="">
        <div class="container overflow-hidden">
            <div class="row">

                <!-- left part pc start-->
                <div class="col-md-3 banner-left-pc for-pc">
                    <div class="overflow-hidden banner">
                        <div class="left">
                            <!--<p> <i class="fas fa-bars"></i> All CATEGORIES</p>-->
                            <ul>

                                @foreach (App\Models\Category::orderBy('position', 'asc')->where('is_active', true)->select('id', 'name', 'slug', 'is_active')->take(App\Models\Counting::first()->left_category)->get() as $category)
                                    @if ($category->subcategory->count() > 0)
                                        <li id="{{ $category->id }}">

                                            <a href="{{ route('category', $category->slug) }}">
                                                <i class="{{ $category->icon }}"></i>
                                                {{ $category->name }}
                                                <i class="fas fa-angle-right"></i>
                                            </a>

                                            <!-- subcategory dropdown start -->
                                            <div class="sticky-sub-cat {{ $category->id }}">
                                                <ul>
                                                    @foreach ($category->subcategory->where('is_active', true) as $sub_cat)
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
                <!-- left part pc end-->

                <!-- left part mob start-->
                <div class="col-md-3 banner-left for-mob">
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

                                @foreach (App\Models\Category::orderBy('position', 'asc')->where('is_active', true)->select('id', 'name', 'slug', 'is_active')->take(App\Models\Counting::first()->left_category)->get() as $category)
                                    @if ($category->subcategory->count() > 0)
                                        <li id="{{ $category->id }}">

                                            <i class="{{ $category->icon }}"></i>
                                            {{ $category->name }}
                                            <i class="fas fa-angle-down"></i>

                                            <!-- subcategory dropdown start -->
                                            <div class="category-dropdown {{ $category->id }}">
                                                <ul>
                                                    @foreach ($category->subcategory->where('is_active', true) as $sub_cat)
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


                <!-- right part -->
                <div class="col-md-9 banner-right">
                    <div class="banner-carousel owl-carousel owl-theme">

                        @foreach (App\Models\HomeBanner::orderBy('position', 'asc')->select('image')->get() as $homebanner)
                            <div class="item">
                                <img src="{{ asset('images/homebanner/' . $homebanner->image) }}" class="img-fluid"
                                    alt="">
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- End right part -->

                <!-- RIGHT SIDE SMALL IMAGE START -->
                <!--<div class='col-md-3 small-banner-right'>-->



                <!--</div>-->
                <!-- right side small image end -->

            </div>

            <div class="row">

                <!-- banner one start -->
                <div class="col-md-4 col-4">
                    <div class="row">
                        <div class="small-banner-carousel owl-carousel owl-theme">
                            @foreach (App\Models\SmallBanner::orderBy('position', 'asc')->where('parent_id', 0)->where('id', 1)->select('id', 'image', 'link')->get() as $smallbanner)
                                <!-- item start -->
                                <div class="item">
                                    <div class="col-md-12 banner-one">
                                        <a href="{{ $smallbanner->link }}" target="blank">
                                            <img src='{{ asset('images/smallbanner/' . $smallbanner->image) }}'
                                                class='img-fluid'>
                                        </a>
                                    </div>
                                </div>
                                <!-- item end -->
                                @foreach ($smallbanner->childbanner as $childbanner)
                                    <!-- item start -->
                                    <div class="item">
                                        <div class="col-md-12 banner-one">
                                            <a href="{{ $childbanner->link }}" target="blank">
                                                <img src='{{ asset('images/smallbanner/' . $childbanner->image) }}'
                                                    class='img-fluid'>
                                            </a>
                                        </div>

                                    </div>
                                    <!-- item end -->
                                @endforeach
                            @endforeach
                        </div>
                    </div>


                </div>
                <!-- banner one end -->

                <!-- banner two start -->
                <div class="col-md-4 col-4">
                    <div class="row">
                        <div class="small-banner-carousel owl-carousel owl-theme">
                            @foreach (App\Models\SmallBanner::orderBy('position', 'asc')->where('parent_id', 0)->where('id', 2)->select('id', 'image', 'link')->get() as $smallbanner)
                                <!-- item start -->
                                <div class="item">
                                    <div class="col-md-12 banner-two">
                                        <a href="{{ $smallbanner->link }}" target="blank">
                                            <img src='{{ asset('images/smallbanner/' . $smallbanner->image) }}'
                                                class='img-fluid'>
                                        </a>
                                    </div>
                                </div>
                                <!-- item end -->
                                @foreach ($smallbanner->childbanner as $childbanner)
                                    <!-- item start -->
                                    <div class="item">
                                        <div class="col-md-12 banner-two">
                                            <a href="{{ $childbanner->link }}" target="blank">
                                                <img src='{{ asset('images/smallbanner/' . $childbanner->image) }}'
                                                    class='img-fluid'>
                                            </a>
                                        </div>

                                    </div>
                                    <!-- item end -->
                                @endforeach
                            @endforeach
                        </div>
                    </div>


                </div>
                <!-- banner two end -->

                <!-- banner three start -->
                <div class="col-md-4 col-4">
                    <div class="row">
                        <div class="small-banner-carousel owl-carousel owl-theme">
                            @foreach (App\Models\SmallBanner::orderBy('position', 'asc')->where('parent_id', 0)->where('id', 3)->select('id', 'image', 'link')->get() as $smallbanner)
                                <!-- item start -->
                                <div class="item">
                                    <div class="col-md-12 banner-three">
                                        <a href="{{ $smallbanner->link }}" target="blank">
                                            <img src='{{ asset('images/smallbanner/' . $smallbanner->image) }}'
                                                class='img-fluid'>
                                        </a>
                                    </div>
                                </div>
                                <!-- item end -->
                                @foreach ($smallbanner->childbanner as $childbanner)
                                    <!-- item start -->
                                    <div class="item">
                                        <div class="col-md-12 banner-three">
                                            <a href="{{ $childbanner->link }}" target="blank">
                                                <img src='{{ asset('images/smallbanner/' . $childbanner->image) }}'
                                                    class='img-fluid'>
                                            </a>
                                        </div>

                                    </div>
                                    <!-- item end -->
                                @endforeach
                            @endforeach
                        </div>
                    </div>


                </div>
                <!-- banner three end -->


            </div>

        </div>
    </div>
    <!-- End Slider & Banner Section -->

    <!-- slide category start -->
    <section class="slide-category">
        <div class="container">

            <div class="row">
                <div class="category-carousel owl-carousel owl-theme">

                    <!-- item start -->
                    @foreach (App\Models\Category::orderBy('position', 'asc')->where('is_active', true)->take(App\Models\Counting::first()->slider_category)->select('id', 'name', 'slug', 'image')->get() as $category)
                        @if ($category->product->count() > 0)
                            <div class="item">
                                <a href="{{ route('category', $category->slug) }}">
                                    <div class="col-md-12">
                                        <div class="img-background">
                                            <img src="{{ asset('images/category/' . $category->image) }}" alt="">
                                        </div>
                                        <p class="text-center">{{ Str::limit($category->name, 20, '...') }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    <!-- item end -->

                </div>
            </div>
        </div>
    </section>
    <!-- slide category end -->


    <!-- ongoing start -->
    <!-- ongoing start -->
    @if (App\Models\Offer::orderBy('id', 'desc')->where('status', true)->get()->count() > 0)
        <section class="ongoing-offer">
            <div class="container">

                <!-- top row start -->
                <div class="row"
                    style="
    padding-top: 8px;
        border-radius: 5px 5px 0 0;
        background: #e0e0e0;
    ">

                    <!-- left start -->
                    <div class="col-md-2 col-12">
                        <div class="left">
                            <h2>
                                <img src="{{ asset('images/offer-1.gif') }}"
                                    style="position: absolute;
    width: 80%;
    left: 0;
    z-index: 3;
    top: -25px;">
                            </h2>
                        </div>
                    </div>
                    <!-- left end -->

                    <!-- middle part start -->
                    <div class="col-md-8 col-12">
                        <div class="middle offer_filter">
                            <ul>
                                @php
                                    $i = 0;
                                @endphp

                                @foreach (App\Models\Offer::orderBy('id', 'desc')->where('status', true)->take(1)->get() as $offer)
                                    @if ($i == 0)
                                        <li class=" active-offers" data-id="{{ $offer->id }}">
                                            <img src="{{ asset('images/offer/' . $offer->image) }}" alt="">
                                        </li>
                                    @endif

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                                <!-- second -->
                                @php
                                    $i = 0;
                                @endphp

                                @foreach (App\Models\Offer::orderBy('id', 'desc')->where('status', true)->take(App\Models\Counting::first()->home_offer)->get() as $offer)
                                    @if ($i > 0)
                                        <li class="" data-id="{{ $offer->id }}">
                                            <img src="{{ asset('images/offer/' . $offer->image) }}" alt="">
                                        </li>
                                    @endif

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- middle part end -->

                    <!-- middle part start -->
                    <div class="col-md-2 col-12">
                        <div class="right" style="text-align: right">
                            <a href="{{ route('offer') }}">See all offers</a>
                        </div>
                    </div>
                    <!-- middle part end -->

                </div>
                <!-- top row end -->

                <!-- offer product row start -->
                @php
                    $i = 0;
                @endphp
                @foreach (App\Models\Offer::orderBy('id', 'desc')->where('status', true)->take(1)->get() as $offer)
                    @if ($i == 0)
                        <div class="row offer-product-row"
                            style="margin-top:0;
    border-radius: 0 0 5px 5px ;margin-right: -15.2px;">

                            <div class="col-md-2 col-6 offer-countdown-block">
                                <a href='{{ route('offer.single', $offer->slug) }}' class='offer_single'>
                                    <h2 class=" text-center mt-3">{{ $offer->name }}</h2>
                                    @if ($offer->percent)
                                        <p style="text-align: center; color:#000000; font-weight: bold">Upto
                                            {{ $offer->percent }}% discount</p>
                                    @elseif($offer->cash_discount)
                                        <p style="text-align: center; color:#000000; font-weight: bold">Upto
                                            {{ $offer->cash_discount }} taka discount</p>
                                    @endif

                                    <!--<img src="{{ asset('images/clock.gif') }}">-->
                                    <a class="banner-button" href="{{ route('offer.single', $offer->slug) }}">View
                                        Offer</a>

                                    <div class="offer-countdown">

                                        <p class="text-center">Hurry up! Offer ends in :</p>
                                        <ul>
                                            <li>
                                                <span
                                                    class="day">{{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($offer->end_date)) }}</span>
                                                <p>D</p>
                                            </li>
                                            <li>
                                                <span class="hour">{{ 24 - \Carbon\Carbon::now()->format('H') }}</span>
                                                <p>H</p>
                                            </li>
                                            <li>
                                                <span class="minute">{{ 60 - \Carbon\Carbon::now()->format('i') }}</span>
                                                <p>M</p>
                                            </li>
                                            <li>
                                                <span class="second">60</span>
                                                <p>S</p>
                                            </li>
                                        </ul>

                                    </div>
                                </a>
                            </div>
                            <!-- item start -->
                            @forelse ($offer->category->take(1) as $key => $offer_category)
                                @foreach ($offer_category->product->where('is_active', true)->take(5) as $product)
                                    @if ($key == 0)
                                        <div class="col-md-2 col-6" style="padding: 0;">
                                            <div class="product-box">
                                                <a href="{{ route('productdetails', $product->slug) }}">
                                                    <img src="{{ asset('images/product/' . $product->thumbnail) }}"
                                                        class="img-fluid" alt="">
                                                </a>

                                                <!-- discount start -->
                                                <div class="product-discount">
                                                    <p>
                                                        @if ($offer->percent == 0)
                                                            - {{ $offer->cash_discount }} BDT
                                                        @elseif($offer->cash_discount == 0)
                                                            - {{ $offer->percent }} %
                                                        @endif

                                                    </p>
                                                </div>
                                                <!-- discount end -->

                                                <a href="{{ route('productdetails', $product->slug) }}"
                                                    class="product_name">{{ Str::limit($product->name, 45, '...') }}</a>
                                                <div class="row">
                                                    <div class="col-md-6 col-6">
                                                        @if ($product->offer_price == null)
                                                            <p class="offer_price" style="text-align: left">
                                                                ৳ {{ $product->price }}
                                                            </p>
                                                        @else
                                                            <p class="regular_price">
                                                                ৳ {{ $product->price }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        @if ($product->offer_price != null)
                                                            <p class="offer_price">
                                                                ৳ {{ $product->offer_price }}
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
                                    @endif
                                @endforeach
                            @empty
                                @foreach ($offer->product->where('is_active', true)->take(5) as $product)
                                    <div class="col-md-2 col-6" style="padding: 0;">
                                        <div class="product-box">
                                            <a href="{{ route('productdetails', $product->slug) }}">
                                                <img src="{{ asset('images/product/' . $product->thumbnail) }}"
                                                    class="img-fluid" alt="">
                                            </a>

                                            <!-- discount start -->
                                            <div class="product-discount">
                                                <p>
                                                    @if ($offer->percent == 0)
                                                        - {{ $offer->cash_discount }} BDT
                                                    @elseif($offer->cash_discount == 0)
                                                        - {{ $offer->percent }} %
                                                    @endif

                                                </p>
                                            </div>
                                            <!-- discount end -->

                                            <a href="{{ route('productdetails', $product->slug) }}"
                                                class="product_name">{{ Str::limit($product->name, 45, '...') }}</a>
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    @if ($product->offer_price == null)
                                                        <p class="offer_price" style="text-align: left">
                                                            ৳ {{ $product->price }}
                                                        </p>
                                                    @else
                                                        <p class="regular_price">
                                                            ৳ {{ $product->price }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    @if ($product->offer_price != null)
                                                        <p class="offer_price">
                                                            ৳ {{ $product->offer_price }}
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
                            @endforelse
                            <!-- item end -->

                        </div>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach

                <!-- offer product row end -->


            </div>
        </section>
    @endif
    <!-- ongoing end -->
    <!-- ongoing end -->



    <!-- product block start -->
    @foreach (App\Models\ProductBlock::orderBy('position', 'asc')->where('is_active', true)->get() as $pblock)
        <div class="container" id="go-category" style='padding-top: 60px;'>
            <div class="">

                <!-- Brand Nav nav-pills -->
                <div class="position-relative text-center z-index-2"
                    style="background: #e0e0e0;
margin: 0 -15px;
padding: 10px 15px;
    border-radius: 5px 5px 0 0;
        border: 1px solid #14090d;
    ">
                    <div
                        class="d-flex justify-content-between flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                        <h2 class="section-title mb-0 font-size-22">{{ $pblock->name }}</h2>

                        <ul class="brand-filter w-100 w-lg-auto nav nav-pills nav-tab-pill pt-3 pt-lg-0 mb-0 border-top border-color-1 border-lg-top-0 align-items-center font-size-15 font-size-15-lg flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble pr-0"
                            id="pills-tab-3" role="tablist">
                            <li class="nav-item flex-shrink-0 flex-lg-shrink-1 brand_selected" id="all"
                                data-id="{{ $pblock->id }}">
                                <a class="nav-link  active" id="Bpills-one-example1-tab" data-toggle="pill"
                                    href="#Bpills-{{ $category->id }}-example1" role="tab"
                                    aria-controls="Bpills-one-example1" aria-selected="true">All</a>
                            </li>

                            @foreach ($pblock->brand->take($pblock->per_brand)->sortByDesc('id') as $brand)
                                <li class="nav-item flex-shrink-0 flex-lg-shrink-1 " id="{{ $brand->id }}"
                                    data-id="{{ $pblock->id }}">
                                    <a class="nav-link " id="Bpills-one-example1-tab" data-toggle="pill"
                                        href="#Bpills-{{ $pblock->id }}-{{ $brand->id }}-example1" role="tab"
                                        aria-controls="Bpills-one-example1" aria-selected="true">{{ $brand->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Brand End Nav Pills -->

                <div class="row reserve-tab" style="
    border-radius: 0 0 5px 5px;
margin-right: -15.2px;
">

                    <!-- category part start -->
                    <div class="col-md-2 reserve-tab-left"
                        style="position: relative;background: {{ $pblock->color }}; border-right: 1px solid {{ $pblock->color }};">
                        <div class="min-width-200">
                            <ul class="list-group list-group-flush flex-nowrap flex-xl-wrap flex-row flex-xl-column overflow-auto overflow-xl-visble  mb-xl-0"
                                style="border-left: 1px solid {{ $pblock->color }};">

                                <li class="parent_li border-color-1 list-group-item border-lg-down-0 flex-shrink-0 flex-xl-shrink-1 category_selected"
                                    style="color: white;cursor: pointer; background: {{ $pblock->color }};"
                                    id="{{ $pblock->id }}" data-id="{{ $pblock->category[0]->id }}">
                                    <a
                                        class="hover-on-bold py-1 px-3 text-gray-90 d-block">{{ $pblock->category[0]->name }}</a>
                                </li>

                                @foreach ($pblock->category->take($pblock->per_category)->sortByDesc('id') as $key => $cat)
                                    @if ($key > 0)
                                        <li class="border-color-1 list-group-item border-lg-down-0 flex-shrink-0 flex-xl-shrink-1"
                                            id="{{ $pblock->id }}" data-id="{{ $cat->id }}" style=""><a
                                                class="hover-on-bold py-1 px-3 text-gray-90 d-block">{{ $cat->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!--<div class="reserve-tab-left-bottom">-->
                        <!--    <img src="{{ asset('images/pblock/' . $pblock->small_image) }}" class="img-fluid" alt="">-->
                        <!--</div>-->
                    </div>
                    @if ($pblock->block_thumbnail || $pblock->product_id)
                        <div class="col-md-3 category-product-thumbnail-img reserve-tab-middle">
                            @if ($pblock->block_thumbnail)
                                <a href="{{ route('category', $category->slug) }}" class="d-block thumbnail_image">
                                    <img class="img-fluid " src="{{ asset('images/pblock/' . $pblock->block_thumbnail) }}"
                                        alt="Image Description">
                                </a>
                            @elseif($pblock->product_id)
                                <div class="product-box">
                                    <a href="{{ route('productdetails', $pblock->product->slug) }}"
                                        class="product-image">
                                        <img src="{{ asset('images/product/' . $pblock->product->thumbnail) }}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <a
                                        href="{{ route('productdetails', $pblock->product->slug) }}">{{ Str::limit($pblock->product->name, 45, '...') }}</a>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            @if ($product->offer_price == null)
                                                <p class="offer_price" style="text-align: left">
                                                    ৳ {{ $product->price }}
                                                </p>
                                            @else
                                                <p class="regular_price">
                                                    ৳ {{ $product->price }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-6">
                                            @if ($product->offer_price != null)
                                                <p class="offer_price">
                                                    ৳ {{ $product->offer_price }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>


                                    <!-- product info start -->
                                    <div class="product-info">
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
                                    </div>
                                    <!-- product info end -->

                                </div>
                            @endif
                        </div>
                    @endif
                    <!-- category part end -->

                    @if (!$pblock->block_thumbnail && !$pblock->product_id)
                        <div class="col-md-10 category-product-right reserve-tab-right">
                        @else
                            <div class="col-md-7 category-product-right reserve-tab-right">
                    @endif
                    <!-- Tab Content -->
                    <div class="tab-content" id="Bpills-tabContent">

                        <!-- first part start -->
                        <div class="tab-pane fade pt-2 show active" id="Bpills-example1" role="tabpanel"
                            aria-labelledby="Bpills-one-example1-tab">
                            <ul class="row list-unstyled products-group no-gutters mb-0">

                                <!-- product item start -->
                                @foreach (\App\Models\Product::orderBy('id', 'desc')->where('is_active', true)->where('category_id', $pblock->category[0]->id)->select('id', 'slug', 'thumbnail', 'offer_price', 'price', 'name')->take($pblock->per_product)->get() as $product)
                                    <li class="col-6 col-md-3 product-item">
                                        <div class="product-box">
                                            <a href="{{ route('productdetails', $product->slug) }}">
                                                <img src="{{ asset('images/product/' . $product->thumbnail) }}"
                                                    class="img-fluid" alt="">
                                            </a>
                                            <a href="{{ route('productdetails', $product->slug) }}"
                                                class="product_name">
                                                @if ($pblock->block_thumbnail || $pblock->product_id)
                                                    {{ Str::limit($product->name, 45, '...') }}
                                                @else
                                                    {{ Str::limit($product->name, 45, '...') }}
                                                @endif

                                            </a>
                                            <div class="row">
                                                <div class="col-md-6 col-6" style="padding-right: 0">
                                                    @if ($product->offer_price == null)
                                                        <p class="offer_price" style="text-align: left">
                                                            ৳ {{ $product->price }}
                                                        </p>
                                                    @else
                                                        <p class="regular_price">
                                                            ৳ {{ $product->price }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    @if ($product->offer_price != null)
                                                        <p class="offer_price">
                                                            ৳ {{ $product->offer_price }}
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
                                    </li>
                                @endforeach
                                <!-- product item end -->



                            </ul>
                        </div>
                        <!-- first part end -->

                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <!-- product block end -->







    <!-- home page gallery start -->
    <section class="home-gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="row">
                        <div class="bannerblock1 bannerblock col-md-8 col-12">
                            @if (App\Models\HomeGallery::where('position', 1)->first())
                                <a href="{{ App\Models\HomeGallery::where('position', 1)->first()->url }}"
                                    class="ishi-customhover-fadeoutcenter scale">

                                    <img src="{{ asset('images/homegallery/' . App\Models\HomeGallery::where('position', 1)->first()->image) }}"
                                        alt="banner" title="" class="img-fluid">

                                </a>
                            @endif
                        </div>
                        <div class="bannerblock2 bannerblock col-md-4 col-12">
                            @if (App\Models\HomeGallery::where('position', 2)->first())
                                <a href="{{ App\Models\HomeGallery::where('position', 2)->first()->url }}"
                                    class="ishi-customhover-fadeoutcenter scale">

                                    <img src="{{ asset('images/homegallery/' . App\Models\HomeGallery::where('position', 2)->first()->image) }}"
                                        alt="banner" title="" class="img-fluid">

                                </a>
                            @endif
                        </div>
                        <div class="bannerblock3 bannerblock col-md-4 col-12 clearfix">
                            @if (App\Models\HomeGallery::where('position', 3)->first())
                                <a href="{{ App\Models\HomeGallery::where('position', 3)->first()->url }}"
                                    class="ishi-customhover-fadeoutcenter scale">

                                    <img src="{{ asset('images/homegallery/' . App\Models\HomeGallery::where('position', 3)->first()->image) }}"
                                        alt="banner" title="" class="img-fluid">

                                </a>
                            @endif
                        </div>
                        <div class="bannerblock4 bannerblock col-md-8 col-12">
                            @if (App\Models\HomeGallery::where('position', 4)->first())
                                <a href="{{ App\Models\HomeGallery::where('position', 4)->first()->url }}"
                                    class="ishi-customhover-fadeoutcenter scale">

                                    <img src="{{ asset('images/homegallery/' . App\Models\HomeGallery::where('position', 4)->first()->image) }}"
                                        alt="banner" title="" class="img-fluid">

                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="bannerright col-md-4 col-12">
                    <div class="row">
                        <div class="bannerblock5 bannerblock col-md-12">
                            @if (App\Models\HomeGallery::where('position', 5)->first())
                                <a href="{{ App\Models\HomeGallery::where('position', 5)->first()->url }}"
                                    class="ishi-customhover-fadeoutcenter scale">

                                    <img src="{{ asset('images/homegallery/' . App\Models\HomeGallery::where('position', 5)->first()->image) }}"
                                        alt="banner" title="" class="img-fluid">

                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home page gallery end -->



    <!-- our brand start -->
    @if (App\Models\Brand::all()->count() > 0)
        <section class="our-client">
            <div class="container">
                <div class="row">
                    <div class="client-carousel owl-carousel owl-theme">

                        <!-- item start -->
                        @foreach (App\Models\Brand::orderBy('position', 'asc')->get() as $brand)
                            <div class="item">
                                <a href="{{ route('brand', $brand->slug) }}">
                                    <div class="col-md-12">
                                        <img src="{{ asset('images/brand/' . $brand->image) }}" class="img-fluid"
                                            alt="">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <!-- item end -->

                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- our brand end -->



@endsection



@section('per_page_js')
    <script>
        setInterval(function() {
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

        //category wise product filter
        $(document).ready(function() {
            $(".reserve-tab-left ul li").click(function() {
                $(".loader").show()

                let $this = $(this);
                $(this).closest(".list-group").find("li").css({
                    "background": "white",
                });
                $(this).closest(".list-group").find("li a").css({
                    "color": "#000000",
                });
                const pblock = $this.attr('id')
                const category = $this.attr('data-id')
                const brand = $this.closest(".list-group").closest(".reserve-tab").closest(
                    "#go-category").find(".brand-filter .brand_selected").attr("id")

                $.ajax({
                    type: "GET",
                    url: "/home/block/" + pblock + "/brand/" + brand + "/category/" + category,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        $(".loader").hide()
                        if (response.color) {
                            $($this).closest(".list-group").find("li").removeClass(
                                "category_selected")
                            $this.css("background", response.color)
                            $this.find(".hover-on-bold").css("color", "white")
                            $this.addClass("category_selected");
                        }

                        if (response.products.length < 5 && response.pblock.block_thumbnail ==
                            null && response.pblock.product_id == null) {
                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                    "#go-category").find(
                                    ".reserve-tab .reserve-tab-left .reserve-tab-left-bottom")
                                .css({
                                    "position": "unset",
                                    "transform": "unset",
                                    "width": "100%",
                                    "padding": "15px"
                                })
                        } else {
                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                    "#go-category").find(
                                    ".reserve-tab .reserve-tab-left .reserve-tab-left-bottom")
                                .css({
                                    "position": "absolute",
                                    "transform": "translateX(-50%)",
                                    "width": "80%",
                                    "padding": "unset"
                                })
                        }


                        if (response.products.length == 0) {
                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                    "#go-category").find(".reserve-tab-right .no-product-find")
                                .remove();

                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                "#go-category").find(".reserve-tab-right").append(`
                            <div class="no-product-find">
                                <p>Could not find your search</p>
                            </div>
                            `);



                        } else {
                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                    "#go-category").find(".reserve-tab-right .no-product-find")
                                .remove();


                        }


                        if (response.products) {
                            $this.closest(".list-group").closest(".reserve-tab").closest(
                                    "#go-category").find(
                                    ".reserve-tab .reserve-tab-right .tab-content ul li")
                                .remove()
                            $.each(response.products, (key, value) => {
                                $this.closest(".list-group").closest(".reserve-tab")
                                    .closest("#go-category").find(
                                        ".reserve-tab .reserve-tab-right .tab-content ul"
                                    ).append(`
                            <li class="col-6 col-md-3 product-item">
                                <div class="product-box">
                                    <a href="${value.product_detail}">
                                        <img src="${value.image}"
                                            class="img-fluid" alt="">
                                    </a>
                                    <a href="${value.product_detail}">${value.name}</a>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                                <p class="offer_price" style="text-align: left">
                                                    ৳ ${value.price}
                                                </p>
                                        </div>
                                    </div>


                                    <!-- product info start -->
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
                                    <!-- product info end -->

                                </div>
                            </li>
                            `);
                            })

                        }

                    },
                    error: function() {
                        $(".loader").hide()
                    }
                })
            })
        })


        //brand wise product filter
        $(".brand-filter li").click(function() {
            $(".loader").show()
            let $this = $(this);

            const brand = $(this).attr('id')
            const pblock = $(this).attr('data-id')
            const cat_id = $this.closest(".brand-filter").closest(".position-relative").closest("#go-category")
                .find(".reserve-tab-left ul .category_selected").attr('data-id')

            $.ajax({
                type: "GET",
                url: "/home/block/" + pblock + "/category/" + cat_id + "/brand/" + brand,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {

                    $(".loader").hide()
                    $this.closest(".brand-filter").find("li").removeClass("brand_selected")
                    $this.addClass("brand_selected");

                    if (response.products.length < 5 && response.pblock.block_thumbnail == null &&
                        response.pblock.product_id == null) {
                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find(
                            ".reserve-tab .reserve-tab-left .reserve-tab-left-bottom").css({
                            "position": "unset",
                            "transform": "unset",
                            "width": "100%",
                            "padding": "15px"
                        })
                    } else {
                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find(
                            ".reserve-tab .reserve-tab-left .reserve-tab-left-bottom").css({
                            "position": "absolute",
                            "transform": "translateX(-50%)",
                            "width": "80%",
                            "padding": "unset"
                        })
                    }

                    if (response.products.length == 0) {
                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find(".reserve-tab-right .no-product-find").remove();

                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find(".reserve-tab-right").append(`
                        <div class="no-product-find">
                            <p>Could not find your search</p>
                        </div>
                        `);


                    } else {
                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find(".reserve-tab-right .no-product-find").remove();


                    }

                    if (response.products) {
                        $this.closest(".brand-filter").closest(".position-relative").closest(
                            "#go-category").find("#Bpills-tabContent .tab-pane ul li").remove()
                        $.each(response.products, (key, value) => {
                            $this.closest(".brand-filter").closest(".position-relative")
                                .closest("#go-category").find(
                                    "#Bpills-tabContent .tab-pane ul").append(`
                    <li class="col-6 col-md-3 product-item">
                        <div class="product-box">
                            <a href="${value.product_detail}">
                                <img src="${value.image}"
                                    class="img-fluid" alt="">
                            </a>
                            <a href="${value.product_detail}">${value.name}</a>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                        <p class="offer_price" style="text-align: left">
                                            ৳ ${value.price}
                                        </p>
                                </div>
                            </div>


                            <!-- product info start -->
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
                            <!-- product info end -->

                        </div>
                    </li>
                    `)
                        })
                    }

                },
                error: function(response) {
                    $(".loader").hide()
                }
            })

        })
    </script>
@endsection

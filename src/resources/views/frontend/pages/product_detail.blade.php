@extends('frontend.template.layout')

@section('meta')

<!-- Title -->
<title>AB Electronics - {{ $product->name }} </title>

<meta name="og:title" content="{{ $product->name }}">
<meta name="og:description" content="{{ $product->name }}">
<meta name="og:type" content="article" />
<meta name="og:url" content="{{ route('productdetails', $product->slug) }}">
<meta name="og:image" content="{{ asset('images/product/'.$product->thumbnail) }}">

@endsection


<style>
    li{
        list-style: unset!important;
    }
    footer ul li{
        list-style: none!important;
    }
    nav ul li{
        list-style: none!important;
    }
    .offer-countdown-block{
        background: unset!important;

        text-align: left!important;
    }
    .js-form-message{
        margin-bottom: 0;
    }
    .offer-countdown-block .offer-countdown{
        position: unset!important;
        transform: unset!important;
        left: 0!important;
    }
    .offer-countdown-block .offer-countdown ul{
        text-align: left!important
    }
    .offer-list li,
    .banner .left ul li{
        list-style: none!important;
    }
    .product-list-row p{
        width: 100%;
        display: block;
    }
    .price-match-form{
        position: fixed;
        background: rgba(1,1,1,0.2);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 5;
        display: none;
        overflow: scroll;
        overflow-x: hidden;

    }
    .price-match-form .col-md-12{
        position: absolute;
        top: 50%;
        left: 50%;
        background: #fbfbfb;
        height: 100%;
        width: 30%;
        transform: translate(-50%,-50%);
        padding: 0;
        margin: 15px 0;

    }
    .price-match-form .col-md-12 h2{
        text-align: center;
        background: #031b4e;
        color: white;
        padding: 5px;
    }
    .price-match-form .form-box{
        padding: 15px;
        background: white;
    }
    .price-match-form .form-box .input-group-text{
        border-radius: unset!important;
    }
    .price-match-form .form-box textarea{
        border-radius: unset!important;
    }
    .price-match-form .form-box .input-group > .form-control:not(:first-child), .input-group > .custom-select:not(:first-child){
        border-radius: unset;
    }
    table tbody tr td{
        border: 1px solid #cbcbcb!important;
    }
    #show-price-match-form{
        cursor: pointer;
    }
    .price-match-form .col-md-12::-webkit-scrollbar{
        width: 0px;
    }
    .related-product-div{
        padding-left: 0!important;
    }
    #close-price-match-form{
        display: block;
        margin: 0 0 0 auto;
    }

    @media(min-width:320px) and (max-width:500px){
        .price-match-form .col-md-12{
            width: 100%;
            height: 100%;
        }
        .related-product-div{
            padding-left: 15px!important;
        }
        #close-price-match-form{
            margin: 0;
        }
    }
    @media(min-width:500px) and (max-width:768px){
        .price-match-form .col-md-12{
            width: 80%;
            height: 100%;
        }
        .related-product-div{
            padding-left: 15px!important;
        }
        #close-price-match-form{
            margin: 0;
        }
    }
    @media(min-width:768px) and (max-width:990px){
        .price-match-form .col-md-12{
            width: 50%;
            height: 100%;
        }
    }
    @media(min-width:990px) and (max-width:1024px){
        .price-match-form .col-md-12{
            width: 50%;
            height: 100%;
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
                    <a href="{{ route('category', $product->category->slug) }}">
                        {{ $product->category->name }}
                    </a>
                    <i class="fas fa-angle-right"></i>
                </li>
                <li>
                    <a href="{{ route('subcategory', $product->sub_category->slug) }}">
                        {{ $product->sub_category->name }}
                    </a>
                    <i class="fas fa-angle-right"></i>
                </li>
                <li class="product_indicate_name">
                    <a href="">
                        {{ $product->name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->

<!-- product detail top start -->
<section class="product-detail-top">
    <div class="container">

        <div class="row">

            <!-- left part start -->
            <div class="col-md-4 product-div-left">
                <div class="left" style="border: 1px solid #f3f1f1;">

                    <!-- main image start -->
                    <div class="main-img">
                        <img src="{{ asset('images/product/'.$product->thumbnail) }}" class="img-fluid product-1" id="block__pic" onmouseover="a('block__pic')" alt="">
                    </div>
                    <!-- main image end -->

                    <!-- small image start -->
                    <div class="small-img">
                        <div class="row">
                            <div class="product-detail-carousel owl-carousel owl-theme">

                                <!-- item start -->
                                <div class="item " id="product-1 ">
                                    <div class="col-md-12" style="border: 1px solid #f3f1f1;padding: 0">
                                        <img src="{{ asset('images/product/'.$product->thumbnail) }}" class="img-fluid active-product" alt="">
                                    </div>
                                </div>
                                <!-- item end -->

                                <!-- item start -->
                                @php
                                $i = 0;
                                @endphp
                                @foreach( $product->product_image as $image )
                                @if( $i > 0)
                                <div class="item" id="product-{{ $image->id }}">
                                    <div class="col-md-12" style="border: 1px solid #f3f1f1;padding: 0">
                                        <img src="{{ asset('images/product/'. $image->image) }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                @endif
                                @php
                                $i++;
                                @endphp
                                @endforeach
                                <!-- item end -->

                            </div>
                        </div>
                    </div>
                    <!-- small image end -->

                </div>
            </div>
            <!-- left part end -->

            <!-- right part start -->
            <div class="col-md-5 product-div-middle">
                <div class="right" style="border: 1px solid #f3f1f1;">
                    <h2>{{ $product->name }}</h2>



                    <!-- availability -->
                    <div class="row">
                        <div class="col-md-12 availability">
                            <ul>
                                <li>Availability :</li>
                                <li>
                                    @if( $product->qty == null )
                                        @if( $product->product_attribute->sum('qty') > 0 )
                                        <span>
                                            In stock <i class="far fa-check-circle"></i>
                                        </span>
                                        @else
                                        <span style="color: red">
                                            Out of stock <i class="far fa-times-circle"></i>
                                        </span>
                                        @endif
                                    @else
                                        @if( $product->qty > 0 )
                                        <span>
                                            In stock <i class="far fa-check-circle"></i>
                                        </span>
                                        @else
                                        <span style="color: red">
                                            Out of stock <i class="far fa-times-circle"></i>
                                        </span>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- availability end-->


                    <!-- wishlist and compare -->
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12 wishlist">
                            <ul>
                                <li onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                    Wishlist
                                </li>
                                <li onclick="addToCompare({{ $product->id }})">
                                    <i class="fas fa-balance-scale"></i>
                                    Compare
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- wishlist and compare end-->

                    <!-- price start -->
                    @if( !is_null($product->offer_id) )
                        <div class="row" style="margin-bottom: 5px;">
                    @else
                    <div class="row">
                        @endif
                        <div class="col-md-12 price">
                            <ul>
                                <li>
                                    @if( $product->offer_price == null )
                                        ৳{{ $product->price }} BDT
                                    @else
                                        {{ $product->offer_price }} BDT
                                    @endif
                                </li>
                                <li>
                                <span>
                                    @if( $product->offer_price != null )
                                        ৳{{ $product->price }} BDT
                                    @endif
                                </span>
                                </li>
                            </ul>
                            @if( $product->offer_id == null )
                            <a id="show-price-match-form" style="color: #ae0000">Found A Better Price? We'll Match It!</a>
                            <section class="price-match-form">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Price Matching Request</h2>
                                            <div class="form-box">
                                                <p class="text-center">Nobody can beat our price. Tell us where you found a lower price. Please call us directly (@ 01938866990) to match a price or fill in the form below and we will be contacted shortly. Don't forget to mention your phone number.</p>
                                                <form action="{{ route('pricematch') }}" method="post" class="ajax-form" >
                                                @csrf
                                                    <div class="input-group mb-1 mt-3">
                                                        <label>Price Match For Product : {{ $product->name }}</label>
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    </div>
                                                    <div class="input-group mb-1 mt-1">
                                                        <label>Our Price : ৳{{ $product->price }} BDT</label>
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                      <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-user"></i>
                                                      </span>
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                      <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-envelope"></i>
                                                      </span>
                                                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                      <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-phone"></i>
                                                      </span>
                                                        <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone Number" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                      <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-lira-sign"></i>
                                                      </span>
                                                        <input type="text" name="price" class="form-control" placeholder="Enter Matching Price" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                      <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-link"></i>
                                                      </span>
                                                        <input type="text" name="url" class="form-control" placeholder="Enter Matching URL" aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                        <textarea class="form-control" name="comment" rows="2">

                                                        </textarea>
                                                    </div>
                                                    <div class="input-group mb-4 mt-3">
                                                        <button type="submit" class="btn btn-success " style="display:block; margin: 0 auto">Send</button>
                                                    </div>
                                                    <div class="input-group mb-4" style="    margin-top: -40px!important;">
                                                        <button type="button" id="close-price-match-form" class="btn btn-danger" >Exit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @endif
                        </div>
                    </div>
                    <!-- price end -->

                    <!-- countdown start  -->
                    @if( !is_null($product->offer_id) )
                        <div class="row mb-2 offer-countdown-block">
                            <div class="col-md-12 offer-countdown">

                                <p class="text-left">Hurry up! Offer ends in :</p>
                                <ul>
                                    <li>
                                        <span class="day">{{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($product->offer->end_date)) }}</span>
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
                        </div>
                    @endif
                    <!-- countdown end  -->

                    <!-- info start -->
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-12 info">
                            <p style="font-weight: bold">Quick Overview</p>
                            {!! $product->short_description !!}
                        </div>
                    </div>
                    <!-- info end -->





                    <!-- product varient start -->

                    <div class="row product-varient" style="margin-top: 10px; margin-bottom: 10px ">

                        <div class="col-md-12 qty" >
                            <ul>
                                @if( $product->product_attribute->count() > 0 )
                                    <li>
                                        <select name="" class="form-control"  id="product-varient">
                                            @foreach( $product->product_attribute as $product_varient )
                                                <option value="{{ $product_varient->id }}" >{{ $product_varient->value }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                @endif
                                <li>
                                    <input type="number" class="add-qty" id="quantity" value="1" min="1">
                                </li>

                                <li class="add_to_cart_button">
                                    <button class="addToCart" onclick="addToCart({{ $product->id }})">
                                        <i class="fas fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <!-- product varient end -->

                    <!-- cart start -->
                    <div class="row">

                    </div>
                    <!-- cart end -->

                    <!-- social share start -->
                    <div class="row">
                        <div class="col-md-12 qty">
                            <p style="font-weight: bold">Share Via</p>
                            <ul>
                                <li style="cursor: pointer" onclick='window.open("https://www.facebook.com/sharer/sharer.php?u={{ route('productdetails', $product->slug) }}", "", "width=500,height=500")''>
                                    <a class="social-button " id="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li style="cursor: pointer" onclick='window.open("https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('productdetails', $product->slug) }}", "", "width=500,height=500")''>
                                    <a  class="social-button " id="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li style="cursor: pointer" onclick='window.open("http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('productdetails', $product->slug) }}", "", "width=500,height=500")''>
                                    <a  class="social-button " id="">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                                <li style="cursor: pointer" onclick='window.open("https://wa.me/?text={{ route('productdetails', $product->slug) }}", "", "width=500,height=500")''>
                                    <a  class="social-button " id="">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- social share end -->


                    <!-- review start -->
                    <div class="row">
                        <div class="col-md-12 review">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    ( {{ $product->review->where('is_approved', true)->count() }} customer reviews )
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- review end -->

                </div>
            </div>

                <!-- product detail info start -->
                <div class="col-md-3 product-div-right">
                    <div class="product-detail-info" style="border: 1px solid #f3f1f1;">
                        @if( App\Models\ContactDetail::first() )
                        <h2>{{ App\Models\ContactDetail::first()->product_details_title }}</h2>
                        @endif
                        @if( App\Models\ContactDetail::first() )
                            {!! App\Models\ContactDetail::first()->product_details_list !!}
                        @endif
                        <div class='footer-hotline'>
                            <div class='footer-hotline-left'>
                                <i class='fas fa-phone'></i>
                                <p>Helpline</p>
                                <h3 style="color:#ae0000;margin-bottom: 0;">{{ App\Models\ContactDetail::first()->hotline }}</h3>
                                <p class="text-center">Call for Order & Other Enquiry</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- product detail info start -->



         </div>


    </div>
    <!-- right part end -->




    </div>
    </div>
</section>
<!-- product detail top end -->


<!-- product detail list start -->
<section class="product-detail-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li id="description" class="all-list active-info">Description</li>
                    <li id="specification" class="all-list">Specification</li>
                    <li id="reviews" class="all-list">Reviews</li>
                    <li id="qa" class="all-list">Q/A</li>
                    <li id="product_warranty" class="all-list">Product Warranty</li>
                </ul>
            </div>
        </div>

        <!-- Description -->
        <div class="row product-list-row  description">
            {!! $product->description !!}
        </div>
        <!-- Description -->

        <!-- Specification -->
        <div class="row product-list-row hide-detail specification" style="padding-left: 15px">
            {!! $product->specification !!}
        </div>
        <!-- Specification -->

        <!-- Reviews -->
        <div class="row product-list-row hide-detail reviews">

            <!-- left part -->
            <div class="col-md-6">
                <div class="left">
                    <h2>Based on reviews</h2>
                    <h2>{{ $product->review->where('is_approved', true)->sum('star') / 5 }}</h2>
                    <p>overall</p>

                    <div class="row review-star-row">
                        <div class="col-md-4 col-4">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="progress">
                                <p>{{ $product->review->where('star',5)->where('is_approved', true)->count() }}</p>
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row review-star-row">
                        <div class="col-md-4 col-4">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="progress">
                                <p>{{ $product->review->where('star',4)->where('is_approved', true)->count() }}</p>
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row review-star-row">
                        <div class="col-md-4 col-4">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="progress">
                                <p>{{ $product->review->where('star',3)->where('is_approved', true)->count() }}</p>
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row review-star-row">
                        <div class="col-md-4 col-4">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="progress">
                                <p>{{ $product->review->where('star',2)->where('is_approved', true)->count() }}</p>
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row review-star-row">
                        <div class="col-md-4 col-4">
                            <ul>
                                <li>
                                    <i class="fas fa-star"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="progress">
                                <p>{{ $product->review->where('star',1)->where('is_approved', true)->count() }}</p>
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- left part end -->

            <!-- right start -->
            <div class="col-md-6">
                @foreach( $data as $product )
                <div class="right">
                    <h2>Add a review</h2>
                    <form action="{{ route('review.add', $product->id) }}" method="post" class="ajax-form">
                        @csrf

                        <div class="form-group">
                            <ul class="rating">
                                <li>
                                    <span class="ratingSelector">
                                        <input type="radio" name="star[0]" id="Degelijkheid-1-5" value="1" checked class="radio"/>
                                        <label class="full" for="Degelijkheid-1-5">
                                            <i class="fas fa-star"></i>
                                        </label>

                                        <input type="radio" name="star[0]" id="Degelijkheid-2-5" value="2" class="radio"/>
                                        <label class="full" for="Degelijkheid-2-5">
                                            <i class="fas fa-star"></i>
                                        </label>

                                        <input type="radio" name="star[0]" id="Degelijkheid-3-5" value="3" class="radio"/>
                                        <label class="full" for="Degelijkheid-3-5">
                                            <i class="fas fa-star"></i>
                                        </label>

                                        <input type="radio" name="star[0]" id="Degelijkheid-4-5" value="4" class="radio"/>
                                        <label class="full" for="Degelijkheid-4-5">
                                            <i class="fas fa-star"></i>
                                        </label>

                                        <input type="radio" name="star[0]" id="Degelijkheid-5-5" value="5" class="radio"/>
                                        <label class="full" for="Degelijkheid-5-5">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Your review</label>
                            <textarea name="review" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="form-group" style="text-align: center;">
                            <button type="submit" class="add-review">Add Review</button>
                        </div>

                    </form>
                </div>
                @endforeach
            </div>
            <!-- right end -->

            @if( $product->review->where('is_approve', true)->count() > 0 )
            <div class="review-block">
                <div class="row">
                    @foreach( $product->review->where('is_approved', true) as $review )
                    <!-- all customer review start -->
                    <div class="col-md-12 all-review">
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    @if( $review->star == 1 )
                                    <li><i class="fas fa-star"></i></li>
                                    @elseif( $review->star == 2 )
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    @elseif( $review->star == 3 )
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    @elseif( $review->star == 4 )
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    @elseif( $review->star == 5 )
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    {{ $review->review }}
                                </p>
                                <p> <b>{{ $review->customer->name }}</b> - {{ $review->created_at->toDayDateTimeString() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- all customer review end -->
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12" style="margin-top: 15px">
                <p class="alert alert-warning">No product review</p>
            </div>
            @endif

        </div>
        <!-- Reviews -->

        <!-- question and answer -->
        <div class="row product-list-row hide-detail qa">

            @if( auth('customer')->check() )
            <!-- question field start -->
            <div class="col-md-12 question-input">
                <form action="{{ route('question.add', $product->id) }}" method="post" style="margin-bottom: 0;" id="question-form">
                    @csrf
                    <div class="row left">
                        <div class="col-md-12">
                             <textarea class="form-control" rows="2" name="question" id="question" placeholder="Enter your question's here" required="" style="margin: 0px -5.5px 0px 0px; height: 120px;"></textarea>
                        </div>
                    </div>

                    <div class="row right">
                        <div class="col-md-8">
                            <p>
                                Your question should not contain contact information such as email, phone or external web links.
                            </p>
                        </div>

                        <div class="col-md-4 text-right">
                            <button type="submit">Ask Question</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- question field end -->

            <div class="col-md-12 mt-4 mb-4">
                <p style="border-bottom: 1px solid #f7f7f7;">My Questions</p>
            </div>

            <span class="d-block" style="width: 100%" id="product-question">
                @foreach( $product->question->where("customer_id",auth("customer")->user()->id) as $product_question )
                <!-- questions are here start -->
                <div class="col-md-12 question-block">
                    <div class="row">
                        <div class="left">
                            <span>Q</span>
                        </div>

                        <div class="right">
                            <p>{{ $product_question->question }}</p>
                            <small>{{ auth('customer')->user()->name }} - {{ $product_question->created_at->diffForHumans() }}</small>
                            @if($product_question->answer->first())
                            @else
                            <p class="mt-2">No answer yet</p>
                            @endif
                        </div>
                    </div>
                </div>
                @if($product_question->answer->first())
                <div class="col-md-12 question-block">
                    <div class="row">
                        <div class="left">
                            <span>A</span>
                        </div>

                        <div class="right">
                            <p>{{ $product_question->answer->first()->answer }}</p>
                            <small>{{ $product_question->answer->first()->user->name }} from AB Electronics - {{ $product_question->answer->first()->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endif
                <!-- questions are here end-->
                @endforeach
            </span>


            @else
            <div class="col-md-12 question-input">
                <i class="far fa-question-circle"></i>
                <p class="text-center">
                    There are no questions yet.
                    <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to ask abelectronics now and answer will show here.
                </p>
            </div>
            @endif

        </div>
        <!-- question and answer -->

        <!-- Product Warranty -->
        <div class="row product-list-row hide-detail product_warranty">
            <div class="col-md-12">
                {!! $product_warranty->product_warranty !!}
            </div>
        </div>
        <!-- Product Warranty -->

    </div>
</section>
<!-- product detail list end -->


<!-- related product start -->
@if( $related_products->count() > 0 )
<section class="related-product">
    <div class="container">

        <!-- title row start --->
        <div class="row">
            <div class="col-md-12 related-product-div">
                <h2>Product You May Like</h2>
            </div>
        </div>
        <!-- title row end --->

        <div class="row">
            <div class="related-product-carousel owl-carousel owl-theme">

                <!-- item start -->
                @foreach( $related_products as $product )
                <div class="item">
                    <div class="col-md-12">
                        <div class="product-box">
                            <a href="{{ route('productdetails', $product->slug) }}">
                                <img src="{{ asset('images/product/' . $product->thumbnail) }}" class="img-fluid" alt="">
                            </a>
                            <p class="product_name">{{ Str::limit($product->name, 45, '...') }}</p>
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
                                        <p onclick="addToWishlist({{ $product->id }})" data-toggle="tooltip" data-placement="bottom" title="Wishlist">
                                            <i class="fas fa-heart"></i>
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                        <p onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-placement="bottom" title="Compare">
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
                </div>
                @endforeach
                <!-- item end -->

            </div>
        </div>
    </div>
</section>
@endif
<!-- related product end -->

@endsection


@section('per_page_js')
<script src="{{ asset('frontend/assets/js/zoomsl.js') }}"></script>
<script>

$(document).ready(function(){
    $("#show-price-match-form").click(function(){
        $(".price-match-form").show();
        $("html,body").css({
            "overflow" : "hidden",
        })
    })
    $("#close-price-match-form").click(function(){
        $(".price-match-form").hide();
        $("html,body").css({
            "overflow" : "auto",
        })
    })

})

setInterval(function () {
            let day = $(".day").html()
            let hour = $(".hour").html()
            let min = $(".minute").html()
            let sec = $(".second").html();
            let sixty = 60
            let new_min = 2

            if (day == 0 && min < 58) {
                $(".day").html(0)
                $(".hour").html(0)
                $(".minute").html(0)
                $(".second").html(0)
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

$("#question-form").submit(function(e){

        e.preventDefault()
        $(".loader").show();

        let $this = $(this);
        let formData = new FormData(this);

        $this.find(".has-danger").removeClass('has-error');
        $this.find(".has-danger .form-control").css({
            'border': "none"
        });

        $this.find(".form-errors").remove();
        $this.find(".make-auth p").remove();

        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(response){
                $(".loader").hide();
                swal("","Question Added","success")

                if( response.error ){
                    swal("error",`${response.error}`,"error")
                }

                if( response.question_added ){
                    $("#product-question").append(`
                    <div class="col-md-12 question-block">
                        <div class="row">
                            <div class="left">
                                <span>Q</span>
                            </div>

                            <div class="right">
                                <p>${response.question_added.question}</p>
                                <small>${response.question_added.customer_id} - ${response.question_added.created_at}</small>
                                <p class="mt-2">No answer yet</p>
                            </div>
                        </div>
                    </div>
                    `);
                }
            },
            error: function(response){
                $(".loader").hide();
                data = response.responseJSON
                $.each(data.errors, (key, value) => {

                    $("[name^="+key+"]").parent().addClass('has-error')
                    $("[name^="+key+"]").parent().append('<small class="danger text-muted form-errors">'+value[0]+'</small>');
                })
            }
        })
    })

    // $(document).ready(function() {
    //     $(".product-detail-top .left .main-img img").hover(function(){

    //         $("#block__pic").imagezoomsl({
    //             zoomrange: [3, 3]
    //         });
    //     })

    // });

    function a(a){
        $("#"+ a).imagezoomsl({
            zoomrange: [3, 3],
            disablewheel: false,
        });
    }
    document.getElementById('Degelijkheid-1-5').checked = true;




</script>
@endsection

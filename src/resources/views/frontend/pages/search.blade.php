@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Search Result</title>
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

@section('body-content')

<!-- search section start -->
<section class="search-section">
    <div class="container">
        <div class="row">
            <h2>Search Result for "{{ $text }}"</h2>
        </div>
        <div class="row">
            @php
                $i = 0;
            @endphp
            @foreach( $search as $product )
                <div class="col-md-2 col-6">
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
                    @php
                        $i++;
                    @endphp
            @endforeach
            @if($i == 0)
            <div class="col-md-12">
                <p class="alert alert-warning">No product found in your search result for {{ $text }}</p>
            </div>
            @endif
        </div>
        <div class="row" style="padding: 30px 0">
            <div class="col-md-12">
                <ul class="pagination">
                    <li>{{ $search->links() }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->

@endsection

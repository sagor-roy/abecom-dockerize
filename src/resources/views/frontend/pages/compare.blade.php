@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Compare your products</title>
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
    .product-box:hover a::after{
      opacity: 1;
        /* top: 0%; */
        left: 250%!important;
        transition-property: left, top, opacity;
        transition-duration: 0.7s, 0.7s, 0.15s;
        transition-timing-function: ease;
    }
    .product-box a::after{
          display: none;
    }
    
</style>

@section('body-content')

<!-- compare section start -->
<section class="compare-section">
      <div class="container">

            <div class="row title">
                  <div class="col-md-12">
                        <h2>Compare Products</h2>
                  </div>
            </div>

            <div class="row compare-product-row">
                  
            </div>
            <div class="row no-compare-product">
                  <div class="col-md-12">
                        <p class="alert alert-warning">No product found in compare list</p>
                  </div>
            </div>

            <div class="cart-page-loading">
                  <img src="{{ asset('images/circle-preloader.gif') }}" alt="">
            </div>
            
      </div>


</section>
<!-- compare section start -->


@endsection
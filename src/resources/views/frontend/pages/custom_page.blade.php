@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - {{ $custom_page->name }}</title>
@endsection





@section('body-content')

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
                              {{ $custom_page->name }}
                         </a>
                    </li>
               </ul>
          </div>
     </div>
</section>
<!-- page indicator end -->


<!-- custom page start -->
<section class="about-information">
     <div class="container">
          <div class="row about-title">
               <div class="col-md-12 text-center">
                    <h2>{{ $custom_page->name }}</h2>
               </div>
          </div>

          <!-- custom content section start -->
          <div class="row about-content">
               <div class="col-md-12">
                    {!! $custom_page->content !!}
               </div>
          </div>
          <!-- custom content section end -->

     </div>
</section>
<!-- custom page end -->




@endsection
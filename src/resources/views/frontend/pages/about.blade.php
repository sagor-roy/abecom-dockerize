@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - About</title>
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
                    <a href="{{ route('about') }}">
                        About AB Electronics
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->


<!-- about information start -->
<section class="about-information">
    <div class="container">
        <div class="row about-title">
            <div class="col-md-12 text-center">
                <h2> <i class="fas fa-user"></i> ABOUT US</h2>
            </div>
        </div>

        <!-- iso certified row start -->
        <div class="row iso-certified" style="margin-bottom: 50px;">
            <!-- left part start -->
            <div class="col-md-2 left">
                @if(App\Models\About::get()->count() == 1)
                <img src="{{ asset('images/'. App\Models\About::first()->image) }}" class="img-fluid" alt="">
                @endif
            </div>
            <!-- left part end -->

            <!-- left part start -->
            <div class="col-md-10 right">
                <div class="right-box">
                    <h2>
                        @if(App\Models\About::get()->count() == 1)
                    {{ App\Models\About::first()->title_one }}
                    @endif
                    </h2>
                    <p>
                        @if(App\Models\About::get()->count() == 1)
                    {{ App\Models\About::first()->description_one }}
                    @endif
                    </p>
                </div>
            </div>
            <!-- left part end -->
        </div>
        <!-- iso certified row end -->

        <!-- about content section start -->
        <div class="row about-content" style="margin-bottom: 50px;">
            <div class="col-md-8 offset-md-2">
                <h2>
                    @if(App\Models\About::get()->count() == 1)
                {{ App\Models\About::first()->title_two }}
                @endif
                </h2>
                <p>
                    @if(App\Models\About::get()->count() == 1)
                {{ App\Models\About::first()->description_two }}
                @endif
                </p>
            </div>
        </div>
        <!-- about content section end -->

    </div>
</section>
<!-- about information end -->


<!-- card section start -->
<section class="card-section">
    <div class="container">
        <div class="row" style="margin-bottom: 50px;">

            <!-- card item start -->
            @foreach( App\Models\AboutBlock::orderBy("position","asc")->get() as $about_block )
            <div class="col-md-4">
                <div class="about-card-box">
                    @if( $about_block->icon == null )
                    <div class="card-title text-center">
                        <h2>{{ $about_block->text }}</h2>
                    </div>
                    @elseif( $about_block->text == null )
                    <div class="card-icon text-center">
                       <i class="{{ $about_block->icon }}"></i>
                    </div>
                    @endif
                    
                    
                    <div class="card-content">
                        <h2>{{ $about_block->title }}</h2>
                        <p>
                            {{ $about_block->description }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- card item end -->


        </div>
    </div>
</section>
<!-- card section end -->








<!-- certificate section start section start -->
<section class="card-section">
    <div class="container">

        <div class="row card-section-top" style="margin-bottom: 50px;">
            <div class="col-md-12">
                <h2>WE'RE AUTHORIZED FROM BRANDS YOU TRUST</h2>
            </div>
        </div>

        <div class="row" style="margin-bottom: 50px;">
            <div class="certificate-carousel owl-carousel owl-theme">

                <!-- item start -->
                @foreach( App\Models\AboutCertificate::all() as $certificate )
                <div class="item">
                    <a href="{{ $certificate->link }}">
                        <div class="col-md-12">
                            <div class="img-background">
                                <img src="{{ asset('images/certificate/'.$certificate->image) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <!-- item end -->

            </div>
        </div>

    </div>
</section>
<!-- certificate section start section end -->


<!-- map section start -->
<section class="map-section">
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 50px;">
            <div class="col-md-12">
                <div class="text-center">
                    <img src="{{ asset('images/about_us_image/'.$contact_detail->about_us_image) }}" alt="" width="1000px" height="600px">
                </div>
            </div>
        </div>
    </div>
</section>
<!---  map section end -->



@endsection




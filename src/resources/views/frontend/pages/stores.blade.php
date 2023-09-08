@extends('frontend.template.layout')

@section('meta')
    <!-- Title -->
    <title>AB Electronics - Our Stores</title>
@endsection

<style>
    .stores-office{
        padding: 15px 0;
            padding-bottom: 30px;
    }
    .stores-office-title{
        color: white;
        position: relative;
    }
    .store-office-info h2{
        color: #000000;
        margin: 10px 0;
    }
    .stores-office-title:before{
        content: "";
        position: absolute;
        /*background: #031b4e;*/
        width: 100%;
        height: 150px;
        z-index: -1;
        border-radius: 8px;
    }
    .store-info-blocks{
        margin: 0 auto;
        text-align: center;
        width: 100%!important;
        float: left;
        display: contents;
        
    }
    .store-info-block{

        text-align: center;
        display: block;
        width: 25%;
        margin: 0 auto;
        margin-top: 30px;
        border-bottom: 1px solid #f1f1f1;
        padding-bottom: 7.5px;
    }
    
    .store-map{
        border-radius: 100%;
        width: 200px;
        height: 200px;
        display: block;
        margin: 0 auto;
    }
    .store-map iframe{
        border: 0;
        width: 100%;
        border-radius: 100%;
        height: 100%;
        box-shadow: #031b4e 0px 0px 7px 2px;
    }

    @media( min-width: 320px ) and ( max-width: 768px ){
        .store-info-block {
            width: 100%;
        }
    }

    @media( min-width: 769px ) and ( max-width: 990px ){
        .store-info-block {
            width: 33.33%;
        }
    }

</style>

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
                        <a href="{{ route('stores') }}">
                            Stores
                        </a>
                    </li>
                </ul>
            </div>

            <!-- page title start -->
            <!--<div class="row">-->
            <!--    <div class="col-md-12">-->
            <!--        <h2 class="text-center">AB Electronics Registered Office</h2>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- page title end -->
        </div>
    </section>
    <!-- page indicator end -->


    <!-- ab head office information start -->
    <section class="stores-office">
        <div class="container">
            <div class="row stores-office-title">
                <!--<div class="col-md-12">-->
                <!--    <h2 class="text-center" >AB Electronics Head Office</h2>-->
                <!--</div>-->


                <!-- head office part start -->
                <div class="col-md-12 store-info-blocks">
                    <!-- blocks part start -->
                    <div class="store-info-block">
                        <div class="store-map">
                            @if( App\Models\ContactDetail::first() )
                                <iframe src="{{ App\Models\ContactDetail::first()->map }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            @endif
                        </div>
                        <div class="store-office-info">
                            <h2>AB Electronics Head Office</h2>
                            {!! App\Models\ContactDetail::first()->address !!}
                            <p>
                                <strong>  Hotline : </strong>
                                {{ App\Models\ContactDetail::first()->hotline }}
                            </p>
                            <p>
                                <strong>  Phone : </strong>
                                {{ App\Models\ContactDetail::first()->phone }}
                            </p>
                            <p>
                                <strong>  Email : </strong>
                                {{ App\Models\ContactDetail::first()->email }}
                            </p>
                        </div>
                    </div>
                    <!-- blocks part end -->
                </div>
                <!-- head office part end -->

            </div>
        </div>
    </section>
    <!-- ab head office information end -->

    <!-- ab head office information start -->
    @foreach( App\Models\OurStores::orderBy("position","asc")->where("parent_id",0)->get() as $key => $stores )
    <section class="stores-office">
        <div class="container">
            <div class="row stores-office-title">
                
                <div class="col-md-12">
                    <h2 class="text-center" style="color: black;">{{ $stores->name }}</h2>
                </div>


                <!-- head office part start -->
                <div class="col-md-12 store-info-blocks">

                    <!-- blocks part start -->
                    @foreach( $stores->child as $child )
                    <div class="store-info-block">
                        <div class="store-map">
                            <iframe src="{{ $child->map }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="store-office-info">
                            <h2>{{ $child->name }}</h2>
                            <p>
                                {{ $child->address }}
                            </p>
                            <p>
                                <strong>Hotline : </strong>
                                {{ $child->hotline }}
                            </p>
                            <p>
                                <strong>Phone : </strong>
                                {{ $child->phone }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                    <!-- blocks part end -->

                </div>
                <!-- head office part end -->

            </div>
        </div>
    </section>
    @endforeach
    <!-- ab head office information end -->







@endsection




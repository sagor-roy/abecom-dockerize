@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Service Complaint</title>
@endsection

<style>
    .submit-btn {
        background: #031b4e;
        color: white;
        padding: 5px 20px;
        border-radius: 30px;
        display: block;
        margin: 0 auto;
    }

    .submit-btn:hover {
        background: #ae0000
    }

    .form-part {
        background: #f3f3f3;
        height: 100%;
        border-radius: 5px;
    }

    .store-info {
        background: #f3f3f3;
        border-radius: 5px;
    }

    .form-part form {
        padding: 0 15px;
        padding-top: 15px;
    }

    .form-part h2,
    .store-info-title h2 {
        padding: 5px 15px;
        border-bottom: 1px solid white;
        border-radius: 5px 5px 0 0;
    }

    .store-info-title {
        background: #f3f3f3;
    }

    .form-part-div {
        padding-right: 0 !important
    }

    .store-info {
        padding: 15px;
    }

    .store-info p {
        padding-bottom: 10px
    }

    .map-div iframe {
        width: 100%;
        height: 100%;
        border-radius: 5px;
    }

    @media (min-width: 320px) and (max-width: 500px) {
        .form-part-div {
            padding-right: 15px !important;
            margin-bottom: 15px
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
                    <a href="{{ route('corporate_sale') }}">
                        Corporate Sales
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- page indicator end -->


<!-- about information start -->
<section class="corporatesale-information">
    <div class="container">
        <div class="row about-title">
            <div class="col-md-12 text-center">
                <h2> <i class="fas fa-truck"></i> Customer Complaint Form</h2>
            </div>
        </div>
    </div>
</section>
<!-- about information end -->


<!-- card section start -->
<section class="card-section">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <p class="text-justify">
                    {!! App\Models\ContactDetail::first()->service_complaint !!}
                </p>
            </div>

        </div>
    </div>
</section>
<!-- card section end -->



<!-- corporate sale form start -->
<section class="about-information">
    <div class="container">

        <!-- form and store start -->
        <div class="row">

            <!-- form part start -->
            <div class="col-md-12 form-part-div">
                <div class="form-part">
                    <h2 style="background: #031b4e; color: white">Your Complain </h2>
                    <form action="{{ route('service.complaint.add') }}" method="post" class="ajax-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Name *</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Phone</label>
                                <input type="phone" class="form-control" name="phone" placeholder="01*********">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Showroom *</label>
                                <input type="text" class="form-control" name="showroom">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Order Number / Invoice Number *</label>
                                <input type="text" class="form-control" name="invoice">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Product Brand *</label>
                                <input type="text" class="form-control" name="p_brand">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Product Type </label>
                                <input type="text" class="form-control" name="p_type">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Product Model Number </label>
                                <input type="text" class="form-control" name="p_model_number">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Subject* </label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Complain/Problem Description* </label>
                                <textarea name="complain" rows="3" class="form-control"></textarea>
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <button type="submit" class="submit-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- form part end -->

        </div>
        <!-- form and store end -->

    </div>
</section>
<!-- corporate sale form end -->




@endsection

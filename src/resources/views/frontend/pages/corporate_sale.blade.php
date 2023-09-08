@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Corporate Sales</title>
@endsection

<style>

    .submit-btn{
        background: #031b4e;
        color: white;
        padding: 5px 20px;
        border-radius: 30px;
        display: block;
        margin: 0 auto;
    }
    .submit-btn:hover{
        background: #ae0000
    }
    .form-part{
        background: #f3f3f3;
        height: 100%;
        border-radius: 5px;
    }
    .store-info{
        background: #f3f3f3;
        border-radius: 5px;
    }
    .form-part form{
        padding: 0 15px;
        padding-top: 15px;
    }
    .form-part h2,
    .store-info-title h2{
        padding: 5px 15px;
        border-bottom: 1px solid white;
        border-radius: 5px 5px 0 0;
    }
    .store-info-title{
        background: #f3f3f3;
    }
    .form-part-div{
        padding-right: 0!important
    }
    .store-info{
        padding: 15px;
    }
    .store-info p{
        padding-bottom: 10px
    }
    .map-div iframe{
        width: 100%;
        height: 100%;
        border-radius: 5px;
    }

    @media (min-width: 320px) and ( max-width: 500px ){
        .form-part-div{
            padding-right: 15px!important;
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
                <h2> <i class="fas fa-tags"></i> Corporate Sales</h2>
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
                {!! App\Models\ContactDetail::first()->corporate_sale !!}
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
                    <h2 style="background: #031b4e; color: white">Your Enquiry</h2>
                    <form action="{{ route('corporate.sale.add') }}" method="post" class="ajax-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Name *</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Company Name *</label>
                                <input type="text" class="form-control" name="company">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Phone *</label>
                                <input type="phone" class="form-control" name="phone" placeholder="01*********">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Email Address *</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Address *</label>
                                <textarea name="address" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">City *</label>
                                <input type="text" class="form-control" name="city" >
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Country *</label>
                                <input type="text" class="form-control" name="country">
                            </div>
                            <div class="col-md-12 form-group">
                            <label for="">Enquiry Type *</label>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="enquiry_type">
                                            B2B Enquiry
                                        </label>
                                        <input type="radio" class="form-control-check" name="enquiry_type" value="B2B_Enquery" placeholder="Corporate Business">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="enquiry_type">
                                            B2G Enquiry
                                        </label>
                                        <input type="radio" class="form-control-check" name="enquiry_type" value="B2G_Enquiry" placeholder="Dealer Business">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="enquiry_type">
                                            Corporate Business
                                        </label>
                                        <input type="radio" class="form-control-check" name="enquiry_type" value="Corporate_Business" placeholder="B2G Enquiry">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Your Enquiry *</label>
                                <textarea name="message" rows="3" class="form-control"></textarea>
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

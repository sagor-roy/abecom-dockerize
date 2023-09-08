@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Guest Checkout Page</title>
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
.choose-pickup-point{
      display: none;
}
#thana{
    height: 25px;
    padding: 2px 10px;
}
</style>

@section('body-content')

<!-- checkout main section start -->
<section class="checkout section-padding">
    <div class="container">

        <!-- progress row start -->
        {{-- <div class="row checkout-block">
                  <div class="col-md-12">
                        <div class="progress-bar">
                              <div class="step">

                                    <div class="bullet">
                                          <span>1</span>
                                          <div class="check">
                                          <i class="fas fa-check"> </i>
                                          </div>
                                    </div>
                                    <p>Cart Details</p>
                              </div>
                              <div class="step">

                                    <div class="bullet">
                                          <span>2</span>
                                          <div class="check">
                                          <i class="fas fa-check"> </i>
                                          </div>
                                    </div>
                                    <p>Shipping Details</p>
                              </div>
                        </div>
                  </div>
            </div> --}}
        <!-- progress row end -->

        <!-- form item row start -->
        <div class="row checkout-block">
            <div class="col-md-12 checkout-div">
                <div class="form-outer">
                    <form action="{{ route('guest.verification') }}" id="guest_checkout_form" method="post">
                        @csrf

                        <!-- page one start start -->
                        <div class="page slidepage first-page">

                            <div class="row" style="padding: 15px;">
                                <!-- cart part start -->
                                <div class="col-md-8 " id="checkout-page-cart-show" style="background: #f2f2f2">
                                    <h2 style="text-align: left">Order Details</h2>
                                    <!-- cart item start -->
                                    <!-- custom.js -->
                                    <!-- cart item end -->

                                </div>
                                <!-- cart part end-->

                                <!-- order summary start -->
                                <div class="col-md-4 order-summary-div">
                                    <h2 style="border-bottom: 2px solid white;
                                                      text-align: center;
                                                      background: #f2f2f2;">Order Summary</h2>
                                    <div class="order-summary" style="background: #f2f2f2;">
                                        <div class="cart-price">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <p>Cart Total</p>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <p style="text-align: right" id="sub_total"> <span></span> BDT</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <p>Shipping and Handling</p>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <p style="text-align: right" class="shipping_charge"></p>
                                                </div>
                                            </div>

                                            <div class="total row">
                                                <div class="col-md-6 col-3">
                                                    <p>Total</p>
                                                </div>
                                                <div class="col-md-6 col-9">
                                                    <h2 class="total_price"><span></span></h2>
                                                    <!-- <small style="display: block; text-align: right;">Without Shipping
                                                        Charge</small> -->
                                                </div>
                                            </div>
                                            <!-- page change start -->
                                            <div class="row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="form-group nextBtn text-right confirm-order">
                                                        <p>Confirm Order</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- page change end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- order summary end -->
                            </div>



                        </div>
                        <!-- page one start end -->

                        <!-- page two start start -->
                        <div class="page second-page">
                            
                            <!-- Checkout Page NB Start -->
                            <div class="row" style="padding: 15px 0 15px 0;">
                                <div class="col-md-12">
                                    @if ($checkout_page_nb->checkout_page_nb != null)
                                    <div class="card">
                                        <div class="card-body">
                                            {!! $checkout_page_nb->checkout_page_nb !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Checkout Page NB Start -->

                            <!-- form start -->
                            <div class="row" style="padding: 0 15px;">

                                <div class="col-md-8">
                                    <div class="row" style="background: #f2f2f2;
                                                      border-bottom: 2px solid white;">
                                        <div class="col-md-12">
                                            <h2>Shipping Address</h2>
                                        </div>
                                    </div>
                                    <div class="row" style="background: #f2f2f2;">
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Name</label>
                                            <input type="text" name="name" placeholder="Your name" class="form-control"
                                                id="name" />
                                        </div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Your Email"
                                                class="form-control" />
                                        </div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Phone number</label>
                                            <input type="text" id="phone" name="phone" placeholder="01*********"
                                                class="form-control" />
                                        </div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">City</label>
                                            <select onchange="set_thana()" name="city" class="form-control" id="chosen">
                                                @foreach( $cities as $city )
                                                <option value="{{ $city->id }}" @if( strtolower($city->city) == 'dhaka'
                                                    ) selected @endif >{{ $city->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Thana</label>
                                            <select name="thana" class="form-control" id="thana">

                                            </select>
                                        </div>

                                        <div class="col-md-6" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Country</label>
                                            <select name="country" class="form-control country-field" id="chosen2">
                                                <option disabled>Please choose your country</option>
                                                <option value="Bangladesh" selected>Bangladesh</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 courier-here">

                                        </div>

                                        <!-- choose delivery type -->
                                        <div class="col-md-12 delivery-type" style="margin-top: 15px;">
                                            <label>Choose Delivery Type</label>
                                            <div class="form-check">
                                                    <input class="form-check-input" checked type="radio" value="Home" name="delivery_type"
                                                    id="homedelivery">
                                                    <label class="form-check-label" for="homedelivery">
                                                    Home Delivery
                                                    </label>
                                            </div>
                                            <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Local" name="delivery_type"
                                                    id="localpickup"  >
                                                    <label class="form-check-label" for="localpickup">
                                                    Local Pickup
                                                    </label>
                                            </div>
                                        </div>

                                        <!-- choose pickup point dropdown -->
                                        <div class="col-md-12 choose-pickup-point" style="margin-top: 15px;">
                                            <select name="pickup_point" class="form-control chosen">
                                                    <option disabled selected>Choose your nearest pickup point</option>
                                                    @foreach( App\Models\PickUp::orderBy('id','desc')->where('is_active',
                                                    true)->select("id","name")->get() as $pickup )
                                                    <option value="{{ $pickup->id }}" >{{ $pickup->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Address</label>
                                            <input class="form-control" id="address" placeholder="Address"
                                                name="address" value="">
                                        </div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <label style="text-align:left;display: block;">Order Note</label>
                                            <textarea class="form-control" name="note" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-12 payment-method" style="margin-top: 15px;">
                                            <p>Please select your payment method</p>
                                            <div class="form-check">
                                                <p>Cash on delivery</p>
                                                <label class="switch">
                                                    <input type="radio" name="payment_method" value="0" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <p>Bank Payment</p>
                                                <label class="switch">
                                                    <input type="radio" name="payment_method" value="1">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <p>Bank Deposite</p>
                                                <label class="switch">
                                                    <input type="radio" name="payment_method" value="2">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="bankPayment" class="col-12 d-none" style="padding: 15px">
                                            {!! $bank_payment ? $bank_payment->description : '' !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- order summary start -->
                                <div class="col-md-4 order-summary-div">
                                    <h2 style="border-bottom: 2px solid white;
                                                      text-align: center;
                                                      background: #f2f2f2;">Order Summary</h2>
                                    <div class="order-summary" style="background: #f2f2f2;">
                                        <div class="cart-price">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <p>Sub Total</p>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <p style="text-align: right" id="sub_total"> <span></span> BDT</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <p>Shipping Charge</p>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <p style="text-align: right" class="shipping_charge"></p>
                                                </div>
                                            </div>

                                            <div class="total row">
                                                <div class="col-md-6 col-3">
                                                    <p>Total</p>
                                                </div>
                                                <div class="col-md-6 col-9">
                                                    <h2 class="total_price"><span></span></h2>
                                                    <!-- <small style="display: block; text-align: right;">Without Shipping
                                                        Charge</small> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- order summary end -->

                            </div>

                            <!-- form end -->

                            <!-- page change start -->
                            <div class="row">
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <div class="form-group nextBtn text-right place-order">
                                        <p class="prev-1 prev">Go Back</p>
                                        <button type="submit" class="place-order" id="place-order">Place Order</button>
                                        <div class="email-verification">
                                            <i class="fas fa-times" id="close-email-verification-popup"></i>
                                            <div class="verification-form">
                                                <h2>Verify your email address</h2>
                                                <div class="form-here">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- page change end -->
                        </div>
                        <!--page two end -->

                    </form>
                </div>
            </div>
        </div>
        <!-- form item row end -->

        <!-- cart empty start -->
        <div class="row" id="cart-empty">
            <div class="col-md-12">
                <a href="{{ route('shop') }}">
                    <img src="{{ asset('images/cart-empty.jpg') }}" alt="">
                </a>
            </div>
        </div>
        <!-- cart empty end -->

        <div class="cart-page-loading">
            <img src="{{ asset('images/circle-preloader.gif') }}" alt="">
        </div>

    </div>
</section>
<!-- checkout main section end -->

@endsection


@section('per_page_js')

<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<!-- step bar js start -->
<script src="{{ asset('frontend/assets/js/step.js') }}"></script>

<script>

let cities = {!! json_encode($cities) !!};

function set_thana(){
    const city_id = $("#chosen").val();
    const city = cities.find(element => element.id == city_id);

    $("#thana").html('<option value="">Select Thana</option>');

    $.each(city.thanas, function (id, thana) {
        $('#thana').append(`<option value="${thana.id}"> ${thana.thana} </option>`);
    });
}

set_thana()


$("input[name*='payment_method']").change(function(){
    if($(this).val() == 2){
    $("#bankPayment").removeClass("d-none");
    } else {
    $("#bankPayment").addClass("d-none");
    }
})

$(document).on("click",".delivery-type .form-check-input", function(){
      let $this = $(this)

      if( $this.val() == "Home" ){
            $(".choose-pickup-point").hide()
      }
      else if( $this.val() == "Local" ){
            $(".choose-pickup-point").show()
      }
})
</script>

<script>
    $("#chosen").chosen()
    $(".chosen").chosen()
    $("#chosen2").chosen()


    $("#close-email-verification-popup").click(function () {
        $(".email-verification").fadeOut();
        $(".form-here").remove()
    })

    //city on change
    $(".city-select-box").on('change', function () {
        $(".loader").show()
        let id = $(this).val()
        $.ajax({
            type: "GET",
            url: "/courier/" + id,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                $(".loader").hide()
                if (response.show_courier) {

                    if ($(".courier-here").children()) {
                        $(".courier-here").children().remove()
                    }

                    let shipping_charge = $(".shipping_charge").html();
                    if( shipping_charge == "Courier Charge Only" ){
                        let total = $(".total_price").data('total');
                        let sub_total = $("#sub_total span").html(); 
                        $(".total_price span").html(  parseInt(total) - (parseInt(total) - parseInt(sub_total)) + " BDT")
                        $(".shipping_charge").html('Courier Charge Only')
                    }
                    else{
                        let total = $(".total_price").data('total');
                        $(".total_price span").html( (parseInt(total) - parseInt(shipping_charge) ) + " BDT")
                        $(".shipping_charge").html('Courier Charge Only')
                    }

                    $(".courier-here").append(`
                              <label style="text-align:left;display: block;margin-top: 10px">Choose Your Courier Service</label>
                              <select name="courier" class="form-control courier-select-box" id="chosen3">
                                    <option disabled selected>Please choose your courier name</option>
                                    @foreach( App\Models\Courier::orderBy('id','desc')->where('is_active', true)->get() as $courier )
                                    <option value="{{ $courier->id }}">{{ $courier->courier }}</option>
                                    @endforeach
                              </select>
                              `)
                }
                if (response.hide_courier) {
                    $(".shipping_charge").html(response.delivery_charge + " BDT")

                    let total = $(".total_price").data('total');

                              $(".total_price span").html(parseInt(total) + " BDT")

                    if ($(".courier-here").children()) {
                        $(".courier-here").children().remove()
                    }
                }

                if (response.error) {
                    swal("Error", `${response.error}`, "error")
                }

            },
            error: function () {
                $(".loader").hide()
            }
        })
    })
    $(".courier-here #chosen3").chosen()


    $("#guest_checkout_form").submit(function (e) {
        $(".loader").show()
        e.preventDefault()


        $(".form-errors").remove();

        let $this = $(this);
        let formData = new FormData(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                $(".loader").hide()
                if (response.guest_verified) {
                    $(".email-verification").fadeIn();
                    $(".verification-form").append(`
                                    <div class="form-here">
                                          <form action="{{ route('do.guest.checkout') }}" id="verify_email" method="post" style="display: unset">
                                                @csrf
                                                <div class="form-group">
                                                      <label>Enter the verification code we already sended in your given email address</label>
                                                      <input type="text" class="form-control" name="verify_code">
                                                </div>
                                                <div class="form-group" style="text-align: center">
                                                      <button type="submit" class="verify-btn">Verify</button>
                                                </div>
                                          </form>
                                    </div>
                              `);
                }
            },
            error: function (response) {
                $(".loader").hide()

                data = response.responseJSON

                if (data.errors) {
                    swal("", "Please give us valid information", "error")
                }
                $.each(data.errors, (key, value) => {
                    $("[name^=" + key + "]").parent().addClass('has-error')
                    $("[name^=" + key + "]").parent().append(
                        '<small class="danger text-muted form-errors">' + value[0] +
                        '</small>');
                })
            }
        })
    })

    $(".verification-form").on('submit', "#verify_email", function (e) {

        $(".loader").show()
        e.preventDefault()
        $(".form-errors").remove();

        let $this = $(this);
        let formData = new FormData(this);

        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                $(".loader").hide()
                if (response.cart_empty) {
                    swal("", `${response.cart_empty}`, "error")
                    cartLoad()
                }
                if (response.invalid_guest) {
                    swal("Error Found", `${response.invalid_guest}`, "error")
                }
                if (response.error) {
                    swal("Error", `${response.error}`, "error")
                }
                if (response.onspot_order_placed) {
                    swal("Thanks for your order", `${response.onspot_order_placed}`, "success")
                    cartLoad()
                }
                if (JSON.parse(response).GatewayPageURL) {
                    swal("Thanks for your order", "Redirecting to the ssl commerz checkout",
                        "success")
                    let redirectURl = JSON.parse(response).GatewayPageURL
                    return window.location.href = redirectURl
                    cartLoad()
                }
            },
            error: function (response) {
                $(".loader").hide()
                data = response.responseJSON
                if (data.errors) {
                    swal("", "Please give us valid information", "error")
                }
                $.each(data.errors, (key, value) => {
                    $("[name^=" + key + "]").parent().append(
                        '<small class="form-errors" style="color: red!important;position: absolute;left: 30px;">' +
                        value[0] + '</small>');
                })
            }
        })
    })

</script>

@endsection

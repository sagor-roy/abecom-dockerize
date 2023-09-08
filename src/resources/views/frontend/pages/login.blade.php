@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Login Here</title>
@endsection


<style>
      #guest-checkout{
            display: none;
      }
      .auth-section{
            padding: 30px 0;
      }
      .auth-box .form-control:focus{
            border: 1px solid #efef48;
      }
      .do-auth{
            margin: 0 auto;
            padding: 5px 40px;
            border-radius: 5px;
            background: #031b4e;
            color: white;
            border: none;
      }
      .do-auth-2{
            margin: 0 auto;
            padding: 6px 40px;
            border-radius: 5px;
            background: #ae0101;
            color: white!important;
            border: none;
      }
      .make-auth{
            text-align: center;
      }
      .auth-facebook{
            background: #1877f2;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
      }
      .auth-google{
            background: #dd4d42;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
      }
      .auth-mobile{
            background: #031b4e;
            color: white!important;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
      }
      .auth-box{
            background: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
      }
      .input-group-text{
            border-radius: unset!important;
      }
      .input-group > .form-control:not(:first-child), .input-group > .custom-select:not(:first-child){
            border-radius: unset;
      }
      .mobile-login-popup{
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background: rgba(1,1,1,0.5);
            z-index: 5;
            display: none;
      }
      .mobile-login-popup .fa-times{
            color: #000000;
            position: fixed;
            right: 15px;
            top: 15px;
            background: white;
            padding: 10px 15px;
            cursor: pointer;
      }
      .mobile-login-form{
            position: fixed;
            left: 50%;
            top: 50%;
            background: white;
            height: max-content;
            width: 50%;
            transform: translate(-50%,-50%);
            padding: 15px;
      }
      .otp-form{
            position: fixed;
            left: 50%;
            top: 50%;
            background: white;
            height: max-content;
            width: 50%;
            transform: translate(-50%,-50%);
            padding: 15px;
            
      }
      .mobile-login-form .form .submit,
      .otp-form .form .submit{
            display: block!important;
            margin: 0 auto;
            margin-top: 15px;
            border-radius: 30px;
      }
      .otp-form .form .re-send-otp{
            display: block!important;
            margin: 0 auto;
            margin-top: 15px;
            border-radius: 30px;
            background: #ae0000;
            color: white; 
      }
      .loading{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(1,1,1,0.5);
            z-index: 5;
            height: 100%;
            display: none;
      }
      .loading img{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            width: 5%;
      }

      @media( min-width: 320px ) and ( max-width: 768px ){
            .mobile-login-form{
                  width: 70%;
            }
      }
</style>

@section('body-content')
<!-- login start -->
<section class="auth-section">
      <div class="container">
            <div class="row">
                  <div class="col-md-12" style="text-align:center">

                        <div id="guest-checkout">
                              or,
                              <a href="{{ route('guest.checkout') }}">Checkout as a guest</a>
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4 offset-md-4">
                        <div class="auth-box">
                              @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ session()->get('success') }}</p>
                                    </div>
                              @endif
                              @if(session()->has('failed'))
                                    <div class="alert alert-danger">
                                        <p>{{ session()->get('failed') }}</p>
                                    </div>
                              @endif
                              <h2 class="text-center">Sign In</h2>
                              <form action="{{ route('login') }}" class="ajax-form" method="post">
                                    <div class="input-group mb-4 mt-3">
                                          <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-user"></i>
                                          </span>
                                          <input type="text" name="email" class="form-control" placeholder="PHONE NUMBER OR EMAIL" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3 mt-3">
                                          <span class="input-group-text" id="basic-addon2">
                                                <i class="fas fa-key"></i>
                                          </span>
                                          <input type="password" name="password" class="form-control" placeholder="Enter your password" aria-label="Password" aria-describedby="basic-addon2">
                                    </div>
                                    <div class="form-group make-auth">
                                          <button class="do-auth">Sign In</button>
                                          <a class="do-auth-2" href="{{ route('register') }}">
                                                Sign Up
                                          </a>
                                    </div>
                                    <div class="form-group text-center">
                                          <a href="{{ route('forget.email') }}">Forget your password?</a>
                                    </div>
                                    <div class="form-group text-center">
                                         <label >Login with your social media account</label>
                                    </div>
                                    <div class="form-group text-center">
                                          <a href="{{ route('facebook.login') }}" class="auth-facebook"> <i class="fab fa-facebook-f"></i> Facebook</a>
                                          <a href="{{ route('google.login') }}" class="auth-google"> <i class="fab fa-google"></i> Google</a>
                                          <a class="auth-mobile" > 
                                          <i class="fas fa-phone"></i> 
                                          Mobile
                                          </a>
                                    </div>
                              </form>
                        </div>
                        
                        <div class="mobile-login-popup">
                              <i class="fas fa-times"></i>
                        </div>

                        <div class="loading">
                              <img src="{{ asset('images/circle-preloader.gif') }}" alt="">
                        </div>

                  </div>
            </div>
      </div>
</section>
<!-- login start -->
@endsection



@section('per_page_js')
<script>

//show popup
$(".auth-mobile").click(function(){
      $(".mobile-login-popup").show();

      $(".mobile-login-popup").append(`
      <div class="mobile-login-form">
            <div class="title">
                  <h2 class="text-center">
                        LOGIN WITH MOBILE
                  </h2>
            </div>
            <div class="message">
                  <div class="alert alert-success">
                        <p>
                        <i class="fas fa-check-circle"></i>
                        We will send you one time password in this number.
                        </p>
                  </div>
            </div>
            <div class="form">
                  <label for="">Phone Number*</label>
                  <input type="text" class="form-control" name="phone" placeholder="01*********">
                  <button type="button" class="submit">Send</button>
            </div>
      </div>
      `);
})

//send otp
$(document).on("click",".mobile-login-form .form .submit", function(){
      let $this = $(this)
      const number = $this.closest(".form").find("input").val()

      if( number ){
            var regexPattern=new RegExp(/^[0-9]+$/);
            if( regexPattern.test(number) == true ){
                  $(".loading").show()

                  $.ajax({
                        type: "GET",
                        url: "{{ route('mobile.login') }}",
                        data: {
                              phone : number
                        },
                        success: function (response) {
                              if( response.success ){
                                    console.log(response);
                                    $(".loading").hide()
                                    swal("",`${response.success}`,"success");
                                    $(".mobile-login-popup .mobile-login-form").remove();
                                    $(".mobile-login-popup").append(`
                                    <div class="otp-form">
                                          <div class="title">
                                                <h2 class="text-center">
                                                VERIFY YOUR MOBILE NUMBER
                                                </h2>
                                          </div>
                                          <div class="message">
                                                <div class="alert alert-success">
                                                      <p>
                                                      <i class="fas fa-check-circle"></i>
                                                      Enter the OTP sent to <span>${response.number}</span>
                                                      </p>
                                                </div>
                                          </div>
                                          <div class="form">
                                                <label for="">OTP*</label>
                                                <input type="text" class="form-control" name="otp">
                                                <button type="button" class="submit">Submit</button>
                                          </div>
                                          <div class="form">
                                                <button type="button" class="re-send-otp">Re-send OTP</button>
                                          </div>
                                    </div>
                                    `);
                              }
                              if( response.error ){
                                    $(".loading").hide()
                                    swal("",`${response.error}`,"error")
                              }
                        },
                        error: function (response) {
                        
                        }
                  })

            }
            else{
                  swal("","Please give a valid phone number","warning")
            }
      }
      else{
            swal("","Please give a valid phone number","warning")
      }
})

//otp validation and login
$(document).on("click",".otp-form .form .submit", function(){
      let $this = $(this)
      const otp = $this.closest(".form").find("input").val()
      const number = $(".otp-form .message span").html();
      
      if( otp ){
            var regexPattern = new RegExp(/^[0-9]+$/);
            if( regexPattern.test(otp) == true ){
                  $(".loading").show()
                  $.ajax({
                        type: "GET",
                        url: "{{ route('otp.validation') }}",
                        data: {
                              data_otp : otp,
                              data_number : number
                        },
                        success: function (response) {
                              if( response.error ){
                                    $(".loading").hide()
                                    swal("",`${response.error}`,"error");
                              }
                              if( response.profile ){
                                    $(".loading").hide()
                                    swal("","Login Successfully Done. Redirecting Please Wait","success");
                                    return window.location.href = response.profile
                              }
                        },
                        error: function (response) {
                        
                        }
                  })
            }
            else{
                  swal("","Please give an valid otp","warning")
            }
      }
      else{
            swal("","Please give an valid otp","warning")
      }
})

//re send otp
$(document).on("click",".otp-form .form .re-send-otp", function(){
      let $this = $(this)
      const number = $(".otp-form .message span").html();
      $(".loading").show()
      $.ajax({
      type: "GET",
      url: "{{ route('mobile.login') }}",
      data: {
            phone : number
      },
      success: function (response) {
            if( response.success ){
                  $(".loading").hide()
                  swal("",`${response.success}`,"success");
            }
      },
      error: function (response) {
      
      }
})
})

//close popup
$(document).on("click",".mobile-login-popup .fa-times", function(){
      $(".mobile-login-popup").hide();
      $(".mobile-login-popup .mobile-login-form").remove();
      $(".mobile-login-popup .otp-form").remove();
})

</script>
@endsection

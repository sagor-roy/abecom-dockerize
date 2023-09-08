<!-- ========== FOOTER ========== -->


<footer>

      <!-- Footer-newsletter -->
      <div class="bg-primary py-3 footer-newsletter">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-3 mb-md-3 mb-lg-0 newsletter-left">
                        <ul>
                            <li>
                                <i class="ec ec-newsletter font-size-40" style="color: white;"></i>
                            </li>
                            <li>
                                <h2 class="font-size-20 mb-0 ml-3" style="color: white;">Sign up to Newsletter</h2>
                            </li>
                        </ul>
                  </div>
                  <div class="col-lg-6">
                      <!-- Subscribe Form -->
                      <form class="js-validate js-form-message ajax-form" action="{{ route('email.subscribe') }}" method="post">
                          @csrf
                          <label class="sr-only" for="subscribeSrEmail">Email address</label>
                          <div class="input-group input-group-pill">
                              <input type="text" class="form-control border-0 height-40" name="subscribe_email"
                                  id="subscribeSrEmail" placeholder="Email address" aria-label="Email address"
                                  aria-describedby="subscribeButton"
                                  data-msg="Please enter a valid email address.">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2"
                                      id="subscribeButton" style="border-radius: 0 30px 30px 0;">Subscribe</button>
                              </div>
                          </div>
                      </form>
                      <!-- End Subscribe Form -->
                  </div>

                  <div class="col-lg-3">
                      <div class="right">
                          <ul>
                              @foreach( App\Models\SocialMedia::all() as $media )
                              <li>
                                  <a href="{{ $media->link }}" target="_blank">
                                      <i class="{{ $media->icon }}"></i>
                                  </a>
                              </li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Footer-newsletter -->


      <!-- footer top start -->
      <section class="footer-top" style="border-bottom:1px solid #f3f1f1">
          <div class="container">
              <div class="row">

                  <!-- item start -->
                  <div class="col-md-2 col-12">
                      <div class="item">
                          <div class='footer-hotline'>
                              <div class='footer-hotline-left'>
                                  <i class='fas fa-phone'></i>
                                  <p>Helpline</p>
                              </div>

                          </div>
                          <h2 style='color: #ae0000;'>{{ App\Models\ContactDetail::first()->hotline }}</h2>
                          <p>( {{ App\Models\ContactDetail::first()->open_time }} - {{ App\Models\ContactDetail::first()->close_time }} )</p>
                      </div>
                  </div>
                  <!-- item end -->

                  <!-- item start -->
                  <div class="col-md-2 col-6">
                      <div class="item item-block">
                          <i class="fas fa-truck"></i>
                          <p>Free cash on delivery countrywide</p>
                      </div>
                  </div>
                  <!-- item end -->

                  <!-- item start -->
                  <div class="col-md-2 col-6">
                      <div class="item item-block">
                          <i class="fas fa-credit-card"></i>
                          <p>Up to 12 months 0% EMI facilities</p>
                      </div>
                  </div>
                  <!-- item end -->

                  <!-- item start -->
                  <div class="col-md-2 col-6 ">
                      <div class="item item-block">
                          <i class="fas fa-shield-alt"></i>
                          <p>Standard warranty policy</p>
                      </div>
                  </div>
                  <!-- item end -->

                  <!-- item start -->
                  <div class="col-md-2 col-6">
                      <div class="item item-block">
                          <i class="fas fa-thumbs-up"></i>
                          <p>Highest quality guarantee</p>
                      </div>
                  </div>
                  <!-- item end -->



              </div>
          </div>
      </section>
      <!-- footer top end -->


      <!-- Footer-bottom-widgets -->
      <div class="pt-4 pb-4">
          <div class="container mt-1">
              <div class="row">
                  <div class="col-lg-3" style="position: relative">
                      <div class="mb-6 footer-logo">
                        <a href="{{ route('home')  }}" class="d-inline-block " >
                            @php
                                $footer_logo = App\Models\ContactDetail::first()->footer_logo;
                            @endphp
                            <img src="{{ asset('images/logo/'.$footer_logo) }}"  alt="">
                        </a>

{{--                        <div class="helpline" style="display: none">--}}
{{--                            <p class="address_div">--}}
{{--                                <div class="address_div_left">--}}
{{--                                    <i class="fas fa-map-marker-alt" style="color: #ae0000;"></i>--}}
{{--                                </div>--}}
{{--                                 <div class="address_div_right">--}}
{{--                                     <b>Address : </b>  {!! App\Models\ContactDetail::first()->address !!}--}}
{{--                                 </div>--}}
{{--                            </p>--}}
{{--                            <br>--}}

{{--                            <p class="address_div">--}}
{{--                            <div class="address_div_left">--}}
{{--                                <i class="fas fa-phone" style="color: #ae0000;"></i>--}}
{{--                            </div>--}}
{{--                            <div class="address_div_right">--}}
{{--                                <b>Phone :</b> +88{{ App\Models\ContactDetail::first()->hotline }}--}}
{{--                            </div>--}}
{{--                            </p>--}}

{{--                            <br>--}}


{{--                            <p>--}}
{{--                            <div class="address_div_left">--}}
{{--                                <i class="fas fa-envelope" style="color: #ae0000;"></i>--}}
{{--                            </div>--}}
{{--                            <div class="address_div_right">--}}
{{--                                <b>Email :</b> {{ App\Models\ContactDetail::first()->email }}--}}
{{--                            </div>--}}
{{--                            </p>--}}
{{--                            <h2></h2>--}}


{{--                        </div>--}}


                      </div>
                  </div>
                  <div class="col-lg-9">
                      <div class="row footer-right-item">

                            @foreach( $footer_widgets as $footer_widget )
                            <div class="col-12 col-md-3 mb-4 mb-md-0">
                                <h2>{{ $footer_widget->widget }}</h2>
                                @foreach( $footer_widget->customer_pages->where("is_active",true) as $custom_page )
                                <ul>
                                    <li>
                                        <a 
                                        @if( $custom_page->type == "Link" ) href="{{ $custom_page->link }}" target="_blank" @else href="{{ route('frontend.custom.page', $custom_page->slug) }}" @endif>{{ $custom_page->name }}</a>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            @endforeach

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Footer-bottom-widgets -->

      <!-- pay with start -->
      <section class="pay-with">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <ul>
                          <li>Pay With</li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/visa.png') }}" alt="">
                          </li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/amex.png') }}" alt="">
                          </li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/master.png') }}" alt="">
                          </li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/bkash.png') }}" alt="">
                          </li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/rocket.jpg') }}" alt="">
                          </li>
                          <li>
                              <img src="{{ asset('frontend/assets/img/nagad.png') }}" alt="">
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </section>
      <!-- pay with end -->


      <!-- footer bootom start -->
      <section class="footer-bottom">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <p>
                        © 2022 AB Electronics, eCommerce Department
                    </p>
                  </div>
              </div>
          </div>
      </section>
      <!-- footer bootom end -->


  </footer>
  <!-- ========== END FOOTER ========== -->


  <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="1431192490528362">
      </div>




<!-- go to top start -->
{{-- <a href="#body" class="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a> --}}
<!-- go to top end -->


<!-- pre loader start -->
<div class="loader">
    <img src="{{ asset('images/circle-preloader.gif') }}" alt="">
</div>
<!-- pre loader end -->

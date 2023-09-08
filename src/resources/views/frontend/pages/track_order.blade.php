@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - #{{ $order->order_id }}</title>
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

.step-bar {
  margin: 0;
  padding: 0;
  display: table;
  width: 100%;
}
.step-bar__item {
  display: table-cell;
  vertical-align: middle;
  font-size: 12px;
  text-decoration: none;
  color: #333;
  background-color: #dfdfdf;
  text-align: center;
  position: relative;
  border-right: 2px solid #fff;
  line-height: 18px;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  white-space: nowrap;
}
.step-bar__item a,
.step-bar__item a:visited,
.step-bar__item a:hover {
  display: block;
  padding: 10px 15px 9px 25px;
  text-decoration: none;
  color: #333;
}
.step-bar__item:before,
.step-bar__item:after {
  content: "";
  height: 0;
  width: 0;
  border-width: 18px 0 18px 18px;
  border-style: solid;
  position: absolute;
  left: 100%;
  top: 0;
}
.step-bar__item:before {
  border-color: transparent transparent transparent #fff;
  left: 0;
}
.step-bar__item:after {
  border-color: transparent transparent transparent #dfdfdf;
  z-index: 1;
}
.step-bar__item:first-child:before {
  display: none;
}
.step-bar__item:last-child {
  border-right: none;
}
.step-bar__item:last-child:after {
  display: none;
}
.step-bar__item:hover {
  background-color: #d4d4d4;
}
.step-bar__item:hover:after {
  border-left-color: #d4d4d4;
}
.step-bar__item_active {
  background-color: #a6ce39;
  color: #fff;
  cursor: default;
  font-weight: bold;
  pointer-events: none;
}
.step-bar__item_active a,
.step-bar__item_active a:visited,
.step-bar__item_active a:hover {
  text-decoration: none;
  color: #fff;
}
.step-bar__item_active:after {
  border-color: transparent transparent transparent #a6ce39;
}
.step-bar__item_active:hover {
  background-color: #a6ce39;
}
.step-bar__item_active:hover:after {
  border-left-color: #a6ce39;
}
.step-bar_size_xl .step-bar__item a,
.step-bar_size_xl .step-bar__item a:visited,
.step-bar_size_xl .step-bar__item a:hover {
  padding: 10px 31px 9px 53px;
}
.step-bar_size_xl .step-bar__item:before,
.step-bar_size_xl .step-bar__item:after {
  border-width: 27px 0 27px 27px;
}
.order-track-title{
      margin-bottom: 15px;
}
.order-details-block{
      background: #dfdfdf;
      margin: 15px;
      margin-left: unset!important;
      margin-right: unset!important;
}
.auth-section {
    padding:0!important;
    padding-bottom: 30px!important;
}
</style>











@section('body-content')
<!-- login start -->
<section class="auth-section">
      <div class="container">

            <!-- order details block start -->
            <div class="row order-details-block">
                  <div class="col-md-12">
                        <h2>Order #{{ $order->order_id }}</h2>
                        <p>Placed on {{ $order->created_at->toDayDateTimeString() }}</p>
                  </div>
            </div>
            <!-- order details block end -->

            <div class="row">
                  <div class="col-md-12">
                        <ul class="step-bar">
                              @if( $order->order_status == 'Pending' )
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Pending
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                    On processing
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                          Delivered
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                          Cancelled
                                    </a>
                              </li>
                              @elseif(  $order->order_status == 'OnProcess' )
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Pending
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                    On processing
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                          Delivered
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                          Cancelled
                                    </a>
                              </li>
                              @elseif(  $order->order_status == 'Delivered' )
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Pending
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                    On processing
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Delivered
                                    </a>
                              </li>
                              <li class="step-bar__item">
                                    <a >
                                          Cancelled
                                    </a>
                              </li>
                              @elseif(  $order->order_status == 'Cancelled' )
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Pending
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                    On processing
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Delivered
                                    </a>
                              </li>
                              <li class="step-bar__item step-bar__item_active">
                                    <a >
                                          Cancelled
                                    </a>
                              </li>
                              @endif

                        </ul>
                        <br/>
                  </div>

                  <!-- order product start -->
                  @foreach ($order->order_product as $order_product)
                  <div class="col-md-6">
                        <div class="row" style="margin-bottom: 10px;">
                              <!-- left image start -->
                              <div class="col-md-3 col-3">
                                  <img src="{{ asset('images/product/' . $order_product->product->thumbnail) }}" class="img-fluid" alt="">
                              </div>
                              <!-- left image end -->

                              <!-- right image start -->
                              <div class="col-md-9 col-9">
                                    <p style="margin-top: 10px">{{ $order_product->product->name }}</p>
                                    <p>৳{{ $order_product->unit_price }}x{{ $order_product->quantity }}
                                          BDT</p>
                                    @if ($order_product->product_varient_value_id)
                                          <p>Color : {{ $order_product->product_attribute->value }}</p>
                                    @endif
                              </div>
                              <!-- right image end -->
                        </div>
                  </div>
                  @endforeach
                  <!-- order product end -->

            </div>

            <div class="row">
                  <div class="col-md-6">
                        <h2>Shipping address</h2>
                        <p>{{ $order->name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->phone }}</p>
                  </div>

                  <div class="col-md-6 right">
                        <h2>Order summary</h2>
                        @php
                              $total = $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
                        @endphp
                        <table style="width: 100%">
                              <tbody>
                                  <tr>
                                      <td>
                                          Payment Status
                                      </td>
                                      <td style="text-align: right">
                                          {{ $order->payment_status }}
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          Sub Total
                                      </td>
                                      <td style="text-align: right">
                                          ৳ {{ $order->amount }} BDT
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          Shipping Charge
                                      </td>
                                      <td style="text-align: right">
                                          @if( $order->delivery_type == "Local" )
                                          No Charge ( Local Pickup )
                                          @else

                                          @if ($order->shipping_charge == 0)
                                              Courier Charge
                                          @else
                                              ৳ {{ $order->shipping_charge }} BDT
                                          @endif

                                          @endif
                                          
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          Balance
                                      </td>
                                      <td style="text-align: right">
                                          ৳ {{ $order->customer_balance }} BDT
                                      </td>
                                  </tr>
                                  @if ($order->coupon_id)
                                      <tr>
                                          <td>
                                              Coupon Code
                                          </td>
                                          <td style="text-align: right">
                                              {{ $order->coupon->code }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              Amount After Discount
                                          </td>
                                          <td style="text-align: right">
                                              ৳{{ $order->amount_after_discount }} BDT
                                          </td>
                                      </tr>
                                  @endif
                                  <tr>
                                      <td>
                                          Total
                                      </td>
                                      <td style="text-align: right">
                                          @if( $order->delivery_type == "Local" )
                                                ৳ {{ $order->amount_after_discount ? $order->amount_after_discount : $order->amount }} BDT
                                          @else

                                                @if( $order->customer_balance > $total )
                                                      @if( $order->shipping_charge == 0 )
                                                            Courier Charge
                                                      @else
                                                            ৳{{  $order->shipping_charge  }} BDT
                                                      @endif
                                                @else

                                                      ৳{{  ( $order->shipping_charge + $total ) - $order->customer_balance }} BDT 
                                                      @if( $order->shipping_charge == 0 ) + Courier charge
                                                      @endif

                                                @endif

                                          @endif
                                          
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                  </div>
            </div>
      </div>
</section>
<!-- login start -->
@endsection




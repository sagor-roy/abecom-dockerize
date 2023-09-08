@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - Order Details</title>
@endsection

@section('css')
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/contact/'.App\Models\ContactDetail::first()->fav) }}">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
    rel="stylesheet">
<link href="{{ asset('backend/css/demo1/pages/invoices/invoice-2.css') }}" rel="stylesheet" type="text/css" />
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

@section('body-content')



<!-- profile section start -->
<section class="my-profile">
    <div class="container">
        <div class="row">

            <!-- left part start -->
            <div class="col-md-3">
                <div class="left">
                    <p class="status">Online</p>
                    <img src="{{ asset('frontend/assets/img/user.png') }}" class="img-fluid profile-pic" width="100px"
                        alt="">
                    <h2>{{ auth('customer')->user()->name }}</h2>
                    <p>{{ auth('customer')->user()->email }}</p>

                    <h2 style="background: #38a169;
                                      color: white;">৳{{ auth('customer')->user()->balance }}</h2>


                    <div class="info">
                        <ul>
                            <li>
                                <i class="fas fa-user"></i>
                                <a href="{{ route('profile', auth('customer')->user()->id) }}">Go Main profile</a>
                            </li>
                            <li class="profile-sort" id="profile-sort-2" style="background: white;">
                                <i class="fas fa-smile"></i>
                                Order Details
                            </li>
                            <li class="profile-sort" id="profile-sort-3">
                                <i class="fas fa-smile"></i>
                                Order Invoice
                            </li>
                            <li>
                                <a onclick="document.getElementById('logout').click()">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="d-none" id="logout"></button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- left part end -->

            <!-- right part start -->
            <div class="col-md-9">

                <div style="background: #f7f7f7;" class="profile-bg">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session()->has('success'))
                            <div class="alert alert-success">
                                <p>{{ session()->get('success') }}</p>
                            </div>
                            @endif
                            @if (session()->has('failed'))
                            <div class="alert alert-danger">
                                <p>{{ session()->get('failed') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- order history -->
                    <div class="row profile-info profile-sort-2 table-responsive">


                        <!-- profile order start -->
                        <div class="col-md-12 order-invoice">

                            <div class="row" style="border-bottom: 3px solid #f7f7f7;">
                                <div class="col-md-8">
                                    <p>Order #{{ $order->order_id }}</p>
                                    <p>Placed on {{ $order->created_at->toDayDateTimeString() }}</p>
                                    <p class="badge badge-success">{{ $order->order_status }}</p>
                                </div>
                                <div class="col-md-4 text-right">
                                    @php
                                    $total = $order->amount_after_discount ? $order->amount_after_discount :
                                    $order->amount;
                                    @endphp

                                    @if( $order->delivery_type == "Local" )
                                    <p>
                                        Total : ৳ {{ $total }} BDT
                                    </p>
                                    @else

                                    <p>Total : ৳{{ $total + $order->shipping_charge - $order->customer_balance }}
                                        BDT
                                        @if ($order->shipping_charge == 0) + Courier
                                        charge @endif
                                    </p>


                                    @endif


                                    <!-- order cancel block start -->
                                    @if ($order->order_status == 'Pending' || $order->order_status == 'OnProcess')
                                    <button type="button" class="order-cancel-btn" data-toggle="modal"
                                        data-target="#cancelOrder{{ $order->id }}">
                                        Cancel Order
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelOrder{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Order
                                                        Cancellation</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="text-align: left">NB : After shipment or delivery no
                                                        order cancellation</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('profile.cancel.order', $order->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            style="margin-top: 15px;">Cancel
                                                            Order</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- order cancel block end -->
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($order->order_product as $order_product)
                                <!-- order product item start -->
                                <div class="col-md-12">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <!-- left image start -->
                                        <div class="col-md-2 col-3">
                                            <img src="{{ asset('images/product/' . $order_product->product->thumbnail) }}"
                                                class="img-fluid" alt="">
                                        </div>
                                        <!-- left image end -->

                                        <!-- right image start -->
                                        <div class="col-md-10 col-9">
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
                                <!-- order product item end -->
                                @endforeach
                            </div>

                        </div>
                        <!-- profile order end -->

                        <div class="col-md-12 order-information">
                            <div class="row">
                                <!-- left part start -->
                                <div class="col-md-6 left">
                                    <h2>Shipping address</h2>
                                    <p>{{ auth('customer')->user()->name }}</p>
                                    <p>{{ $order->shipping_address }}</p>
                                    <p>{{ $order->phone }}</p>
                                </div>
                                <!-- left part end -->

                                <!-- right part start -->
                                <div class="col-md-6 right">
                                    <h2>Order summary</h2>
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

                                            <!-- courier start -->
                                            @if( $order->courier_id )
                                            <tr>
                                                <td>Courier</td>
                                                <td style="text-align: right">
                                                    {{ $order->courier->courier }}
                                                </td>
                                            </tr>
                                            @endif
                                            <!-- courier end -->

                                            <tr>
                                                <td>
                                                    Total
                                                </td>
                                                <td style="text-align: right">
                                                    @if( $order->delivery_type == "Local" )
                                                    ৳
                                                    {{ $order->amount_after_discount ? $order->amount_after_discount : $order->amount }}
                                                    BDT
                                                    @else

                                                    @if( $order->customer_balance > $total )
                                                    @if( $order->shipping_charge == 0 )
                                                    Courier Charge
                                                    @else
                                                    ৳{{  $order->shipping_charge  }} BDT
                                                    @endif
                                                    @else
                                                    ৳{{  ( $order->shipping_charge + $total ) - $order->customer_balance }}
                                                    BDT
                                                    @if( $order->shipping_charge == 0 ) + Courier charge
                                                    @endif

                                                    @endif

                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- right part end -->
                            </div>
                        </div>

                    </div>

                    <!-- invoice -->
                    <div class="row profile-info hide-profile-info profile-sort-3 table-responsive">
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                            id="kt_content">

                            <!-- begin:: Content -->
                            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                <div class="kt-portlet" id="kt-portlet">

                                    <!-- top part start -->
                                    <div class="row invoice-top">
                                        <!-- left part start -->
                                        <div class="col-md-6 col-6" style="position: relative">
                                            <img src="{{ asset('images/logo/'.App\Models\ContactDetail::first()->logo) }}"
                                                width="300px" class="img-fluid" alt="">
                                        </div>
                                        <!-- left part end -->

                                        <!-- right part start -->
                                        <div class="col-md-6 col-6">
                                            <p>AB Electronics</p>
                                            {!! App\Models\ContactDetail::first()->address !!}
                                            <p>
                                                +88{{ App\Models\ContactDetail::first()->hotline }}
                                            </p>
                                            <p>
                                                {{ App\Models\ContactDetail::first()->email }}
                                            </p>
                                        </div>
                                        <!-- right part end -->
                                    </div>
                                    <!-- top part end -->


                                    <!-- invoice part start -->
                                    <div class="row invoice-part ">

                                        <div class="col-md-12">
                                            <h2 style="margin-bottom: 15px">Invoice</h2>
                                        </div>

                                        <!-- customer info block start -->
                                        <div class="col-md-6 col-6">
                                            <p style="margin-bottom: 0">{{ $order->name }}</p>
                                            <p style="margin-bottom: 0">+88{{ $order->phone }}</p>
                                            <p style="margin-bottom: 0">{{ $order->email }}</p>
                                            <p style="margin-bottom: 0">{{ $order->shipping_address }}</p>
                                        </div>
                                        <!-- customer info block end -->

                                        <!-- order info part start -->
                                        <div class="col-md-6 col-6">
                                            <p style="margin-bottom: 0">Order : #{{ $order->order_id }}</p>
                                            <p style="margin-bottom: 0">Order date :
                                                {{ $order->created_at->toDayDateTimeString() }}</p>
                                            <p style="margin-bottom: 0">Payment method : {{ $order->paid_by }}</p>
                                        </div>
                                        <!-- order info part end -->

                                    </div>
                                    <!-- invoice part end -->

                                    <!-- invoice table start -->
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach( $order->order_product as $order_product )
                                                    <tr>
                                                        <th scope="row">
                                                            <img src="{{ asset('images/product/'.$order_product->product->thumbnail) }}"
                                                                width="50px" alt="">
                                                        </th>
                                                        <td>
                                                            {{ $order_product->product->name }} <br> <br>
                                                            @if( $order_product->product_varient_value_id )
                                                            {{ $order_product->product_attribute->attribute->name }} :
                                                            {{ $order_product->product_attribute->value }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            ৳{{ $order_product->unit_price }}
                                                        </td>
                                                        <td>
                                                            {{ $order_product->quantity }}
                                                        </td>
                                                        <td>
                                                            ৳{{ $order_product->unit_price * $order_product->quantity }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- invoice table end -->


                                    <!-- order summary row start -->
                                    <div class="row order-summary" style="background: #f7f7f7">
                                        <div class="col-md-6 offset-md-6 table-responsive">
                                            <table class="table table-sm">
                                                <tbody>

                                                    <!-- subtotal start -->
                                                    <tr>
                                                        <th scope="row">
                                                            @php
                                                            $total = $order->amount_after_discount ?
                                                            $order->amount_after_discount : $order->amount;
                                                            @endphp
                                                            Sub total
                                                        </th>
                                                        <td style="text-align: right">
                                                            ৳{{ $order->amount }}
                                                        </td>
                                                    </tr>
                                                    <!-- subtotal end -->

                                                    <!-- discount subtotal start -->
                                                    @if( $order->coupon_id )
                                                    <tr>
                                                        <th scope="row">
                                                            Discount sub total
                                                        </th>
                                                        <td style="text-align: right">
                                                            ৳{{ $order->amount_after_discount }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            Coupon code
                                                        </th>
                                                        <td style="text-align: right">
                                                            {{ $order->coupon->code }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!-- discount subtotal end -->

                                                    <!-- shipping charge start -->
                                                    @if( $order->delivery_type == "Local" )

                                                    <tr>
                                                        <th scope="row">
                                                            Shipping charge
                                                        </th>
                                                        <td style="text-align: right">
                                                            No Charge ( Local Pickup )
                                                        </td>
                                                    </tr>

                                                    @else

                                                    @if( $order->shipping_charge == 0 )
                                                    <tr>
                                                        <th scope="row">
                                                            Shipping charge
                                                        </th>
                                                        <td style="text-align: right">
                                                            Courier Charge
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <th scope="row">
                                                            Shipping charge
                                                        </th>
                                                        <td style="text-align: right">
                                                            ৳{{ $order->shipping_charge }}
                                                        </td>
                                                    </tr>
                                                    @endif

                                                    @endif
                                                    <!-- shipping charge end -->



                                                    <!-- customer balance start -->
                                                    @if( $order->customer_id != 0 )
                                                    <tr>
                                                        <th scope="row">
                                                            Customer balance
                                                        </th>
                                                        <td style="text-align: right">
                                                            ৳{{ $order->customer_balance }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!-- customer balance end -->


                                                    <!-- courier name start -->
                                                    @if( $order->courier_id )
                                                    <tr>
                                                        <th scope="row">
                                                            Courier
                                                        </th>
                                                        <td style="text-align: right">
                                                            {{ $order->courier->courier }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!-- courier name end -->


                                                    <!-- total start -->
                                                    @if( $order->customer_balance > $total )
                                                    <tr>
                                                        <th scope="row">
                                                            Total
                                                        </th>
                                                        <td style="text-align: right">
                                                            @if( $order->shipping_charge == 0 )
                                                            Courier Charge
                                                            @else
                                                            ৳{{  $order->shipping_charge  }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <th scope="row">
                                                            Total
                                                        </th>
                                                        <td style="text-align: right">
                                                            ৳{{  ( $order->shipping_charge + $total ) - $order->customer_balance }}
                                                            @if( $order->shipping_charge == 0 )
                                                            @if( $order->courier_id ) + Courier Charge @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!-- total end -->


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- order summary row end -->

                                    <!-- invoice footer start -->
                                    <div class="row invoice-footer">
                                        <div class="col-md-12 text-center">
                                            <p>www.abe.com.bd</p>
                                        </div>
                                    </div>
                                    <!-- invoice footer end -->

                                </div>

                                <button type="button" class="btn btn-label-brand btn-bold" id="downloadPDF">
                                    Download PDF
                                    <i class="fas fa-file-download" style="padding-left: 5px"></i>
                                </button>

                            </div>
                            <!-- end:: Content -->
                        </div>
                    </div>

                </div>
                <!-- right part end -->

            </div>
        </div>
</section>
<!-- profile section end -->

@endsection


@section('per_page_js')
<script src="{{ asset('backend/dist/js/html2pdf.min.js') }}"></script>
<script>
    document.getElementById("downloadPDF").addEventListener("click", function () {
        const invoice = document.getElementById("kt-portlet")
        var opt = {
            margin: 0,
            filename: 'invoice_{{ $order->order_id }}.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 1
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        }
        html2pdf().from(invoice).set(opt).save()
    })

</script>
@endsection

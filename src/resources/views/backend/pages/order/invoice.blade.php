@extends('backend.template.layout')

@section('body-content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                              INVOICE
                        </h3>

                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <i class="flaticon2-shelter"></i>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="{{ route('order.all') }}" class="kt-subheader__breadcrumbs-link">
                            Go To Order Page
                        </a>
                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                        <!-- print and download option start -->
                        <div class="kt-invoice__actions">
                              <div class="kt-invoice__container">
                                    <button type="button" class="btn btn-label-brand btn-bold" id="downloadPDF">
                                          Download PDF
                                          <i class="fas fa-file-download" style="padding-left: 5px"></i>
                                    </button>
                                    <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">
                                          Print Invoice
                                          <i class="fas fa-print" style="padding-left: 5px"></i>
                                    </button>
                              </div>
                        </div>
                        <!-- print and download option end -->
                </div>
            </div>
        </div>
        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet" id="kt-portlet">

                  <!-- top part start -->
                  <div class="row invoice-top">
                        <!-- left part start -->
                        <div class="col-md-6 col-6" style="position: relative">
                              <img src="{{ asset('images/logo/'.App\Models\ContactDetail::first()->logo) }}" width="300px" class="img-fluid" alt="">
                        </div>
                        <!-- left part end -->

                        <!-- right part start -->
                        <div class="col-md-6 col-6 right">
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
                              <p style="margin-bottom: 0">Order date : {{ $order->created_at->toDayDateTimeString() }}</p>
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
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach( $order->order_product as $order_product )
                                          <tr>
                                                <th scope="row">
                                                      <img src="{{ asset('images/product/'.$order_product->product->thumbnail) }}" width="50px" alt="">
                                                </th>
                                                <td>
                                                      <p style="margin-bottom: 0;">{{ $order_product->product->name }}</p>
                                                      @if( $order_product->product_varient_value_id )
                                                      <p style="margin-bottom: 0;">{{ $order_product->product_attribute->attribute->name }} : {{ $order_product->product_attribute->value }}</p>
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
                  <div class="row order-summary">
                        <div class="col-md-5 offset-md-7 table-responsive">
                              <table class="table table-sm">
                                    <tbody>

                                          <!-- subtotal start -->
                                          <tr>
                                                <th scope="row">
                                                      @php
                                                            $total = $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
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
                                                      No Charge
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
                                                      @if(  $order->courier_id ) + Courier Charge @endif
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
        </div>
        <!-- end:: Content -->
    </div>
@endsection

@section('per_page_js')
<link href="{{ asset('backend/css/demo1/pages/invoices/invoice-2.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('backend/dist/js/html2pdf.min.js') }}"></script>
<script>
      document.getElementById("downloadPDF").addEventListener("click", function(){
            const invoice = document.getElementById("kt-portlet")
            var opt = {
                  margin: 0,
                  filename: 'invoice_{{ $order->id }}.pdf',
                  image: { type: 'jpeg' , quality : 0.98 },
                  html2canvas : { scale : 1 },
                  jsPDF : { unit : 'in' , format : 'letter' , orientation : 'portrait' }
            }
            html2pdf().from(invoice).set(opt).save()
      })
</script>
@endsection

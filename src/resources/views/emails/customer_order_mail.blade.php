<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>NEW ORDER PLACED</title>
</head>

<body>
    <!-- Invoice New Design Start -->
    <div class="col-md-12">
        <center>
            <h1>NEW ORDER PLACED</h5>
        </center>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table style="width: 100%;">
                <tr>
                    <!-- Logo Here -->
                    <td width="50%">
                        <img href="{{ route('home') }}" src="https://abe.com.bd/images/logo/1619338449Fj2uoFGV83hy.png"
                            height="48px" width="42%">
                    </td>

                    <td style="text-align: end;">
                        <a href="https://abe.com.bd/" target="new_window" class="text-right">abe.com.bd</a>
                    </td>
                </tr>

                <!-- Sold By & Billing Address -->
                <tr>
                    <td>
                        <strong>Sold By:</strong> <br>
                        AB Electronics <br>
                        +8801938866990 <br>
                        abinfo@gmail.com <br>
                        Purana Paltan
                    </td>

                    <td style="text-align: end;">
                        <strong>Billing Address : </strong> <br>
                        <span style="text-align: right;"> {{ $order->name }} </span> <br>
                        <span style="text-align: right;"> {{ $order->shipping_address }} </span> <br>
                        <span style="text-align: right;"> {{ $order->email }} </span>
                    </td>
                </tr>


                <!-- Invoice Information & Billing Address -->
                <tr>
                    <td>
                        <strong>Invoice Number : </strong> #{{ $order->order_id }} <br>
                        <strong>Invoice Date : </strong> {{ $order->created_at->toDateString() }} <br>
                        <strong>Payment Method : </strong> {{ $order->paid_by }}
                    </td>


                    <td style="text-align: end;">
                        <strong>Shipping Address :</strong> <br>
                        {{ $order->name }} <br>
                        {{ $order->shipping_address }} <br>
                        {{ $order->email }}
                    </td>
                </tr>
            </table>

            <table style="width: 100%;">
                <!-- Product List -->
                <tr style="background-color: #061e50; color:#f6f6f6;">
                    <td>Item</td>
                    <td>Description</td>
                    <td style="text-align: center">Quantity</td>
                    <td style="text-align: center">Unit Price</td>
                    <td style="text-align: center">Total</td>
                </tr>

                @php
                    $sub_total = 0;
                @endphp
                <!-- Product Lists Start -->
                @foreach( $order->order_product as $key => $order_product )
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $order_product->product->name }}</td>
                    <td style="text-align: center">{{ $order_product->quantity }}</td>
                    <td style="text-align: center">৳{{ $order_product->unit_price }} TK</td>
                    <td style="text-align: center">৳{{ $order_product->unit_price * $order_product->quantity }} TK</td>
                </tr>

                @php
                    $sub_total += $order_product->unit_price * $order_product->quantity;
                @endphp
                @endforeach
                <!-- Product Lists End -->

                
                <br><br>

                <!-- Sub Total -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;">
                        Sub Total
                    </td>
                    <td style="text-align: right;">
                        ৳{{ $sub_total }} TK
                    </td>
                </tr>

                <!-- Shipping Charge -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;">
                        Shipping Charge
                    </td>
                    <td style="text-align: right;">
                        @if( $order->delivery_type ==
                        "Local" )

                        <strong>
                            No Charge ( Local Pickup )
                        </strong>

                        @else

                        @if( $order->shipping_charge ==
                        0 )
                        <strong>
                            Courier Charge
                        </strong>
                        @else
                        <strong>
                            ৳{{ $order->shipping_charge }}
                            BDT
                        </strong>
                        @endif

                        @endif
                    </td>
                </tr>

                <!-- Total -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right; background-color: #061e50; color:#f6f6f6;">
                        Total
                    </td>
                    <td style="text-align: right; background-color: #061e50; color:#f6f6f6;">
                        ৳{{ $sub_total +  $order->shipping_charge}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- Invoice New Design End -->
</body>

</html>

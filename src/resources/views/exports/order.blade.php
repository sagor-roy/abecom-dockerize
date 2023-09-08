<table>
      <tr>
            <th>Order</th>
            <th>Order Product</th>
      </tr>

      @foreach( $datas as $order )
      <tr>
            <td rowspan="{{ $order->order_product->count() }}">
                  <b>Customer Details :</b> <br>
                  @if( $order->customer_id == 0 )
                  Guest Checkout <br>
                  @endif
                  Customer Name : {{ $order->name }} <br>
                  Customer Phone : {{ $order->phone }} <br>
                  Customer Email : {{ $order->email }} <br>
                  Customer City : {{ $order->city->city }} <br>
                  Customer Address : {{ $order->shipping_address }} <br>
                  @if( $order->customer_id )
                  Customer Balance : {{ $order->customer_balance }} BDT <br>
                  @endif
                  @if( $order->courier_id )
                  Courier : {{ $order->courier->courier }} <br> 
                  @endif
                  <br>

                  <b>Payment Information : </b> <br>
                  @if( $order->shipping_charge == 0 )
                  Shipping charge : Courier charge<br>
                  @else
                  Shipping charge : {{ $order->shipping_charge }} BDT <br>
                  @endif
                  Sub Total : {{ $order->amount }} BDT <br>
                  @if( $order->discount_status == 1 )
                  Discount Sub Total : {{ $order->amount_after_discount }} BDT <br>
                  Coupon code : {{ $order->coupon->code }} <br>
                  @endif

                  @php
                        $total = $order->amount_after_discount ? $order->amount_after_discount : $order->amount;
                  @endphp
                  @if( $order->customer_balance > $total )
                        @if( $order->shipping_charge == 0 )
                        Total : Courier Charge <br>
                        @else
                        Total : {{  $order->shipping_charge  }} BDT <br>
                        @endif 
                  @else
                        @if( $order->shipping_charge == 0 )
                        Total : Courier Charge <br>
                        @else
                        Total : {{  ( $order->shipping_charge + $total ) - $order->customer_balance }} BDT  
                        @if( $order->shipping_charge == 0 ) + Courier charge @endif
                        <br>
                        @endif 
                  @endif

                  <br>

                  Order Status : <br>
                  Payment method : {{ $order->paid_by }} <br>
                  Payment status : {{ $order->payment_status }} <br>
                  Delivery status : {{ $order->order_status }} <br>
                  Order status : {{ $order->is_active ? 'Active' : 'Inactive' }} <br>
            </td>

           
            <td>Product Name : {{ $order->order_product->first()->product->name }}</td>
            <td>Quantity : {{ $order->order_product->first()->quantity }}</td>
            <td>Unit Price : {{ $order->order_product->first()->unit_price }} BDT</td>
            <td>Total : {{ $order->order_product->first()->total }} BDT</td>
            <td>
                  @if( $order->order_product->first()->product_varient_value_id )
                  {{ $order->order_product->first()->product_attribute->attribute->name }} : {{ $order->order_product->first()->product_attribute->value }}
                  @endif
            </td>
      </tr>



      @php
            $j = 0;
      @endphp
      @foreach( $order->order_product as $order_product )
      @if( $j > 0 )
      <tr>
            <td>Product Name : {{ $order_product->product->name }}</td>
            <td>Quantity : {{ $order_product->quantity }}</td>
            <td>Unit Price : {{ $order_product->unit_price }} BDT</td>
            <td>Total : {{ $order_product->total }} BDT</td>
            <td>
                  @if( $order_product->product_varient_value_id )
                  {{ $order_product->product_attribute->attribute->name }} : {{ $order_product->product_attribute->value }}
                  @endif
            </td>
      </tr>
      @endif
      @php
            $j++;
      @endphp
      @endforeach

      @endforeach
</table>

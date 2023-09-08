@extends('backend.template.layout')

@section('body-content')

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="padding-bottom: 15px">

        <div class="row">

            <div class="col-md-3">
                <div class="card-counter primary">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $total_order }}</span>
                    <span class="count-name">Total Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter danger">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $pending_order }}</span>
                    <span class="count-name">Pending Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $onprocess_order }}</span>
                    <span class="count-name">OnProcess Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $shipped_order }}</span>
                    <span class="count-name">Shipped Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter info">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $delivered_order }}</span>
                    <span class="count-name">Delivered Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter info">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $cancelled_order }}</span>
                    <span class="count-name">Cancelled Order</span>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $todays_order }}</span>
                    <span class="count-name">Today's Order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter danger">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $one_week }}</span>
                    <span class="count-name">Last week order</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter primary">
                    <i class="fab fa-shopware"></i>
                    <span class="count-numbers">{{ $one_year }}</span>
                    <span class="count-name">Last year order</span>
                </div>
            </div>

        </div>

    </div>
    <!-- end:: Content -->



    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!-- title row start -->
        <div class="row">
            <div class="col-md-12">
                <!--begin:: Widgets/Application Sales-->
                <div class="kt-portlet kt-portlet--height-fluid">

                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                All Order
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                        data-target="#reportModal">
                                        Order Custom Report
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Download Report In Excle</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('order.report') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Date From</label>
                                                                <input type="date" id="start_date" class="form-control" required name="from" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Date To</label>
                                                                <input type="date" id="end_date" class="form-control" required name="to" required>
                                                            </div>
                                                            <script>
                                                                var today = new Date();
                                                                var dd = String(today.getDate()).padStart(2, '0');
                                                                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                                                                var yyyy = today.getFullYear();
                                                                today = yyyy + "-" + mm + "-" + dd;
                                                                document.getElementById('end_date').setAttribute("max", today)
                                                                document.getElementById('start_date').setAttribute("max", today)
                                                                document.getElementById('end_date').onchange = (e) => {
                                                                    document.getElementById('start_date').setAttribute("max", e.target.value)
                                                                }
                                                                document.getElementById('start_date').onchange = (e) => {
                                                                    document.getElementById('end_date').setAttribute("max", e.target.value)
                                                                }
                                                            </script>
                                                            <div class="form-group col-md-6">
                                                                <label>City</label>
                                                                <select name="city" required class="form-control order_choosen">
                                                                    @foreach( App\Models\City::all() as $city )
                                                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Courier</label>
                                                                <select name="courier" required class="form-control order_choosen">
                                                                    <option value="0">No courier</option>
                                                                    @foreach( App\Models\Courier::all() as $courier )
                                                                    <option value="{{ $courier->id }}">{{ $courier->courier }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Discount have?</label>
                                                                <select name="discount" required class="form-control order_choosen">
                                                                    <option value="0">No</option>
                                                                    <option value="1">Yes</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Coupon</label>
                                                                <select name="coupon" required class="form-control order_choosen">
                                                                    <option value="0">No Coupon</option>
                                                                    @foreach( App\Models\Coupon::all() as $coupon )
                                                                    <option value="{{ $coupon->id }}">{{ $coupon->code }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Paid by</label>
                                                                <select name="paid_by" required class="form-control order_choosen">
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Online">Online</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Payment Status</label>
                                                                <select name="payment_status" required class="form-control order_choosen">
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Success">Success</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Order Status</label>
                                                                <select name="order_status" required class="form-control order_choosen">
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="OnProcess">OnProcess</option>
                                                                    <option value="Delivered">Delivered</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Checkout Type</label>
                                                                <select name="checkout_type" required class="form-control order_choosen">
                                                                    <option value="0">Guest Checkout</option>
                                                                    <option value="1">Normal Checkout</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Active Status</label>
                                                                <select name="active_status" required class="form-control order_choosen">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12" style="text-align: right">
                                                                <button class="btn btn-success" type="submit">Download</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>

                                <li class="nav-item">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                        data-target="#reportDateToDate">
                                        Order Date to Date Report
                                    </button>
                                    <div class="modal fade" id="reportDateToDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Download Report Date to Date</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('order.report.date.to.date') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Date From</label>
                                                                <input type="date" id="start_date_2" class="form-control" required name="from" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Date To</label>
                                                                <input type="date" id="end_date_2" class="form-control" required name="to" required>
                                                            </div>
                                                            <script>
                                                                var today = new Date();
                                                                var dd = String(today.getDate()).padStart(2, '0');
                                                                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                                                                var yyyy = today.getFullYear();
                                                                today = yyyy + "-" + mm + "-" + dd;
                                                                document.getElementById('end_date_2').setAttribute("max", today)
                                                                document.getElementById('start_date_2').setAttribute("max", today)
                                                                document.getElementById('end_date_2').onchange = (e) => {
                                                                    document.getElementById('start_date_2').setAttribute("max", e.target.value)
                                                                }
                                                                document.getElementById('start_date_2').onchange = (e) => {
                                                                    document.getElementById('end_date_2').setAttribute("max", e.target.value)
                                                                }
                                                            </script>
                                                            <div class="col-md-12" style="text-align: right">
                                                                <button class="btn btn-success" type="submit">Download</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget11_tab1_content">
                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <div class="table-responsive">
                                        <table class="table order-datatable" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th>
                                                    <th>Order Date</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <!--end::Widget 11-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Application Sales-->
            </div>
        </div>
        <!-- title row end -->

    </div>
    <!-- end:: Content -->
@endsection

@section('per_page_js')

    <script>
        $(".order_choosen").chosen()
    </script>

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {
            $('.order-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.data') }}",
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    },
                ]
            });
        });

    </script>
@endsection

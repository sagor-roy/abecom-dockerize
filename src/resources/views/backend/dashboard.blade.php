@extends('backend.template.layout')
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"> -->
@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="row">
        
        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fab fa-jedi-order"></i>
                <span class="count-numbers">{{ $current_visitors }}</span>
                <span class="count-name">Today Visitors</span>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fab fa-jedi-order"></i>
                <span class="count-numbers">{{ $page_views }}</span>
                <span class="count-name">Total Views</span>
            </div>
        </div>

        <div class="col-md-3">
            <a href="{{ route('message.show') }}">
                <div class="card-counter success">
                    <i class="fab fa-jedi-order"></i>
                    <span class="count-numbers">{{ $new_message }}</span>
                    <span class="count-name">New Message</span>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('corporate.sale') }}">
                <div class="card-counter danger">
                    <i class="fab fa-jedi-order"></i>
                    <span class="count-numbers">{{ $corporate_sale }}</span>
                    <span class="count-name">New Enquery</span>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('service.complaint') }}">
                <div class="card-counter info">
                    <i class="fab fa-jedi-order"></i>
                    <span class="count-numbers">{{ $service_complaint }}</span>
                    <span class="count-name">New Complain</span>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('price.matching') }}">
                <div class="card-counter success">
                    <i class="fab fa-jedi-order"></i>
                    <span class="count-numbers">{{ $price_match }}</span>
                    <span class="count-name">New Price Match Request</span>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fab fa-jedi-order"></i>
                <span class="count-numbers">{{ $new_order }}</span>
                <span class="count-name">New Order</span>
            </div>
        </div>

        

        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fab fa-product-hunt"></i>
                <span class="count-numbers">{{ $product }}</span>
                <span class="count-name">Total Products</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fas fa-list-ul"></i>
                <span class="count-numbers">{{ $category }}</span>
                <span class="count-name">Total Category</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fas fa-th-list"></i>
                <span class="count-numbers">{{ $subcategory }}</span>
                <span class="count-name">Total Sub Category</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fas fa-list"></i>
                <span class="count-numbers">{{ $brand }}</span>
                <span class="count-name">Total Brand</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fas fa-users"></i>
                <span class="count-numbers">{{ $customer }}</span>
                <span class="count-name">Total Customer</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fas fa-user-secret"></i>
                <span class="count-numbers">{{ $user }}</span>
                <span class="count-name">Total User</span>
            </div>
        </div>

    </div>

    <div class="row" style="padding: 30px;background: white;margin: 15px 0">
        <!-- product sale chart -->
        <div class="col-md-12" id="chart">

        </div>
        <!-- product sale chart end -->
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fas fa-gift"></i>
                <span class="count-numbers">{{ \App\Models\Offer::where('status', true)->count() }}</span>
                <span class="count-name">Active Offer</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fas fa-gifts"></i>
                <span class="count-numbers">{{ \App\Models\Coupon::where('is_active', true)->count() }}</span>
                <span class="count-name">Active Coupon</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fas fa-city"></i>
                <span class="count-numbers">{{ \App\Models\City::where('is_active', true)->count() }}</span>
                <span class="count-name">Cities</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fas fa-truck"></i>
                <span class="count-numbers">{{ \App\Models\Courier::where('is_active', true)->count() }}</span>
                <span class="count-name">Couriers</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fas fa-money-check"></i>
                <span class="count-numbers">৳ {{ $total_sale }}</span>
                <span class="count-name">Total Sale</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fas fa-money-bill-alt"></i>
                <span class="count-numbers">৳ {{ $today_sale }}</span>
                <span class="count-name">Today's Sale</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fas fa-money-bill-wave-alt"></i>
                <span class="count-numbers">৳ {{ $one_month_sale }}</span>
                <span class="count-name">This Month Sale</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fas fa-money-bill"></i>
                <span class="count-numbers">৳ {{ $one_year_sale }}</span>
                <span class="count-name">This Year Sale</span>
            </div>
        </div>
    </div>

    <div class="row" style="padding: 30px;background: white;margin: 15px 0">
        <!-- category product chart -->
        <div class="col-md-6" id="chart2">

        </div>
        <!-- category product chart end -->

        <!-- category attribute chart -->
        <div class="col-md-6" id="chart3">

        </div>
        <!-- category attribute chart end -->
    </div>

</div>
<!-- end:: Content -->
@endsection

@section('per_page_js')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LT43Q3QJHS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LT43Q3QJHS');
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $.ajax({
        url: "{{ route('product_request_chart') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var productAvgValue = Array(); //Define an empty array for Product Avarage Value
            var productName = Array(); //Define an Empty array for Product Name

            $.each(data.productRequestChart, (key, value) => {
                productAvgValue.push(value
                    .quantity) //Push Each Value into ProductAvgValue Array

                productName.push(data
                    .product[key].name) //Push Product into ProductName Array
            })
            var options = {
                series: [{
                    name: 'Product Sale',
                    data: productAvgValue,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: productName,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }

                },
                title: {
                    text: 'Product Sale Chart',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    })

    $.ajax({
        url: "{{ route('category_product_chart') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var category = Array(); //Define an empty array for Product Avarage Value
            var p_count = Array(); //Define an Empty array for Product Name

            $.each(data.category, (key, value) => {
                category.push(value.name) //Push category name
                p_count.push(data.product[key]) //Push Product count
            })
            var options = {
                series: [{
                    name: 'Product in category',
                    data: p_count,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: category,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#ef5350',
                                colorTo: '#ef5350',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }

                },
                title: {
                    text: 'Category Product Chart',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
        }
    })

    $.ajax({
        url: "{{ route('category_attribute_chart') }}",
        method: 'GET',
        data: {},
        success: function (data) {
            var category = Array(); //Define an empty array for Product Avarage Value
            var c_varient = Array(); //Define an Empty array for Product Name

            $.each(data.category, (key, value) => {
                category.push(value.name) //Push category name
                c_varient.push(data.varient[key]) //Push Product count
            })
            var options = {
                series: [{
                    name: 'Attributes in category',
                    data: c_varient,
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '11px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: category,
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#ef5350',
                                colorTo: '#ef5350',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }

                },
                title: {
                    text: 'Category Attribute Chart',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart3"), options);
            chart.render();
        }
    })

</script>
@endsection

@extends('frontend.template.layout')

@section('meta')
<!-- Title -->
<title>AB Electronics - {{ auth("customer")->user()->name }} </title>
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

@section('body-content')

<!-- profile section start -->
<section class="my-profile">
      <div class="container">
            <div class="row">
                  
                  <!-- left part start -->
                  <div class="col-md-3">
                        <div class="left">
                              <p class="status">Online</p>
                              <img src="{{ asset('frontend/assets/img/user.png') }}" class="img-fluid profile-pic" width="100px" alt="">
                              <h2>{{ auth('customer')->user()->name }}</h2>
                              <p>{{ auth('customer')->user()->email }}</p>

                              <h2 style="background: #38a169;
                              color: white;">৳{{ auth('customer')->user()->balance }}</h2>
                              

                              <div class="info">
                                    <ul>
                                          <li class="profile-sort" id="profile-sort-1" style="background: white;">
                                                <i class="fas fa-user"></i>
                                                Basic Information
                                          </li>
                                          <li class="profile-sort" id="profile-sort-2">
                                                <i class="fas fa-smile"></i>
                                                Order History
                                          </li>
                                          <li class="profile-sort" id="profile-sort-3">
                                                <i class="fas fa-star"></i>
                                                My Review
                                          </li>
                                          <li class="profile-sort" id="profile-sort-4">
                                            <i class="fas fa-heart"></i>
                                            My Wishlists
                                            </li>
                                          <li class="profile-sort" id="profile-sort-5">
                                                <i class="fas fa-key"></i>
                                                Change Password
                                          </li>
                                          <li>
                                                <a onclick="document.getElementById('logout').click()" >
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
                                </div>
                            </div>
                            
                            <!-- basic-info -->
                            <div class="row profile-info profile-sort-1">
                                <div class="row" style="margin-bottom: 15px;"> 
                                        
                                        <div class="col-md-6">
                                            <h2> <i class="fas fa-user"></i> Basic Information</h2>
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="color: white">
                                                    Edit Profile
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2>Edit Profile</h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('profile.basic.info', auth('customer')->user()->id ) }}" method="post">
                                                            @csrf
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" value="{{ auth('customer')->user()->name }}" name="name" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="email" value="{{ auth('customer')->user()->email }}" name="email" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <input type="text" @if( auth('customer')->user()->phone != auth('customer')->user()->email ) value="{{ auth('customer')->user()->phone }}" @endif name="phone" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Birthday</label>
                                                                        <input type="date" class="form-control" name="birthday" value="{{ auth('customer')->user()->birthday }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <input type="text" name="city" value="{{ auth('customer')->user()->city }}" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Shipping Address</label>
                                                                        <textarea name="address" rows="3" class="form-control">
                                                                            {{ auth('customer')->user()->address }}
                                                                        </textarea>
                                                                    </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-warning">Save</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <p>Name : {{ auth('customer')->user()->name }}</p>
                                <p>Email Address : {{ auth('customer')->user()->email }}</p>
                                <p>Phone : 
                                    @if( auth('customer')->user()->phone != auth('customer')->user()->email )
                                    {{ auth('customer')->user()->phone ? auth('customer')->user()->phone : 'N/A' }}
                                    @endif
                                </p>
                                <p>City : {{ auth('customer')->user()->city ? auth('customer')->user()->city : 'N/A' }}</p>
                                <p>Country : {{ auth('customer')->user()->country ? auth('customer')->user()->country : 'N/A' }}</p>
                                <p>Address : {{ auth('customer')->user()->address ? auth('customer')->user()->address : 'N/A' }}</p>
                                <p>Birthday : {{ auth('customer')->user()->birthday }}</p>
                                <p>Member Since : {{  auth('customer')->user()->created_at->toDayDateTimeString()  }}</p>
                                
                            </div>
                            <!-- basic-info end-->

                            <!-- order history -->
                            <div class="row profile-info hide-profile-info profile-sort-2 table-responsive">
                                <h2 style="margin-bottom: 15px;">
                                    <i class="fas fa-smile"></i>
                                    Order history
                                </h2>

                                <!-- profile order start -->
                                @forelse( auth('customer')->user()->order->sortByDesc('id')->where('is_active', true) as $order )
                                <div class="col-md-12 order-invoice">

                                    <div class="row" style="border-bottom: 3px solid #f7f7f7;">
                                        <div class="col-md-8">
                                            <p>Order #{{ $order->order_id }}</p>
                                            <p>Placed on {{ $order->created_at->toDayDateTimeString() }}</p>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <a href="{{ route('order.details',['id' => auth('customer')->user()->id, 'order_id' => $order->id]) }}">Manage</a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach( $order->order_product as $order_product )
                                        <!-- order product item start -->
                                        <div class="col-md-12">
                                            <div class="row" style="margin-bottom: 10px;">
                                                <!-- left image start -->
                                                <div class="col-md-2 col-3">
                                                    <img src="{{ asset('images/product/'.$order_product->product->thumbnail) }}" class="img-fluid" alt="">
                                                </div>
                                                <!-- left image end -->

                                                <!-- right image start -->
                                                <div class="col-md-10 col-9">
                                                    <p style="margin-top: 10px">{{ $order_product->product->name }}</p>
                                                    <p>৳{{ $order_product->unit_price }}x{{ $order_product->quantity }} BDT</p>
                                                    @if( $order_product->product_varient_value_id )
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
                                @empty
                                <div class="col-md-12">
                                    <p class="alert alert-warning">No order found</p>
                                </div>
                                @endforelse
                                <!-- profile order end -->

                            </div>
                            <!-- order history end-->

                            <!-- review -->
                            <div class="row profile-info hide-profile-info profile-sort-3">
                                <h2 style="margin-bottom: 15px;">
                                <i class="fas fa-star"></i>
                                    My Review
                                </h2>

                                <!-- review item start -->
                                @forelse( auth('customer')->user()->review as $review )
                                <div class="profile-review-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="{{ route('productdetails',$review->product->thumbnail) }}">
                                                <img src="{{ asset('images/product/'. $review->product->thumbnail) }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-10">
                                            <p>
                                                {{ $review->review }}
                                            </p>
                                            <p>{{ auth('customer')->user()->name }} - {{ $review->created_at->toDayDateTimeString() }}</p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="alert alert-warning">No review found</p>
                                @endforelse
                                <!-- review item end -->


                            </div>
                            <!-- review end-->

                            <!-- wishlist -->
                            <div class="row profile-info hide-profile-info profile-sort-4">
                                <h2 style="margin-bottom: 15px;">
                                <i class="fas fa-heart"></i>
                                    My wishlists
                                </h2>

                                <!-- review item start -->
                                @forelse( auth('customer')->user()->wishlist as $wishlist )
                                @if( $wishlist->product->is_active == true )
                                <div class="profile-review-item">
                                    <div class="row">
                                        <div class="col-md-2 col-2">
                                            <a href="{{ route('productdetails', $wishlist->product->slug) }}">
                                                <img src="{{ asset('images/product/'.$wishlist->product->thumbnail) }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-10 col-10">
                                            <p> <b>Name :</b> {{ $wishlist->product->name }}</p>
                                            <p> <b>Price :</b> {{ $wishlist->product->offer_price ? $wishlist->product->offer_price : $wishlist->product->price }} BDT</p>
                                            <form action="{{ route('remove.wishlist',$wishlist->id) }}" method="post">
                                                @csrf
                                                <button>Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endif
                                @empty
                                <p class="alert alert-warning">No item found in wishlist</p>
                                @endforelse
                                <!-- review item end -->

                            </div>
                            <!-- wishlist end-->

                            <!-- change password -->
                            <div class="row profile-info hide-profile-info profile-sort-5">
                                

                                <h2 style="margin-bottom: 15px;">
                                <i class="fas fa-key"></i>
                                    Change password
                                </h2>

                                <form action="{{ route('profile.pass.change', auth('customer')->user()->id  ) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning">Change</button>
                                    </div>
                                </form>

                            </div>
                            <!-- change password end-->

                        </div>

                  </div>
                  <!-- right part end -->

            </div>
      </div>
</section>
<!-- profile section end -->

@endsection
<!-- ========== HEADER ========== -->
<header id="header" class="u-header u-header-left-aligned-nav" style="margin-bottom: 15px">
    <div class="u-header__section">

        <!-- Logo-Search-header-icons -->
        <div class="bg-primary" id="topbar" style="z-index: 15;transition:all 0.4s ease-in-out 0s;">
            <div class="container">
                <div class="row min-height-64 align-items-center position-relative">


                    <!-- Logo-offcanvas-menu -->
                    <div class="col-md-3 col-5 site-logo" >
                        <!-- Nav -->
                        <nav class="navbar navbar-expand u-header__navbar py-0">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                href="{{ route('home') }}" aria-label="Electro" style="display: block;
    width: 100%;margin-right: 0">
                                @php
                                    $logo = App\Models\ContactDetail::first()->logo;
                                @endphp
                                <img src="{{ asset('images/logo/'.$logo) }}"
                                    class="logo-image" alt="">
                            </a>
                            <!-- End Logo -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->

                    <!-- Search Bar -->
                    <div class="col-md-6 d-none d-xl-block topbar-search topbar-search-lg-pc">
                        <form class="js-focus-state" method="get" action="{{ route('search') }}">
                            @csrf
                            <label class="sr-only" for="searchproduct">Search</label>
                            <div class="input-group topbar-search">
                                <input type="search"
                                    class="form-control py-2 pl-5 font-size-15 border-right-0 height-42 border-width-0 rounded-left-pill border-primary"
                                    name="search" id="searchproduct-item" placeholder="Search For Products"
                                    aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
                                    <!--<select-->
                                    <!--    class="js-select selectpicker dropdown-select custom-search-categories-select bg-white"-->
                                    <!--    data-style="btn height-42 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-primary border-width-0 pl-0 pr-5 py-2"-->
                                    <!--    name="category_id">-->
                                    <!--    <option disabled selected>Select Category</option>-->
                                    <!--    @foreach( App\Models\Category::where('is_active', true)->get() as $category )-->
                                    <!--    <option value="{{ $category->id }}">{{ $category->name }}</option>-->
                                    <!--    @endforeach-->
                                    <!--</select>-->
                                    <!-- End Select -->
                                    <button class="btn btn-dark height-42 py-2 px-3 rounded-right-pill search-button"
                                        type="submit" id="searchProduct1">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Bar -->

                    <!-- Header Icons -->
                    <div class="col-md-3 col-7 text-right text-xl-left pl-xl-3 position-static header-right" >
                        <div class="">
                            <ul class="d-flex list-unstyled mb-0 align-items-center topbar-ul-icon">

                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static topbar-search-sm-mob">
                                    <a id="searchClassicInvoker"
                                        class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                        href="javascript:;" role="button" data-toggle="tooltip" data-placement="top"
                                        title="Search" aria-controls="searchClassic" aria-haspopup="true"
                                        aria-expanded="false" data-unfold-target="#searchClassic"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic"
                                        class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                        aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state" action="{{ route('search') }}" method="get">
                                            @csrf
                                            <label class="sr-only" for="searchproduct">Search</label>
                                            <div class="input-group topbar-search">
                                                <input type="search"
                                                    class="form-control py-2 pl-5 font-size-15 border-right-0 height-42 border-width-0 rounded-left-pill border-primary"
                                                    name="search" id="searchproduct-item"
                                                    placeholder="Search for Products" aria-label="Search For Products"
                                                    aria-describedby="searchProduct1" required>
                                                <div class="input-group-append">
                                                    <!-- Select -->
                                                    
                                                    <!-- End Select -->
                                                    <button
                                                        class="btn btn-dark height-42 py-2 px-3 rounded-right-pill search-button"
                                                        type="submit" id="searchProduct1">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->


                                <!-- profile start -->
                                @if( auth('customer')->check() )
                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="{{ route('profile', auth('customer')->user()->id ) }}"
                                        class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                                        data-placement="top" title="Profile">
                                        <i class="fas fa-user-circle" style="color: #ae0101;"></i>
                                        <span>
                                    </a>
                                </li>
                                @else
                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="{{ route('login') }}" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="Login">
                                        <i class="fas fa-user-circle" style="color: #031b4e;"></i>
                                        <span>
                                    </a>
                                </li>
                                @endif
                                <!-- profile end -->

                                <li class="col pr-xl-0 px-2 px-sm-3 order-track">
                                    <a class="text-gray-90 position-relative d-flex " data-toggle="tooltip"
                                        data-placement="top" title="Order tracking">
                                        <i class="fas fa-truck" style="color: #031b4e;"></i>
                                    </a>
                                    <div class="order-track-block">
                                        @if( auth('customer')->check() )
                                        <h2>My last 5 order</h2>
                                        @forelse( auth('customer')->user()->order->take(5) as $order )
                                        <p class="order-track-p">
                                            <a
                                                href="{{ route('order.track',['token' => \Illuminate\Support\Str::random(80), 'id' => $order->order_id ]) }}">{{ $order->created_at->toDateString() }}
                                                - Order {{ $order->order_id }}</a>
                                        </p>
                                        @empty
                                        <p>No order found</p>
                                        @endforelse
                                        @endif
                                        <h2>Track my order</h2>
                                        <form action="{{ route('track') }}" method="post"
                                            class="order-track-form ajax-form">
                                            @csrf
                                            <div class="form-group">
                                                <label>Your order id</label>
                                                <div>
                                                    <input type="text" class="form-control order-input" name="order_id">
                                                    <button type="submit">
                                                        <i class="fas fa-angle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                                <li class="col pr-xl-0 px-2 px-sm-3 compare-nav">
                                    <a href="{{ route('compare.show') }}" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="Compare">
                                        <i class="fas fa-balance-scale" style="color: #031b4e;"></i>

                                        <span class="compare_length width-22 height-22 bg-dark position-absolute align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white"
                                            id="compare_length"></span>
                                    </a>
                                </li>

                                <li class="col pr-xl-0 px-2 px-sm-3">
                                    <a href="{{ route('checkout') }}" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="fas fa-shopping-cart"style="color: #031b4e;"></i>
                                        <!--<img src="https://img.icons8.com/material-outlined/32/000000/shopping-cart--v1.png" class="topbar-icon"/>-->
                                        <span
                                            class="cartLength width-22 height-22 bg-dark position-absolute align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white"
                                            id="cartLength">0</span>
                                    </a>
                                </li>

                                <li class="col mobile-nav">
                                    <a class="text-gray-90">
                                        <i class="fas fa-bars"></i>
                                        <i class="fas fa-times"></i>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->

        <!-- slide nav mobile start -->
        <div class="slide-nav">

            <!-- top part start -->
            @if( auth('customer')->check() )
            <div class="login-part">
                <a href="{{ route('profile', auth('customer')->user()->id ) }}">My profile</a>
            </div>
            @else
            <div class="login-part">
                <a href="{{ route('login') }}">Login</a>
            </div>
            @endif
            <!-- top part end -->

            <ul>
                <li>
                    <a href="{{ route('shop') }}"> <i class="fas fa-shopping-bag"></i> All Products</a>
                </li>
                <li>
                    <a href="{{ route('stores') }}"> <i class="fas fa-store"></i> Our Stores</a>
                </li>
                <li>
                    <a href="{{ route('corporate_sale') }}"> <i class="fas fa-tags"></i> Corporate Sales</a>
                </li>
                <li>
                    <a href="{{ route('service_complaint') }}"> <i class="fas fa-truck"></i> Service Complaint</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"> <i class="fas fa-phone"></i> Contact Us</a>
                </li>
                <li>
                    <a href="{{ route('about') }}"> <i class="fas fa-user"></i> About Us</a>
                </li>
            </ul>

        </div>
        <!-- slide nav mobile end -->

        <!-- Vertical-and-secondary-menu -->
        <div class="box-shadow-1 d-none d-xl-block Vertical-and-secondary-menu" style="background: #f8f8f8; padding: 5px 0">
            <div class="container">
                <div class="row">

                    <!-- Secondary Menu -->
                    <div class="col-md-11 secondary-menu" style='padding-left: 0'>
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">

                                    <!-- category list without home page showing start -->
                                    @if( Route::currentRouteName() != 'a' )
                                    <li class="nav-item u-header__nav-item topbar_all_category"
                                        style="position: relative">
                                        <a class="nav-link u-header__nav-link show_all_category" aria-haspopup="true"
                                            aria-expanded="false" aria-labelledby="blogSubMenu"
                                            style="color: #000000!important"> <i class="fas fa-bars" style="padding-right: 10px"></i> All Category</a>
                                        @if( Route::currentRouteName() != 'home' )
                                        <div class="topbar_all_category_list">
                                            <ul>
                                                @foreach (App\Models\Category::orderBy('position', 'asc')
                                                ->where('is_active', true)
                                                ->take(App\Models\Counting::first()->left_category)
                                                ->get()
                                                as $category)
                                                @if( $category->subcategory->count() > 0 && $category->product->count() > 0 )
                                                <li>
                                                    <a href="{{ route('category', $category->slug) }}">
                                                        <i class="{{ $category->icon }}" style="margin-right: 5px"></i>
                                                        {{ $category->name }}
                                                        <i class="fas fa-angle-right"></i>
                                                    </a>
                                                    <div class="topbar_all_sub_category">
                                                        <ul>
                                                            @foreach( $category->subcategory->where("is_active", true) as $sub_cat )
                                                            <li>
                                                                <a href="{{ route('subcategory', $sub_cat->slug) }}">
                                                                    {{ $sub_cat->name }}
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endif
                                    <!-- category list without home page showing end -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item" style="margin-left: 5px">
                                        <a class="nav-link u-header__nav-link" href="{{ route('home') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu">
                                            <span>
                                                <i class="fas fa-home"></i> Home
                                            </span>
                                        </a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('shop') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu">
                                            <span> <i class="fas fa-shopping-bag"></i> All Products</span>
                                        </a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('stores') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu"><span> <i class="fas fa-store"></i> Our Stores</span></a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('corporate_sale') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu"><span> <i class="fas fa-tags"></i> Corporate Sales</span></a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('service_complaint') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu"><span> <i class="fas fa-truck"></i> Service Complaint</span></a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('contact') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu"><span> <i class="fas fa-phone"></i> Contact Us</span></a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('about') }}"
                                            aria-haspopup="true" aria-expanded="false"
                                            aria-labelledby="blogSubMenu"><span> <i class="fas fa-user"></i> About Us</span></a>
                                    </li>
                                    <!-- End Trending Styles -->

                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Secondary Menu -->

                    <div class="col-md-1 mega-offer" style="padding-right: 0">

                                <a href="{{ route('offer') }}" onmouseover="showOffer()" onmouseout="hideOffer()">
                                    <img src="{{ asset('images/offer-1.gif') }}">
                                </a>


                                <!-- offer list start -->
                                @if( App\Models\Offer::where('status', true)->get()->count() > 0 )
                                <ul class="offer-list" id="offer-list" onmouseover="showOffer()" onmouseout="hideOffer()">
                                    @foreach( App\Models\Offer::where('status', true)->get() as $offer )
                                    <li>
                                        <a href="{{ route('offer.single', $offer->slug) }}">{{ $offer->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                <!-- offer list end -->

                    </div>

                </div>
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>
<!-- ========== END HEADER ========== -->

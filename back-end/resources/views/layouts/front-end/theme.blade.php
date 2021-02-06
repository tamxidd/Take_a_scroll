<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Take a Scroll</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset("css/bootstrap.min.css") }}>

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href={{  asset("css/icon-font.min.css") }}>

    <!-- Plugins CSS -->
    <link rel="stylesheet" href={{ asset("css/plugins.css") }}>

    <!-- Main Style CSS -->
    <link rel="stylesheet" href={{ asset("css/style.css") }}>

    <!-- Modernizer JS -->
    <script src={{ asset("js/vendor/modernizr-2.8.3.min.js") }}></script>

</head>

<body>

<!-- Ft -->
<div class="header-section section">

    <!-- Header Top Start -->
    <div class="header-top header-top-one header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-10 mb-10">
                    <!-- Header Links Start -->
                    <div class="header-links">
                        <a href="track-order.html"><img src="{{ asset('assets/images/icons/car.png') }}" alt="Car Icon"> <span>Track your order</span></a>
                        {{-- <a href="store.html"><img src="{{ asset('assets/images/icons/marker.png') }}" alt="Car Icon"> <span>Locate Store</span></a> --}}
                    </div><!-- Header Links End -->
                </div>

                <div class="col order-12 order-xs-12 order-lg-2 mt-10 mb-10">
                    <!-- Header Advance Search Start -->
                    <div class="header-advance-search">

                        <form action="#">
                            <div class="input"><input type="text" placeholder="Search your product"></div>
                            <div class="select">
                                <select class="nice-select">
                                    <option>All Categories</option>
                                    <option>Mobile</option>
                                    <option>Computer</option>
                                    <option>Laptop</option>
                                    <option>Camera</option>
                                </select>
                            </div>
                            <div class="submit"><button><i class="icofont icofont-search-alt-1"></i></button></div>
                        </form>

                    </div><!-- Header Advance Search End -->
                </div>

                <div class="col order-2 order-xs-2 order-lg-12 mt-10 mb-10">
                    <!-- Header Account Links Start -->
                    <div class="header-account-links">
                        <a href="register.html"><i class="icofont icofont-user-alt-7"></i> <span>my account</span></a>
                        @if(!auth()->user())
                        <a href="{{ route('login')}}"><i class="icofont icofont-login d-none"></i> <span>Login</span></a>
                        @else
                            @if(auth()->user()->type === 'vendor')
                            <a href="{{ route('dashboard')}}"><i class="icofont icofont-login d-none"></i> <span>Dashboard</span></a>
                            @else
                            <a href="{{ route('customer.dashboard')}}"><i class="icofont icofont-login d-none"></i> <span>Dashboard</span></a>
                            @endif

                        @endif
                    </div><!-- Header Account Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <h1>Take A Scroll</h1>
                            {{-- <img src="assets/images/logo.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                            <img class="theme-dark" src="assets/images/logo-light.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template"> --}}
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                    <!-- Main Menu Start -->
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="active"><a href="{{ url('/') }}">HOME</a></li>
                                <li class="menu-item-has-children"><a href="javascript:void(0)">Shops</a>
                                   <ul class="mega-menu three-column ">
                                        <li>
                                           <ul>
                                                <li><strong>Electronics</strong></li>
                                                @forelse($Electronics as $shop)
                                                    <li style="margin-left: -1rem;"><a  href="{{ route('customer.shop.show',$shop->id) }}">{{ $shop->name }}</a>
                                                    </li>
                                                @empty
                                                    <h1 class="text text-danger">No Shops available...!!</h1>
                                                @endforelse
                                           </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li><strong>Realestate</strong></li>
                                                @forelse($Realestate as $shop)
                                                    <li style="margin-left: -1rem;"><a  href="{{ route('customer.shop.show',$shop->id) }}">{{ $shop->name }}</a>
                                                    </li>
                                                @empty
                                                    <li class="text text-danger">No Shops available...!!</li>
                                                @endforelse
                                            </ul>
                                        </li>
                                        <li>
                                           <ul>
                                                <li><strong>Cars</strong></li>
                                                @forelse($Cars as $shop)
                                                    <li style="margin-left: -1rem;"><a href="{{ route('customer.shop.show',$shop->id) }}">{{ $shop->name }}</a>
                                                    </li>
                                                @empty
                                                    <li class="text text-danger">No Shops available...!!</li>
                                                @endforelse
                                           </ul>
                                            {{-- <li class="menu-item-has-children"><a href="single-product.html">Single Product</a>
                                                <ul class="sub-menu">
                                                    <li><a href="single-product.html">Single Product 1</a></li>
                                                </ul>
                                            </li> --}}
                                        </li>
                                   </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="javascript:void(0)">Categories</a>
                                    <ul class="mega-menu three-column">
                                        @forelse ($categories as $cat)
                                            <li><a href="#">{{ $cat->name }}</a>
                                                <ul>
                                                    @forelse ($cat->subCategories as $sub_cat)
                                                        <li><a href="{{ route('category.products.index',['category'=>$cat->id,'sub_cat_name'=>$sub_cat->name,'sub_cat'=>$sub_cat->id]) }}">{{ $sub_cat->name }}</a></li>
                                                    @empty
                                                        <h1 class="text text-danger"> NO Data Found...!!</h1>
                                                    @endforelse
                                                </ul>
                                            </li>
                                        @empty
                                            <h1 class="text text-danger"> NO Data Found...!!</h1>
                                        @endforelse

                                    </ul>
                                </li>
                                <li><a href="contact.html">CONTACT</a></li>
                            </ul>
                        </nav>
                    </div><!-- Main Menu End -->
                </div>

                <div class="col order-2 order-lg-12 order-xl-12">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">

                        <!-- Compare -->
                        {{-- <a href="compare.html" class="header-compare"><i class="ti-control-shuffle"></i></a> --}}
                        <!-- Wishlist -->
                        <a href="wishlist.html" class="header-wishlist"><i class="ti-heart"></i> <span class="number">3</span></a>
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class=""><i class="ti-shopping-cart"></i> <span class="number">{{ $cart }}</span></a>

                    </div><!-- Header Shop Links End -->
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>
        </div>
    </div><!-- Header Bottom End -->

    <!-- Header Category Start -->
    <div class="header-category-section">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Header Category -->
                    <div class="header-category">

                        <!-- Category Toggle Wrap -->
                        <div class="category-toggle-wrap d-block d-lg-none">
                            <!-- Category Toggle -->
                            <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                        </div>

                        <!-- Category Menu -->
                        <nav class="category-menu">
                            <ul style="border-bottom:1px solid black;">
                                {{-- <li><a href="category-1.html">Tv & Audio System</a></li>
                                <li><a href="category-2.html">Computer & Laptop</a></li>
                                <li><a href="category-3.html">Phones & Tablets</a></li>
                                <li><a href="category-1.html">Home Appliances</a></li>
                                <li><a href="category-2.html">Kitchen appliances</a></li>
                                <li><a href="category-3.html">Accessories</a></li> --}}
                            </ul>
                        </nav>

                    </div>

                </div>
            </div>
        </div>
    </div><!-- Header Category End -->

</div>
<!-- Header Section End -->


@yield('section')


<!-- Footer Section Start -->
<div class="footer-section section bg-ivory">

    <!-- Footer Top Section Start -->
    <div class="footer-top-section section pt-90 pb-50">
        <div class="container">

            <!-- Footer Widget Start -->
            <div class="row">
                <div class="col mb-90">
                    <div class="footer-widget text-center">
                        {{-- <div class="footer-logo">
                            <img src="assets/images/logo.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                            <img class="theme-dark" src="assets/images/logo-light.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                        </div> --}}
                        <p>Electronics product actual teachings of  he great explorer of the truth, the malder of human happiness. No one rejects</p>
                    </div>
                </div>
            </div><!-- Footer Widget End -->

            <div class="row">

                <!-- Footer Widget Start -->
                <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">CONTACT INFO</h4>

                        <p class="contact-info">
                            <span>Address</span>
                            You address will be here <br>
                             Lorem Ipsum text                        </p>

                        <p class="contact-info">
                            <span>Phone</span>
                            <a href="tel:01234567890">01234 567 890</a>
                            <a href="tel:01234567891">01234 567 891</a>
                        </p>

                        <p class="contact-info">
                            <span>Web</span>
                            <a href="mailto:info@example.com">info@example.com</a>
                            <a href="#">www.example.com</a>
                        </p>

                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">CUSTOMER CARE</h4>

                        <ul class="link-widget">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Cart</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>

                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">INFORMATION</h4>

                        <ul class="link-widget">
                            <li><a href="#">Track your order</a></li>
                            <li><a href="#">Locate Store</a></li>
                            <li><a href="#">Online Support</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Payment</a></li>
                            <li><a href="#">Shipping & Returns</a></li>
                            <li><a href="#">Gift coupon</a></li>
                            <li><a href="#">Special coupon</a></li>
                        </ul>

                    </div>
                </div><!-- Footer Widget End -->

                <!-- Footer Widget Start -->
                <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <h4 class="widget-title">LATEST TWEET</h4>

                        <div class="footer-tweet"></div>

                    </div>
                </div><!-- Footer Widget End -->

            </div>

        </div>
    </div><!-- Footer Bottom Section Start -->

</div><!-- Footer Section End -->




<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src={{ asset("js/vendor/jquery-1.12.4.min.js") }}></script>
<!-- Popper JS -->
<script src={{ asset("js/popper.min.js") }}></script>
<!-- Bootstrap JS -->
<script src={{ asset("js/bootstrap.min.js") }}></script>
<!-- Plugins JS -->
<script src={{ asset("js/plugins.js") }}></script>

<!-- Main JS -->
<script src={{ asset("js/main.js") }}></script>






</body>

</html>

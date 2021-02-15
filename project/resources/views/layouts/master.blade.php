<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>@yield('title')</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('frontend') }}/images/favicon2.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.css">
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slicknav.min.css">
	<script src="sweetalert2.min.js"></script>
	<link rel="stylesheet" href="sweetalert2.min.css">
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/reset.css">
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
	<link rel="stylesheet" href="{{ asset('frontend') }}/css/mystyle.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">
	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	<style>
		.header.shop .logo {
			float: left;
			margin: 0px 0px -32px  !important;
			width: 207px  !important;
			height: 100px;
		}
	</style>
	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li class="hmleft"><i class="ti-headphone-alt"></i>{{ App\SiteInfo::latest()->take(1)->first()->number1 ?? ""}}</li>
								<li class="sm"><i class="ti-email"></i> {{ App\SiteInfo::latest()->take(1)->first()->email1 ?? ""}}</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li class="sm"><i class="ti-location-pin"></i><a href="{{ route('ContactUs') }}"> Store location</a></li>
								<li class="sm"><i class="ti-alarm-clock"></i> <a href="">Daily deal</a></li>
								<li class="sm"><i class="ti-user"></i> <a href="{{ url('home') }}">My account</a></li>
								
								@auth
								@if(Auth::user()->status == 1)
									<li class="hmright"><i class="ti-power-off"></i><a href="{{ url('/') }}">Dashboard</a></li>
								@else
									<li class="hmright"><i class="ti-power-off"></i><a href="{{ url('/backend/dashboard') }}">Go to Admin Dashboard</a></li>
								@endif
								@else
									<li class="hmright"><i class="ti-power-off"></i><a href="{{ url('register') }}">Login/Register</a></li>
								@endauth
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<style>
							.header.shop .logo {
								float: left;
								margin: -20px 0px -20px;
								width: 260px;
								height: 100px;
							}
						</style>
						<div class="logo">
							<a href="{{ url('/') }}"><img src="{{ asset('frontend') }}/images/deshbuy.png" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form" method="post" action="{{ route('Search') }}">
								@csrf
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<div class="mobile-nav"></div>
					</div>
					<style>
					.header.shop .search-bar {
						width: 390px !important;
					}
					</style>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								
								<form method="post" action="{{ route('Search') }}">
									@csrf
									<input name="search" placeholder="Search Products Here....." type="search">
									<button type="submit" class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="{{ route('Wishlist') }}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"><span class="total-count">{{ App\Wishlist::count() }}</span></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="{{ route('Compare') }}" class="single-icon"><i class="fa fa-signal" aria-hidden="true"><span class="total-count">{{ App\Compare::count() }}</span></i></a>
							</div>
							
							@php
        						$user_ip = $_SERVER['REMOTE_ADDR'];
								$cart = App\Cart::with('product')->where('user_ip', $user_ip)->get();
								$total = 0;
								foreach($cart as $val){
									if($val->product->discount_price == NULL){
										$total += $val->product->product_price * $val->quantity;
									}
									else {
										$total += $val->product->discount_price * $val->quantity;
									}
								}
							@endphp
							<div class="sinlge-bar shopping">
								<a href="" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{ $cart->count() }}</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>{{ $cart->count() }} Items</span>
										<a href="{{ route('Cart') }}">View Cart</a>
									</div>
									<ul class="shopping-list">
										@foreach($cart as $item)
										<li>
											<a href="{{ route('SingleCartDelete', $item->id) }}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="{{ route('SingleProduct', $item->product->id) }}"><img src="{{ asset('thumbnail/product/'.$item->product->product_thumbnail )}}" alt="{{ $item->product->product_name }}"></a>
											<h4><a href="{{ route('SingleProduct', $item->product->id) }}">{{ $item->product->product_name }}</a></h4>
											@if($item->product->discount_price == NULL)
											<p class="quantity">{{$item->quantity}}x - <span class="amount">৳ {{$item->quantity * $item->product->product_price }}</span></p>
											@else
											<p class="quantity">{{$item->quantity}}x - <span class="amount">৳ {{$item->quantity * $item->product->discount_price }}</span></p>
											@endif
										</li>
										@endforeach
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">৳ {{ $total }}</span>
										</div>
										<a href="{{ route('Checkout') }}" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <div class="col-12">
                            <div class="menu-area">
                                <!-- Main Menu -->
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">	
                                        <div class="nav-inner">	
                                            <ul class="nav main-menu menu navbar-nav">
                                                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                                                <li><a href="{{ route('Shop') }}">Shop</a><span class="new">New</span></li>					
                                                <li><a href="">Pages<i class="ti-angle-down"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="{{ route('Shop') }}">Shop Grid</a></li>
                                                        <li><a href="{{ route('Cart') }}">Cart</a></li>
                                                        <li><a href="{{ route('Wishlist') }}">Wishlist</a></li>
                                                    </ul>
                                                </li>								
                                                <!--li><a href="{{route('Blog')}}">Blog</a></li-->
                                                <li><a href="{{ route('ContactUs') }}">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <!--/ End Main Menu -->	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--/ End Header Inner -->
	</header>
	<!--/ End Header -->
	
	@yield('content')
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-6">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
	
	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="http://wpthemesgrid.com/themes/free/eshop/mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->
	
	@yield('modal')
	<style>
		@media screen and (max-width: 600px){
			.footer-logo {
			padding: 0px 0px;
			margin: 0px 85px !important;
			}
		}
		
	</style>
	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo footer-logo">
								<a href="{{url('/')}}"><img src="{{ asset('frontend') }}/images/deshbuy.png" alt="#"></a>
							</div>
							<p class="text">{{ App\SiteInfo::latest()->take(1)->first()->description ?? ""}}</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:{{ App\SiteInfo::latest()->take(1)->first()->number1 ?? ''}}">{{ App\SiteInfo::latest()->take(1)->first()->number1 ?? ""}}</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-6">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-6">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>{{ App\SiteInfo::latest()->take(1)->first()->road_no ?? ""}}, {{ App\SiteInfo::latest()->take(1)->first()->city ?? ""}}.</li>
									<li>{{ App\SiteInfo::latest()->take(1)->first()->country ?? ""}}.</li>
									<li>{{ App\SiteInfo::latest()->take(1)->first()->email1 ?? ""}}</li>
									<li>{{ App\SiteInfo::latest()->take(1)->first()->number1 ?? ""}}</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="ti-facebook"></i></a></li>
								<li><a href="#"><i class="ti-twitter"></i></a></li>
								<li><a href="#"><i class="ti-flickr"></i></a></li>
								<li><a href="#"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2020 <a href="" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{ asset('frontend') }}/images/payments.png" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery-migrate-3.0.0.js"></script>
	<script src="{{ asset('frontend') }}/js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="{{ asset('frontend') }}/js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="{{ asset('frontend') }}/js/colors.html"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset('frontend') }}/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('frontend') }}/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="{{ asset('frontend') }}/js/magnific-popup.js"></script>
	<!-- Fancybox JS -->
	<script src="{{ asset('frontend') }}/js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="{{ asset('frontend') }}/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="{{ asset('frontend') }}/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="{{ asset('frontend') }}/js/nicesellect.js"></script>
	<!-- Ytplayer JS -->
	<script src="{{ asset('frontend') }}/js/ytplayer.min.js"></script>
	<!-- Flex Slider JS -->
	<script src="{{ asset('frontend') }}/js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="{{ asset('frontend') }}/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="{{ asset('frontend') }}/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="{{ asset('frontend') }}/js/easing.js"></script>
	<!-- Active JS -->
	<script src="{{ asset('frontend') }}/js/active.js"></script>

	<script src="{{ asset('frontend') }}/js/cloud-zoom.js"></script>
					
	@yield('footer_js')
	
</body>

<!-- Mirrored from wpthemesgrid.com/themes/free/eshop/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Jul 2020 14:22:40 GMT -->
</html>
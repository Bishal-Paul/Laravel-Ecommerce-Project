@extends('frontend.master')
@section('title')
	Thank You - DeshBuy
@endsection
@section('top_nav')
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
@endsection

@section('content')
    <section class="mail-success section page">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 col-12">
					<div class="mail-inner">
						<h2><span>Order</span> Complete</h2>
						<p>Thank you so much for your Order. We've sent an e-mail to your E-mail addess.</p>
						<div class="button">
							<a class="btn primary" href="{{url('/')}}">Go Home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
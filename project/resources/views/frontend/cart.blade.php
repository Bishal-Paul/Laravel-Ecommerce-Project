@extends('frontend.master')

@section('title')
	Cart - DeshBuy
@endsection

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active">Cart</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Shopping Summery -->
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>PRODUCT</th>
							<th>NAME</th>
							<th class="text-center">PRICE</th>
							<th class="text-center">QUANTITY</th>
							<th class="text-center">TOTAL</th>
							<th class="text-center"><i class="ti-trash remove-icon"></i></th>
						</tr>
					</thead>
					<tbody>
						@forelse($cart as $item)
						<style>
							.myimg {
								width: 250px !important;
								height: 85px !important;
							}
						</style>
						<tr>
							<td class="image" data-title="image"><img class="myimg" src="{{ asset('thumbnail/product/'.$item->product->product_thumbnail) }}" alt="{{$item->product->product_name}}"></td>
							<td class="product-des" data-title="Description">
								<p class="product-name"><a href="#">{{ $item->product->product_name }}</a></p>
								<p class="product-des">{{ $item->product->product_summary }}</p>
							</td>
							@if($item->product->discount_price == NULL)
							<td class="price" data-title="Price"><span>৳{{$item->product->product_price }}</span></td>
							@else
							<td class="price" data-title="Price"><span>৳{{$item->product->discount_price }}</span></td>
							@endif

							<td class="qty" data-title="Qty">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" class="input-number" data-min="1" data-max="100" value="{{ $item->quantity }}">
									<div class="button plus">
										<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
											<i class="ti-plus"></i>
										</button>
									</div>
								</div>
								<!--/ End Input Order -->
							</td>
							@if($item->product->discount_price == NULL)
							<td class="total-amount" data-title="Total"><span>৳{{$item->product->product_price * $item->quantity }}</span></td>
							@else
							<td class="total-amount" data-title="Total"><span>৳{{$item->product->discount_price * $item->quantity }}</span></td>
							@endif
							<td class="action" data-title="Remove"><a href="{{ route('SingleCartDelete', $item->id) }}"><i class="ti-trash remove-icon"></i></a></td>
						</tr>
						@empty
						<td class="text-center" colspan="30">No Cart Data Available</td>
						@endforelse
					</tbody>
				</table>
				<!--/ End Shopping Summery -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Total Amount -->
				<div class="total-amount">
					<div class="row">
						<div class="col-lg-8 col-md-5 col-12">
							<div class="left">
								<div class="coupon">
									<form action="{{ route('CartCoupon') }}" method="post">
										@csrf
										<input name="coupon" class="@error('coupon') is-invalid @enderror" placeholder="Enter Your Coupon">
										<button class="btn">Apply</button>
										@if(session('success'))
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong>Ops!</strong> {{session('success')}}.
										</div>
										@endif
									</form>
								</div>

							</div>
						</div>
						<div class="col-lg-4 col-md-7 col-12">
							<div class="right">
								<ul>
									<li>Cart Subtotal<span>৳ {{ $subtotal }}</span></li>
									<li>You Save<span>৳ {{ $after_discount }}</span></li>
									<li class="last">You Pay<span>৳ {{ $subtotal - $after_discount }} </span></li>
								</ul>
								<div class="button5">
									<a href="{{ route('Checkout') }}" class="btn">Checkout</a>
									<a href="{{ route('Shop') }}" class="btn">Continue shopping</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ End Total Amount -->
			</div>
		</div>
	</div>
</div>
<!--/ End Shopping Cart -->

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
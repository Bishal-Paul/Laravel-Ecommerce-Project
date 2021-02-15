@extends('frontend.master')

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
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="{{ route('Wishlist') }}">Wishlist</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
<style>
    .mycls {
        padding: 90px 0px;
    }
    .mysty{
        text-align: center;
    }
    .wishlist-item table .td-add-to-cart > a {
        background: #f7941d !important;
        color: #ffffff !important;
    }
    .wishlist-item table .td-add-to-cart > a:hover {
        background: #000 !important;
    } 
</style>

    <div class="container mycls">
        <div class="col-main col-sm-12 col-xs-12">
            <div class="my-account">
            <div class="page-title">
                <h4>My Wishlist</h4>
            </div>
            <div class="wishlist-item table-responsive">
                <table class="col-md-12">
                <thead>
                    <tr>
                    <th class="th-delate">Remove</th>
                    <th class="th-product">Images</th>
                    <th class="th-details">Product Name</th>
                    <th class="th-price">Unit Price</th>
                    <th class="th-total th-add-to-cart">Add to Cart </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($wishlist as $item)
                    <tr>
                        <td class="th-delate"><a href="{{ route('DeleteWishlist', $item->id) }}">X</a></td>
                        <td class="th-product"><a href="{{ route('SingleProduct', $item->product->id) }}"><img src="{{ asset('thumbnail/product/'.$item->product->product_thumbnail) }}" alt="{{ $item->product->product_name}}"></a></td>
                        <td class="th-details"><h2  class="mysty"><a href="{{ route('SingleProduct', $item->product->id) }}">{{ $item->product->product_name }}</a></h2></td>
                        @if($item->product->discount_price == NULL)
                        <td class="th-price">৳ {{ $item->product->product_price }}</td>
                        @else 
                        <td class="th-price">৳ {{ $item->product->discount_price }}</td>
                        @endif
                        <th class="td-add-to-cart"><a href="{{ route('SingleCart', $item->product->id) }}"> Add to Cart</a></th>
                    </tr>
                @endforeach   
                </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection
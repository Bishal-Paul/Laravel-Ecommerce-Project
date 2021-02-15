@extends('frontend.master')
@section('title')
	Search - DeshBuy
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
    <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-inner">
                            <ul class="bread-list">
                                <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                                <li class="active"><a href="">Search Results</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Breadcrumbs -->
    <!-- Product Style -->
		<section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								<div class="single-widget search">
									<h3 class="title">Categories</h3>
									<ul class="categor-list">
                                        @foreach($category as $cat)
										    <li><a href="{{route('SingleShop', $cat->id)}}">{{ $cat->category_name }}</a></li>
										@endforeach
									</ul>
								</div>
								<!--/ End Single Widget -->
                                <!-- Shop By Price -->
                                <style>
									.range .input{
										border: 1px solid #f7941d;
    									padding: 8px 8px;
										border-radius: 0px;
										margin: -8px -18px;
									}
									.range .mybtn {
										padding: 10px 10px;
										border-radius: 0px;
										background: #f7941d;
										color: #fff;
										margin-left: -8px;
									}
								</style>
                                <form action="{{route('ProductSearch')}}" method="post">
								@csrf
									<div class="single-widget range search">
										<h3 class="title">Shop by Price</h3>
										<input type="number" class="input myinput" name="start" placeholder="Enter starting Price"><br><br>
										<input type="number" class="input myinput" name="end" placeholder="Ending Price">
										<br><br>
										<input class="mybtn" type="submit" value="Search Product">
									</div>
								</form>
									<!--/ End Shop By Price -->
								<!-- Single Widget -->
								<div class="single-widget recent-post sm" >
									<h3 class="title">Recent post</h3>
									<!-- Single Post -->
									@foreach($recent as $item)
									<div class="single-post first">
										<div class="image">
											<img src="{{asset('thumbnail/product/'.$item->product_thumbnail)}}" alt="{{$item->product_name}}">
										</div>
										<div class="content">
											<h5><a href="{{ route('SingleProduct', $item->id) }}">{{$item->product_name}}</a></h5>
											@if($item->discount_price == NULL)
											<p class="price">৳ {{$item->product_price}}</p>
											@else 
											<p class="price">৳ {{$item->discount_price}}</p>
											@endif
											<ul class="reviews">
                                                @php
                                                    $sum = App\Review::where('product_id', $item->id)->sum('rating');
                                                @endphp

                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $sum)
                                                    <li><i class="fa fa-star"></i></li>
                                                    @else
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    @endif
                                                @endfor
											</ul>
										</div>
									</div>
									@endforeach
									<!-- End Single Post -->
								</div>
								<!--/ End Single Widget -->
								
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top sm">
									<div class="shop-shorter">
										<div class="single-shorter">
											<strong>{{ $searchproduct->count() }} result(s) for "{{ $query }}" </strong>
										</div>
									</div>
									<ul class="view-mode">
										<li><a href="{{ route('Shop') }}"><i class="fa fa-th-large"></i></a></li>
										<li class="active"><a href="{{ route('ShopListView') }}"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
                        <style>
                            .mybtn{
                                border: 1px solid #f7941d;
                                color: #fff;
                                border-radius: 0px;
                                padding: 10px 15px;
                                background: #f7941d;
                            }
                            .mybtn:hover {
                                background: #000;
                                border: 1px solid #000;
                            }

                            .my{
                                color: #000;
                            }
                            .my:hover {
                                color: #f7941d;
                            }

                            .small-image {
                                height: 280px;
                                width: 240px !important;
                            }

                            .shop-sidebar .single-post .reviews li i {
                                color: #f7941d;
                            }
                        </style>
                <div class="shop-inner">
                    <div class="product-list-area">
                        <ul class="products-list" id="products-list">
                        @forelse($searchproduct as $pro)
                            <li class="item ">
                                <div class="product-img">
                                    <a href="{{ route('SingleProduct', $pro->id) }}" title="{{ $pro->product_name}}">
                                    <figure> <img class="small-image" src="{{ asset('thumbnail/product/'.$pro->product_thumbnail) }}" alt="{{ $pro->product_name}}"></figure>
                                    </a> 
                                </div>
                                <div class="product-shop"><br>
                                    <h2 class="product-name"><a href="{{ route('SingleProduct', $pro->id) }}" title="{{ $pro->product_name}}">{{ $pro->product_name}}</a></h2>
                                        
                                    <div class="price-box">
									@if($pro->discount_price == NULL)
									<p class="special-price"> <span class="price-label"></span> <span class="price">৳ {{ $pro->product_price}} </span> </p>
									@else 
									<p class="special-price"> <span class="price-label"></span> <span class="price">৳ {{ $pro->discount_price}} </span> </p>
									@endif
                                    <div class="desc std sm">
                                    <p>{{ $pro->product_summary }} <a class="link-learn" title="Learn More" href="{{ route('SingleProduct', $pro->id) }}">Learn More</a> </p>
                                    </div>
                                    <div class="actions">
                                    <button class="button cart-button mybtn" title="Add to Cart" type="button"><a href="{{route('SingleCart', $pro->id)}}"><i class="fa fa-shopping-cart"></i><span>Add to Cart</span></a></button>
                                    <ul>
                                        <li class="my sm"> <a href="{{ route('AddWishlist', $pro->id) }}"> <i class="fa fa-heart"></i><span> Add to Wishlist</span> </a> </li>
                                        <li class="my sm"> <a href="{{ route('AddToCompare', $pro->id) }}"> <i class="fa fa-signal"></i><span> Add to Compare</span> </a> </li>
                                    </ul>
                                    </div>
                                </div>
                            </li>
                        @empty 
                        <h4 class="text-center">No Products Available by this name</h4>
                        @endforelse
                        </ul>
                    </div>
                </div>
                
            </div>
			</div>
		</div>
	</section>
		<!--/ End Product Style 1  -->
@endsection
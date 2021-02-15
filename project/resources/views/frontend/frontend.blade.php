@extends('frontend.master')
@section('title')
DeshBuy - Online Shop
@endsection
@section('content')

<!-- Slider Area -->
<style>
	.rightside {
		float: right;
		text-align: center;
		padding: 40px 0px;
		background: #FDFBEF;
	}

	.owl-prev {
		border: 1px solid #aeb2b3;
		width: 80px;
		padding: 5px 20px;
	}

	.owl-next {
		float: right;
		margin: -35px 105px 0px 0px;
		border: 1px solid #aeb2b3;
		padding: 5px 20px;
	}

	.owl-prev:hover,
	.owl-next:hover {
		background-color: #f7941d;
		color: #fff;
		border: 1px solid #f7941d;
	}

	.main-category {
		z-index: 222 !important;
	}

	.owl-stage-outer {
		height: 340px;
	}
</style>
<section class="hero-slider" style="background: #fdfbef; height: 450px;">
	<div class="col-lg-4 col-12 leftside">
	</div>
	<div class="col-lg-8 col-12 rightside">
		<div class="bannarowl-carousel owl-theme">
			@foreach($bannar as $item)
			<div class="item">
				<div class="owl-item" style="width: 795px; margin-right: 0px;height: 340px !important;">
					<div class="big-content" style="background-image: url('{{asset('thumbnail/bannar/'.$item->image)}}');height: 335px;">
						<div class="myinner" style="padding: 70px 25px 0px 350px;">
							<h4 class="offer sm">{{$item->offer}}</h4>
							<h6 class="title">{{$item->title}}</h6>
							<p class="des" style="line-height: 25px !important;padding: 25px 0px;">{{$item->description}}</p>
							<div class="button">
								<a href="{{route('Shop')}}" class="btn" style="color: #fff;">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<div class="product-area most-popular section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Flash Sale</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<style>
				.carousel-items {
					width: 250px;
				}

				.section-title {
					margin-bottom: 5px !important;
				}

				.section {
					padding: 50px 0;
				}
			</style>
			<div class="owl-carousel">

				@foreach($flashsale as $item)

				<div class="carousel-items">
					<div class="single-product">
						<div class="product-img">
							<a href="{{ route('SingleProduct', $item->id) }}">
								<img class="default-img imgheight" src="{{ asset('/thumbnail/product/'.$item->product_thumbnail) }}" alt="Flash Sale">
								<img class="hover-img imgheight" src="{{ asset('/thumbnail/product/'.$item->product_thumbnail) }}" alt="Flash Sale">
							</a>
							<div class="button-head">
								<div class="product-action">
									<a data-toggle="modal" class="sm" data-target="#exampleModal{{$item->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
									<a title="Wishlist" href="{{ route('AddWishlist', $item->id) }}" class="sm"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
									<a title="Compare" href="{{ route('AddToCompare', $item->id) }}" class="sm"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
								</div>
								<div class="product-action-2">
									<a title="Add to cart" class="hmcart" href="{{ route('SingleCart', $item->id) }}">Add to cart</a>
								</div>
							</div>
						</div>
						<div class="product-content">
							<h3><a href="{{ route('SingleProduct', $item->id) }}">{{ $item->product_name }}</a></h3>
							<div class="product-price">
								@if($item->discount_price == NULL)
								<span>৳ {{ $item->product_price }}</span>
								@else
								<span>৳ {{ $item->discount_price }}</span>
								@endif
							</div>
						</div>

					</div>
				</div>

				@endforeach


			</div>
		</div>
	</div>
</div>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section trending">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Trending Item</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="product-info">
					<div class="nav-main">
						<!-- Tab Nav -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#all">All product</a>
							</li>
							<style>
								.nav-tabs>li>a:hover {
									border: none;
								}

								.product-area .nav-tabs li a {
									border: none;
								}

								.single-product .product-img .product-action a {
									margin-right: 8px;
								}
							</style>
							@foreach($category as $cat)
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#category{{$cat->id}}" role="tab">{{ $cat->category_name }}</a></li>
							@endforeach
						</ul>
						<!--/ End Tab Nav -->
					</div>
					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade show active" id="all" role="tabpanel">
							<ul class="row">
								@foreach($product as $value)
								<div class="col-xl-2 col-lg-4 col-md-4 col-4">
									<div class="single-product myproduct">
										<div class="product-img">
											<a href="{{ route('SingleProduct', $value->id) }}">
												<img class="default-img" src="{{ asset('/thumbnail/product/'.$value->product_thumbnail) }}" alt="{{ $value->product_name }}">
												@foreach(App\ProductImage::where('product_id', $value->id)->get() as $img)
												<img class="hover-img" src="{{ asset('/thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $value->product_name }}">
												@endforeach
											</a>
											<div class="button-head">
												<div class="product-action">
													<a data-toggle="modal" data-target="#exampleModal{{$value->id}}" title="Quick View"><i class=" ti-eye"></i><span>Quick Shop</span></a>
													<a title="Wishlist" class="sm" href="{{ route('AddWishlist', $value->id) }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
													<a title="Compare" class="sm" href="{{ route('AddToCompare', $value->id) }}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
												</div>
												<div class="product-action-2">
													<a title="Add to cart" href="{{ route('SingleCart', $value->id) }}">Add to cart</a>
												</div>
											</div>
										</div>
										<div class="product-content">
											<h3><a href="{{ route('SingleProduct', $value->id) }}">{{ $value->product_name }}</a></h3>
											<div class="product-price">
												@if($value->discount_price == NULL)
												<span>৳ {{ $value->product_price }}</span>
												@else
												<span>৳ {{ $value->discount_price }}</span>
												@endif
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</ul>
						</div>

						<!-- Start Single Tab -->
						@foreach($category as $cat)
						<div class="tab-pane fade show" id="category{{$cat->id}}" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									@foreach(App\Product::with('category')->where('category_id', $cat->id)->get() as $pro)
									<div class="col-xl-2 col-lg-4 col-md-4 col-4">
										<div class="single-product">
											<div class="product-img">
												<a href="{{ route('SingleProduct', $pro->id) }}">
													<img class="default-img" src="{{ asset('/thumbnail/product/'.$pro->product_thumbnail) }}" alt="{{ $pro->product_name }}">
													@foreach(App\ProductImage::where('product_id', $pro->id)->get() as $img)
													<img class="hover-img" src="{{ asset('/thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $pro->product_name }}">
													@endforeach
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal{{$pro->id}}" title="Quick View"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="{{ route('AddWishlist', $pro->id) }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="{{ route('AddToCompare', $pro->id) }}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="{{ route('SingleCart', $pro->id) }}">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="{{ route('SingleProduct', $pro->id) }}">{{ $pro->product_name }}</a></h3>
												<div class="product-price">
													@if($pro->discount_price == NULL)
													<span>৳ {{ $pro->product_price }}</span>
													@else
													<span>৳ {{ $pro->discount_price }}</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						@endforeach
						<!--/ End Single Tab -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Product Area -->

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>On sale</h1>
						</div>
					</div>
				</div>
				@forelse(App\Product::latest()->take(3)->get() as $sale)
				@if($sale->discount_price == !NULL)
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{ asset('thumbnail/product/'.$sale->product_thumbnail) }}" alt="{{ $sale->product_name }}">
								<a href="{{ route('SingleCart', $sale->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h4 class="title"><a href="{{ route('SingleProduct', $sale->id) }}">{{ $sale->product_name }}</a></h4>
								<p class="price with-discount">৳ {{ $sale->discount_price }}</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				@endif
				@empty
				<td>No Products On Sale</td>
				@endforelse
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Best Seller</h1>
						</div>
					</div>
				</div>
				@forelse(App\Billings::latest()->take(3)->get() as $item)
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{asset('thumbnail/product/'.$item->product->product_thumbnail)}}" alt="#">
								<a href="{{ route('SingleCart', $item->product->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="{{route('SingleProduct', $item->product->id)}}">{{$item->product->product_name}}</a></h5>
								@if($item->product->discount_price == NULL)
								<p class="price with-discount">৳ {{$item->product->product_price}}</p>
								@else
								<p class="price with-discount">৳ {{$item->product->discount_price}}</p>
								@endif
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				@empty
				<h5 class="text-center" colspan="50">No Products Available</h5>
				@endforelse
			</div>

			<!--div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Top viewed</h1>
						</div>
					</div>
				</div>
				@forelse(App\Product::orderBy('id', 'desc')->take(3)->get() as $item)
				
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{asset('thumbnail/product/'.$item->product_thumbnail)}}" alt="#">
								<a href="{{ route('SingleCart', $item->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="{{route('SingleProduct', $item->id)}}">{{$item->product_name}}</a></h5>
								@if($item->discount_price == NULL)
								<p class="price with-discount">৳ {{$item->product_price}}</p>
								@else
								<p class="price with-discount">৳ {{$item->discount_price}}</p>
								@endif
							</div>
						</div>
					</div>
				</div>
				
				@empty
				<h5 class="text-center" colspan="50">No Products Available</h5>
				@endforelse
			</div-->

		</div>
	</div>
</section>
<!-- End Shop Home List  -->


<!-- Start Shop Blog  -->
<!--section class="shop-blog section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>From Our Blog</h2>
					</div>
				</div>
			</div>
			<style>
				.mymg {
					height: 230px !important;
				}
			</style>
			<div class="row">
				@forelse(App\Blog::latest()->take(3)->get() as $blogs)
				<div class="col-lg-4 col-md-6 col-12">
					<!- Start Single Blog  -->
<!--div class="shop-single-blog">
						<img src="{{ asset('thumbnail/category/'.$blogs->image) }}" class="mymg" alt="{{$blogs->title ?? '' }}">
						<div class="content">
							<p class="date">{{$blogs->created_at}}</p>
							<a href="{{route('SingleBlog', $blogs->id)}}" class="title">{{$blogs->title}}</a>
							<a href="{{route('SingleBlog', $blogs->id)}}" class="more-btn">Continue Reading</a>
						</div>
					</div>
					<!- End Single Blog  >
				</div>
				@empty
				<h5 class="text-center">No Blogs yet</h5>
				@endforelse
			</div>
		</div>
	</section>

	@endsection 
<! End Shop Blog  -->


@section('top_nav')
<!-- Header Inner -->
<div class="header-inner">
	<div class="container">
		<div class="cat-nav-head">
			<div class="row">
				<div class="col-lg-3">
					<div class="all-category">
						<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
						<ul class="main-category">
							@foreach(App\Category::with('subcategory')->get() as $cat)
							@if($cat->subcategory->count() > 0)
							<li><a href="{{route('SingleShop', $cat->id)}}">{{ $cat->category_name }}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
								<ul class="sub-category">
									@foreach($cat->subcategory as $subcat)
									<li><a href="{{route('SingleSubShop', $subcat->id)}}">{{ $subcat->subcategory_name }}</a></li>
									@endforeach
								</ul>
							</li>
							@else
							<li><a href="{{route('SingleShop', $cat->id)}}">{{ $cat->category_name }} </a></li>
							@endif
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<div class="menu-area">
						<!-- Main Menu -->
						<nav class="navbar navbar-expand-lg">
							<div class="navbar-collapse">
								<div class="nav-inner">
									<ul class="nav main-menu menu navbar-nav">
										<li class="active"><a href="{{ url('/') }}">Home</a></li>
										<li><a href="#">Pages<i class="ti-angle-down"></i></a>
											<ul class="dropdown">
												<li><a href="{{ route('Shop') }}">Shop Grid</a></li>
												<li><a href="{{ route('Cart') }}">Cart</a></li>
												<li><a href="{{ route('Wishlist') }}">Wishlist</a></li>
											</ul>
										</li>
										<li><a href="{{ route('Shop') }}">Shop</a><span class="new">New</span></li>
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

@section('modal')
<!-- Modal -->
@foreach($product as $item)
<div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<!-- Product Slider -->
						<div class="product-gallery">
							<div class="quickview-slider-active">
								<div class="single-slider">
									@foreach(App\ProductImage::where('product_id', $item->id)->latest()->take(1)->get() as $img)
									<img src="{{ asset('thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $item->product_name }}">
									@endforeach
								</div>
								<div class="single-slider">
									<img src="{{ asset('thumbnail/product/'.$item->product_thumbnail) }}" alt="{{ $item->product_name }}">
								</div>
							</div>
						</div>
						<!-- End Product slider -->
					</div>
					<style>
						.rating {
							display: inline-flex;
						}

						.rating li {
							padding: 0px 5px;
						}

						.quickview-content .quickview-ratting-review .quickview-ratting-wrap .quickview-ratting i {
							color: #f49e00;
						}
					</style>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="quickview-content">
							<h2>{{ $item->product_name }}</h2>
							<div class="quickview-ratting-review">
								<div class="quickview-ratting-wrap">
									<div class="quickview-ratting">
										<ul class="rating">
											@php
											$sum = App\Review::where('product_id', $item->id)->sum('rating');
											@endphp

											@for ($i = 0; $i < 5; $i++) @if ($i < $sum) <li><i class="fa fa-star"></i></li>
												@else
												<li><i class="fa fa-star-o"></i></li>
												@endif
												@endfor
										</ul>
									</div>
									<a href="{{route('SingleProduct', $item->id)}}"> ({{App\Review::where('product_id', $item->id)->count()}} customer review)</a>
								</div>
								<div class="quickview-stock">
									@if($item->product_quantity == 0)
									<span><i class="fa fa-times"></i> Out of stock</span>
									@else
									<span><i class="fa fa-check-circle-o"></i> In stock</span>
									@endif
								</div>
							</div>
							@if($item->discount_price == NULL)
							<h3>৳ {{ $item->product_price }}</h3>
							@else
							<h3>৳ {{ $item->discount_price }}</h3>
							@endif
							<div class="quickview-peragraph">
								<p>{{ $item->product_summary ?? "" }}</p>
							</div>
							<div class="size">
								<div class="row">
									<div class="col-lg-6 col-12">
										<h5 class="title">Size</h5>
										<select>
											<option selected="selected">{{ $item->product_size ?? "" }}</option>
										</select>
									</div>
									<div class="col-lg-6 col-12">
										<h5 class="title">Color</h5>
										<select>
											<option selected="selected">{{ $item->product_color ?? "" }}</option>
										</select>
									</div>
								</div>
							</div>

							<!-- Product Buy -->
							<div class="product-buy">
								<div class="quantity">
									<h6>Quantity :</h6>
									<!-- Input Order -->
									<style>
										.mybtn {
											height: 45px;
											width: auto;
											padding: 0 42px;
											line-height: 45px;
											text-align: center;
											text-transform: capitalize;
											margin-right: 5px;
											border-radius: 0px;
											background: #333;
											color: #fff;
											display: inline-block;
											font-weight: 500;
										}

										.mybtn:hover {
											background: #f7941d;
										}

										.shop.single .add-to-cart .btn.min {
											margin-bottom: 5px;
										}
									</style>
									<form action="{{route('MultipleCart')}}" method="post">
										@csrf
										<input type="hidden" name="product_id" value="{{ $item->id }}">
										<div class="input-group">
											<div class="button minus">
												<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quantity">
													<i class="ti-minus"></i>
												</button>
											</div>
											<input type="text" name="quantity" class="input-number" data-min="1" data-max="1000" value="1">
											<div class="button plus">
												<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quantity">
													<i class="ti-plus"></i>
												</button>
											</div>
										</div>
										<!--/ End Input Order -->
								</div>
								<div class="add-to-cart">
									<button type="submit" class="mybtn">Add to cart</button>
									<a href="{{ route('AddWishlist', $item->id) }}" class="btn min"><i class="ti-heart"></i></a>
									<a href="{{ route('AddToCompare', $item->id) }}" class="btn min"><i class="fa fa-compress"></i></a>
								</div>
								</form>
								<br><br>
								<p class="cat">Category :<a href="{{route('SingleShop', $item->category_id)}}"> {{$item->category->category_name ?? ""}}</a></p>
								<p class="availability">Availability : {{$item->product_quantity ?? ""}} Products In Stock</p>
							</div>
							<!--/ End Product Buy -->


							<div class="default-social">
								<h4 class="share-now">Share:</h4>

								<ul>
									<li><a target="_blank" data-href="//developers.facebook.com/docs/plugins/" class="facebook fb-share-button" href="//www.facebook.com/sharer/sharer.php?u={{route('SingleProduct',$item->id)}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook"></i></a></li>
									<li><a target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?text={{route('SingleProduct',$item->id)}}"><i class="fa fa-twitter"></i></a></li>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach
<!-- Modal end -->

@endsection
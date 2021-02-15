@extends('frontend.master')
@section('title')
	{{$product->slug}} - DeshBuy
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
								<li class="active"><a href="{{ route('SingleProduct', $product->id) }}">Shop Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop Single -->
		<section class="shop single section">
			<div class="container">
				<div class="row"> 
					<div class="col-12">
						<div class="row">
							<div class="col-lg-6 col-12">
								<!-- Product Slider -->
								<div class="product-gallery">
									<!-- Images slider -->
									<div class="flexslider-thumbnails">
										<ul class="slides">
											<li data-thumb="{{ asset('thumbnail/product/'.$product->product_thumbnail) }}" rel="adjustX:10, adjustY:">
												<img src="{{ asset('thumbnail/product/'.$product->product_thumbnail) }}" alt="#">
											</li>
											@foreach(App\ProductImage::where('product_id', $product->id)->take(3)->get() as $img)
											<li data-thumb="{{ asset('thumbnail/product/gallery/'.$img->product_image) }}">
												<img src="{{ asset('thumbnail/product/gallery/'.$img->product_image) }}" alt="#">
											</li>
											@endforeach	
										</ul>
									</div>
									<!-- End Images slider -->
								</div>
								<!-- End Product slider -->
							</div>
							<div class="col-lg-6 col-12">
								<div class="product-des">
									<!-- Description -->
									<div class="short">
										<h4>{{ $product->product_name }}</h4>
										<div class="rating-main">
											<ul class="rating">
											@for ($i = 0; $i < 5; $i++)
												@if ($i < $sum)
												<li><i class="fa fa-star"></i></li>
												@else
												<li><i class="fa fa-star-o"></i></li>
												@endif
											@endfor
											</ul>
											<a href="" class="total-review">({{$count}}) Review</a>
										</div>
										@if($product->discount_price == NULL)
										<p class="price"><span class="discount">৳ {{ $product->product_price }}</span>
										@else
										<p class="price"><span class="discount">৳ {{ $product->discount_price }}</span>
										<s> {{ $product->product_price }}</s></p>
										@endif
										<p class="description">{!!$product->product_summary!!}</p>
									</div>
									<!--/ End Description -->
									<!-- Color -->
									<div class="color">
										<h4>Available Options </h4><br>
										<h5>Color</h5>
										<ul>
											<li>{{$product->product_color ?? ""}}</li>
										</ul>
									</div>
									<!--/ End Color -->
									<!-- Size -->
									<div class="size">
										<h5>Size</h5>
										<ul>
											<li><p class="one">{{$product->product_size ?? ""}}</p></li>
										</ul>
									</div>
									<!--/ End Size -->
									<!-- Product Buy -->
									<div class="product-buy">
										<div class="quantity">
											<h6>Quantity :</h6>
											<!-- Input Order -->
											<style>
											.mybtn{
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
											.shop.single .add-to-cart .btn.min{
												margin-bottom: 5px;
											}
											</style>
										<form action="{{route('MultipleCart')}}" method="post">
										@csrf
										<input type="hidden" name="product_id" value="{{ $product->id }}">
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quantity">
														<i class="ti-minus"></i>
													</button>
												</div>
												<input type="text" name="quantity" class="input-number"  data-min="1" data-max="1000" value="1">
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
											<a href="{{ route('AddWishlist', $product->id) }}" class="btn min"><i class="ti-heart"></i></a>
											<a href="{{ route('AddToCompare', $product->id) }}" class="btn min"><i class="fa fa-compress"></i></a>
										</div>
										</form>
										<p class="cat">Category :<a href="#">{{$product->category->category_name ?? ""}}</a></p>
										<p class="availability">Availability : {{$product->product_quantity ?? ""}} Products In Stock</p>
									</div>
									<!--/ End Product Buy -->
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="product-info">
									<div class="nav-main">
										<!-- Tab Nav -->
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
											<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
										</ul>
										<!--/ End Tab Nav -->
									</div>
									<div class="tab-content" id="myTabContent">
										<!-- Description Tab -->
										<div class="tab-pane fade show active" id="description" role="tabpanel">
											<div class="tab-single">
												<div class="row">
													<div class="col-12">
														<div class="single-des">
															<p>{{$product->product_description}}</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--/ End Description Tab -->
										<!-- Reviews Tab -->
										<div class="tab-pane fade" id="reviews" role="tabpanel">
											<div class="tab-single review-panel">
												<div class="row">
													<div class="col-12">
														<div class="ratting-main">
															<div class="avg-ratting">
																<h4>@if($count > 0) {{ $sum / $count }} @else 0 @endif<span>(Overall)</span></h4>
																<span>Based on {{App\Review::where('product_id', $product->id)->count()}} Comments</span>
															</div>
															@forelse(App\Review::where('product_id', $product->id)->orderBy('id', 'desc')->get() as $review)
															<!-- Single Rating -->
															<div class="single-rating">
																
																<div class="rating-des">
																	<h6>{{ $review->name }}</h6>
																	<div class="ratings">
																		<ul class="rating">

																		@for ($i = 0; $i < 5; $i++)
																			@if ($i < $review->rating)
																			<li><i class="fa fa-star"></i></li>
																			@else
																			<li><i class="fa fa-star-o"></i></li>
																			@endif
																		@endfor

																		</ul>
																		<div class="rate-count">(<span>{{ $review->rating }}</span>)</div>
																	</div>
																	<p>{{ $review->message }}</p>
																</div>
															</div>
															<!--/ End Single Rating -->
															@empty
															<h5>No Reviews Yet.</h5>
															@endforelse
														</div>
														<!-- Review -->
														@if(Auth::user())
														<form class="form" method="post" action="{{ url('post-review') }}">
														@csrf
														<input type="hidden" name="product_id" value="{{ $product->id }}">
														<div class="comment-review">
															<div class="add-review">
																<h5>Add A Review</h5>
																<p>Your email address will not be published. Required fields are marked</p>
															</div>
															@if(session('exists'))
															<div class="alert alert-danger">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Sorry!</strong> {{session('exists')}}.
															</div>
															@endif
															<h4>Rate this Product</h4>
															<style>
																.ratting-wrap {
																	margin-bottom: 40px;
																}
																.ratting-wrap table tr th {
																	height: 35px;
																	text-align: center;
																	text-transform: uppercase;
																	width: 180px;
																	font-weight: 500;
																	border: 1px solid #d7d7d7;
																}
																.ratting-wrap table tr td {
																	border: 1px solid #d7d7d7;
																	text-align: center;
																	height: 40px;
																}
															</style>
															<div class="review-inner">
																<div class="ratings">
																<div class="ratting-wrap">
																	<table>
																		<thead>
																			<tr>
																				<th>task</th>
																				<th>1 Star</th>
																				<th>2 Star</th>
																				<th>3 Star</th>
																				<th>4 Star</th>
																				<th>5 Star</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>How Many Stars?</td>
																				<td>
																					<input type="radio" value="1" name="rating">
																				</td>
																				<td>
																					<input type="radio" value="2" name="rating">
																				</td>
																				<td>
																					<input type="radio" value="3" name="rating">
																				</td>
																				<td>
																					<input type="radio" value="4" name="rating">
																				</td>
																				<td>
																					<input type="radio" value="5" name="rating">
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
																</div>
															</div>
														</div>
														<!--/ End Review -->
														<!-- Form -->
															<div class="row">
																<div class="col-lg-6 col-12">
																	<div class="form-group">
																		<label>Your Name<span>*</span></label>
																		<input type="text" name="name" required="required" placeholder="">
																	</div>
																</div>
																<div class="col-lg-6 col-12">
																	<div class="form-group">
																		<label>Your Email<span>*</span></label>
																		<input type="email" name="email" required="required" placeholder="">
																	</div>
																</div>
																<div class="col-lg-12 col-12">
																	<div class="form-group">
																		<label>Write a review<span>*</span></label>
																		<textarea name="message" rows="6" placeholder="" ></textarea>
																	</div>
																</div>
																<div class="col-lg-12 col-12">
																	<div class="form-group button5">	
																		<button type="submit" class="btn">Submit</button>
																	</div>
																</div>
															</div>
														</form>
														<!--/ End Form -->
														@else 
															<br>
															<h4>Please <a href="{{ route('login') }}" style="color:#f7941d;">Login</a>  to Review</h4>
														@endif
														
													</div>
												</div>
											</div>
										</div>
										<!--/ End Reviews Tab -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Shop Single -->
		
		<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        @foreach($related as $item)
						<div class="single-product relpro">
							<div class="product-img">
							<a href="{{ route('SingleProduct', $item->id)}}">
									<img class="default-img" src="{{ asset('thumbnail/product/'.$item->product_thumbnail) }}" alt="#">
									@foreach(App\ProductImage::where('product_id', $item->id)->get() as $img)
										<img class="hover-img" src="{{ asset('/thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $item->product_name }}">
									@endforeach
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" class="sm" data-target="#exampleModal{{$item->id}}" title="Quick View"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" class="sm" href="{{route('AddWishlist', $item->id)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" class="sm" href="{{route('AddToCompare', $item->id)}}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="{{route('SingleCart', $item->id)}}">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="{{ route('SingleProduct', $item->id)}}">{{ $item->product_name }}</a></h3>
								<div class="product-price">
								@if($item->discount_price == NULL)
								<span> ৳ {{ $item->product_price }}</span>
								@else
								<span> ৳ {{ $item->discount_price }}</span>
								@endif
								</div>
							</div>
                        </div>
                        @endforeach
						<!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
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

@section('modal')
	<!-- Modal -->
	@foreach($pro as $item)
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

										@for ($i = 0; $i < 5; $i++)
											@if ($i < $sum)
											<li><i class="fa fa-star"></i></li>
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
											.mybtn{
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
											.shop.single .add-to-cart .btn.min{
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
												<input type="text" name="quantity" class="input-number"  data-min="1" data-max="1000" value="1">
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
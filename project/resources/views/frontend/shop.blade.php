@extends('frontend.master')
@section('title')
	Shop - DeshBuy
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
								<li class="active"><a href="{{ route('Shop') }}">Shop Grid</a></li>
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
								<div class="single-widget category">
									<h3 class="title mytitle">Categories</h3>
									<ul class="categor-list catlist">
                                        @foreach($category as $cat)
										    <li><a href="{{ route('SingleShop', $cat->id) }}">{{ $cat->category_name }}</a></li>
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
									}
									.range .mybtn {
										padding: 10px 10px;
										border-radius: 0px;
										background: #f7941d;
										color: #fff;
									}
								</style>
								<form action="{{route('ProductSearch')}}" method="post">
								@csrf
									<div class="single-widget range shoprenge">
										<h3 class="title shoptitle">Shop by Price</h3>
										<input type="number" class="input shopinput" name="start" placeholder="Enter starting Price"><br><br>
										<input type="number" class="input shopinput" name="end" placeholder="Ending Price">
										<br><br>
										<input class="shopbtn mybtn" type="submit" value="Search Product">
									</div>
								</form>
									<!--/ End Shop By Price -->
								<!-- Single Widget -->
								<div class="single-widget recent-post category">
									<h3 class="title shoptitle">Recent post</h3>
									<!-- Single Post -->
									@foreach($recent as $item)
									<div class="single-post first shoppost">
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
					<div class="col-lg-9 col-md-8 col-12 shopproduct">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top sm">
									<div class="shop-shorter">
										<div class="single-shorter">
											<label>Show :</label>
											<select>
												<option selected="selected">09</option>
												<option>15</option>
												<option>25</option>
												<option>30</option>
											</select>
										</div>
										<div class="single-shorter">
											<label>Sort By :</label>
											<select>
												<option selected="selected">Name</option>
												<option>Price</option>
												<option>Size</option>
											</select>
										</div>
									</div>
									<ul class="view-mode">
										<li class="active"><a href="{{ route('Shop') }}"><i class="fa fa-th-large"></i></a></li>
										<li><a href="{{ route('ShopListView') }}"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
						@isset($search)
						<div class="row">
							@forelse($search as $item)
							<div class="col-lg-4 col-md-6 col-4 shopclass">
								<div class="single-product singlepro">
									<div class="product-img">
										<a href="{{ route('SingleProduct', $item->id) }}">
											<img class="default-img" src="{{ asset('thumbnail/product/'.$item->product_thumbnail) }}" alt="{{ $item->product_name }}">
											@foreach(App\ProductImage::where('product_id', $item->id)->get() as $img)
												<img class="hover-img" src="{{ asset('/thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $item->product_name }}">
											@endforeach
										</a>
										<div class="button-head btnhead">
											<div class="product-action proaction">
												<a data-toggle="modal" data-target="#exampleModal{{$item->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
												<a title="Wishlist" class="sm" href="{{ route('AddWishlist', $item->id) }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
												<a title="Compare" class="sm" href="{{ route('AddToCompare', $item->id) }}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
											</div>
											<div class="product-action-2 proaction2">
												<a title="Add to cart" class="mycart" href="{{ route('SingleCart', $item->id) }}">Add to cart</a>
											</div>
										</div>
									</div>
									<div class="product-content mycontent">
										<h3><a href="{{ route('SingleProduct', $item->id) }}">{{ $item->product_name }}</a></h3>
										<div class="product-price contentprice">
										@if($item->discount_price == NULL)
										<span>৳{{ $item->product_price }}</span>
										@else 
										<span>৳{{ $item->discount_price }}</span>
										@endif
											
										</div>
									</div>
								</div>
							</div>
							@empty
							<h4 style="padding:35px 15px;">No Products Available in this Price</h4>
							@endforelse
						</div>
						@else
						<div class="row">
							@foreach($product as $item)
							<div class="col-lg-3 col-md-6 col-4 shopclass">
								<div class="single-product singlepro">
									<div class="product-img">
										<a href="{{ route('SingleProduct', $item->id) }}">
											<img class="default-img" src="{{ asset('thumbnail/product/'.$item->product_thumbnail) }}" alt="{{ $item->product_name }}">
											@foreach(App\ProductImage::where('product_id', $item->id)->get() as $img)
												<img class="hover-img" src="{{ asset('/thumbnail/product/gallery/'.$img->product_image) }}" alt="{{ $item->product_name }}">
											@endforeach
										</a>
										<div class="button-head btnhead">
											<div class="product-action proaction">
												<a data-toggle="modal" data-target="#exampleModal{{$item->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
												<a title="Wishlist" class="sm" href="{{ route('AddWishlist', $item->id) }}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
												<a title="Compare" class="sm"  href="{{ route('AddToCompare', $item->id) }}"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
											</div>
											<div class="product-action-2 proaction2">
												<a title="Add to cart" class="mycart" href="{{ route('SingleCart', $item->id) }}">Add to cart</a>
											</div>
										</div>
									</div>
									<div class="product-content mycontent">
										<h3><a href="{{ route('SingleProduct', $item->id) }}">{{ $item->product_name }}</a></h3>
										<div class="product-price contentprice">
										@if($item->discount_price == NULL)
										<span>৳{{ $item->product_price }}</span>
										@else 
										<span>৳{{ $item->discount_price }}</span>
										@endif
											
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						@endisset
						

					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->
		
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
												.shop-sidebar .single-post .reviews li i {
														color: #f7941d;
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
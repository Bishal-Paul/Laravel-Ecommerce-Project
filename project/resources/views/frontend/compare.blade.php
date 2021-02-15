@extends('frontend.master')
@section('title')
	Compare - DeshBuy
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
                            <li class="active"><a href="{{ route('Compare') }}">Compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Breadcrumbs -->
    <style>
        .col1-layout {
            padding: 50px 0px;
        }
    </style>

    <section class="main-container col1-layout">
        <div class="main container">
        <div class="col-main">
            <div class="compare-list">
            <div class="page-title">
                <h5>Compare Products</h5> <br>
            </div>
            <div class="table-responsive">
    
                <table class="table table-bordered table-compare">
                <tbody><tr>
                    <td class="compare-label">Product Image</td>
                    @foreach($compare as $item)
                        <td class="text-center"><a href="{{route('SingleProduct', $item->product->id)}}"><img src="{{asset('thumbnail/product/'.$item->product->product_thumbnail)}}" alt="Product" width="130"></a></td>
                    @endforeach
                </tr>
                <tr>
                    <td class="compare-label">Product Name</td>
                    @foreach($compare as $item)
                        <td><a href="{{route('SingleProduct', $item->product->id)}}">{{$item->product->product_name}}</a></td>
                    @endforeach
                </tr>
               
                <tr>
                    <td class="compare-label">Price</td>
                    @foreach($compare as $item)
                        @if($item->discount_price == NULL)
                        <td class="price">৳ {{$item->product->product_price}}</td>
                        @else
                        <td class="price">৳ {{$item->product->discount_price}}</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="compare-label">Description</td>
                    @foreach($compare as $item)
                        <td> {{$item->product->product_summary}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="compare-label">Availability</td>
                    @foreach($compare as $item)
                        @if($item->product->product_quantity < 0)
                            <td class="outofstock">Out of stock</td>
                        @else
                            <td class="instock">Instock ({{$item->product->product_quantity}} items)</td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td class="compare-label">Size</td>
                    @foreach($compare as $item)
                        <td>{{$item->product->product_size ?? ""}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="compare-label">Color</td>
                    @foreach($compare as $item)
                        <td>{{$item->product->product_color ?? ""}}</td>
                    @endforeach
                </tr>
                <style>
                    .table-compare .add-cart{
                        border-radius: 50%;
                        padding: 5px 9px;
                    }
                    .myfa {
                        background: #000;
                        border-radius: 50%;
                        padding: 10px 10px;
                        background-color: #333e48;
                        color: #fff;
                    }
                    .mybutton {
                        background: #000;
                        padding: 7px 12px;
                        color: #fff !important;
                        border-radius: 50%;
                    }
                </style>
                <tr>
                    <td class="compare-label">Action</td>
                    @foreach($compare as $item)
                        <td class="action"><a href="{{route('SingleCart', $item->product->id)}}" class="add-cart button button-sm"><i class="fa fa-shopping-cart"></i></a></button>
                        <a href="{{route('AddWishlist', $item->product->id)}}" class="button button-sm"><i class="myfa fa fa-heart"></i></a>
                        <a href="{{ route('DeleteCompare', $item->id) }}" class="mybutton button-sm"><i class="fa fa-close"></i></a></td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        
            </div>
            </div>
        </div>
        </div>
  </section>
@endsection
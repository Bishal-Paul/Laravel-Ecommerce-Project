@extends('frontend.master')
@section('title')
	Checkout - DeshBuy
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
								<li class="active"><a href="{{ route('Checkout') }}">Checkout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Checkout -->
		<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12">
						<div class="checkout-form">
							<h2>Make Your Checkout Here</h2>
							<p>Please register in order to checkout more quickly</p>
							<!-- Form -->
							<form class="form" method="post" action="{{route('FinalCheckout')}}">
								@csrf
                                <div class="row">
									<div class="col-lg-6 col-md-12 col-12">
										<div class="form-group">
											<label>Full Name<span>*</span></label>
											<input type="text" name="name" class="@error('name') is-invalid @enderror">
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number<span>*</span></label>
											<input type="number" name="phone" class="@error('number') is-invalid @enderror">
										</div>
									</div>
									<div class="col-lg-12 col-md-6 col-12">
										<div class="form-group">
											<label>Email Address<span>*</span></label>
											<input type="email" name="email" class="@error('email') is-invalid @enderror">
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Division<span>*</span></label>
											<select name="division" id="division_id" class="@error('division') is-invalid @enderror">
												<option value="">Select One</option>
                                                @foreach($division as $div)
                                                    <option value="{{ $div->id }}">{{ $div->bn_name }}</option>
                                                @endforeach
											</select>
										</div>
                                    </div>
                                    <style>
                                        #district{
                                            display: block !important;
                                            width: 100%;
                                            height: 45px;
                                            line-height: 50px;
                                            margin-bottom: 25px;
                                            background: #F6F7FB;
                                            border-radius: 0px;
                                            border: none;
                                        }
                                        .district {
                                            display: none !important;
                                        }

                                        #upazila{
                                            display: block !important;
                                            width: 100%;
                                            height: 45px;
                                            line-height: 50px;
                                            margin-bottom: 25px;
                                            background: #F6F7FB;
                                            border-radius: 0px;
                                            border: none;
                                        }
                                        .upazila {
                                            display: none !important;
                                        }

                                        #union{
                                            display: block !important;
                                            width: 100%;
                                            height: 45px;
                                            line-height: 50px;
                                            margin-bottom: 25px;
                                            background: #F6F7FB;
                                            border-radius: 0px;
                                            border: none;
                                        }
                                        .union {
                                            display: none !important;
                                        }
                                    </style>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>District<span>*</span></label>
											<select name="district" id="district"  class="district @error('district') is-invalid @enderror">
                                            
											</select>
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Upazila<span>*</span></label>
											<select name="upazila" id="upazila"  class="upazila @error('upazila') is-invalid @enderror">
												
											</select>
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Union<span>*</span></label>
											<select name="union" id="union"  class="union @error('union') is-invalid @enderror">
												
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address <span>*</span></label>
											<input type="text" name="address" class="@error('address') is-invalid @enderror">
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Postal Code<span>*</span></label>
											<input type="text" name="post_code" class="@error('post_code') is-invalid @enderror">
										</div>
                                    </div>
                                    <style>
                                    .form-control {
                                        height: 150px;
                                        border-radius: 0px !important;
                                    }
                                    </style>
                                    <div class="col-lg-12 col-md-12 col-12">
										<div class="form-group">
											<label>Message</label>
                                            <textarea name="message" class="form-control @error('message') is-invalid @enderror"></textarea>
										</div>
                                    </div>
                                    
								</div>
							
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>CART  TOTALS</h2>
								<div class="content">
									<ul>
										<li>Sub Total<span>৳ {{ $subtotal ?? ""}}</span></li>
										<li>(+) Discount<span>৳ {{$after_discount ?? 0}}</span></li>
										<li class="last">Total<span>৳ {{ $total }}</span></li>
									</ul>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Order Widget -->
                            <style>
                            .mycontent {
                                display: inline-grid;
                                padding: 20px 0px 0px 30px;
                            }
                            </style>
							<div class="single-widget">
								<h2>Payments</h2>
								<div class="content mycontent">
									
                                    <label ><input name="payment" value="card" type="radio"> Check Payments</label>
                                    <label ><input name="payment" value="cash" type="radio"> Cash On Delivery</label>
                                    @if(session('payment'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{session('payment')}}.
                                    </div>
                                    @endif
								</div>
							</div>
                            
							<!--/ End Order Widget -->
							
							<!-- Button Widget -->
                            <style>
                            .shop.checkout .single-widget.get-button .btn {
                                background: #000;
                            }
                            .shop.checkout .single-widget.get-button .btn:hover {
                                color: #fff;
                                background: #F7941D;
                            }
                            </style>
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<input type="submit" class="btn" value="Proceed to Checkout">
									</div>
								</div>
							</div>
                        </form>
                        <!--/ End Form -->
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->
		
@endsection

@section('footer_js')
<script>
    $('#division_id').change(function(){
        var division_id = $(this).val();

        if (division_id) {
            $.ajax({
                type:"GET",
                url:"{{ url('api/get-district-list')}}/"+division_id,
                success:function(res){
                    if(res){
                        $('#district').empty();
                        $('#district').append('<option> Select One </option>');
                        $.each(res, function(key,value){
                            $('#district').append('<option value="'+value.id+'">'+value.bn_name+'</option>');
                        });
                    }
                    else{
                        $('#district').empty(); 
                    }
                }
            });
        }
        else{
                $('#district').empty();
        }
    });

    $('#district').change(function(){
        var district = $(this).val();

        if (district) {
            $.ajax({
                type:"GET",
                url:"{{ url('api/get-upazila-list')}}/"+district,
                success:function(res){
                    if(res){
                        $('#upazila').empty();
                        $('#upazila').append('<option> Select One </option>');
                        $.each(res, function(key,value){
                            $('#upazila').append('<option value="'+value.id+'">'+value.bn_name+'</option>');
                        });
                    }
                    else{
                        $('#upazila').empty(); 
                    }
                }
            });
        }
        else{
                $('#upazila').empty();
        }
    });

    $('#upazila').change(function(){
        var upazila = $(this).val();

        if (upazila) {
            $.ajax({
                type:"GET",
                url:"{{ url('api/get-union-list')}}/"+upazila,
                success:function(res){
                    if(res){
                        $('#union').empty();
                        $('#union').append('<option> Select One </option>');
                        $.each(res, function(key,value){
                            $('#union').append('<option value="'+value.id+'">'+value.bn_name+'</option>');
                        });
                    }
                    else{
                        $('#union').empty(); 
                    }
                }
            });
        }
        else{
                $('#union').empty();
        }
    });
</script>
@endsection
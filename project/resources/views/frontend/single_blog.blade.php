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
                                                <li><a href="#">Service</a></li>
                                                <li><a href="#">Pages<i class="ti-angle-down"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="{{ route('Shop') }}">Shop Grid</a></li>
                                                        <li><a href="{{ route('Cart') }}">Cart</a></li>
                                                        <li><a href="{{ route('Wishlist') }}">Wishlist</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ route('Shop') }}">Shop</a><span class="new">New</span></li>									
                                                <li><a href="{{route('Blog')}}">Blog</a></li>
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
								<li><a href="{{url('/')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active">Blog Single Sidebar</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
			
		<!-- Start Blog Single -->
		<section class="blog-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="blog-single-main">
							<div class="row">
								<div class="col-12">
									<div class="image">
										<img src="{{asset('thumbnail/category/'.$blog->image)}}" alt="{{$blog->title}}">
									</div>
									<div class="blog-detail">
										<h2 class="blog-title">{{$blog->title}}</h2>
										<div class="blog-meta">
											<span class="author"><a href=""><i class="fa fa-user"></i>By {{ $blog->user->name ?? "" }}</a><a href=""><i class="fa fa-calendar"></i>{{ $blog->created_at }}</a><a href=""><i class="fa fa-comments"></i>Comment ({{$comment->count()}})</a></span>
										</div>
										<div class="content">
											{!! $blog->description !!}
										</div>
									</div>
									
								</div>
								<div class="col-12">
									<div class="comments">
										<h3 class="comment-title">Comments ({{$comment->count()}})</h3>
									@forelse($comment as $item)
										<!-- Single Comment -->
										<div class="single-comment">
											
											<div class="content">
												<h4>{{$item->name}}<span>At {{$item->created_at}}</span></h4>
												<p>{{$item->message}}</p>
												
											</div>
										</div>
										<!-- End Single Comment -->
									@empty
									<h4 class="text-center">No Comments yet</h4>
									@endforelse
									</div>									
								</div>											
								<div class="col-12">			
									<div class="reply">
										<div class="reply-head">
											<h2 class="reply-title">Leave a Comment</h2>
											<!-- Comment Form -->
											<form method="post" class="form" action="{{route('BlogComment')}}">
											@csrf
												<input type="hidden" name="blog_id" value="{{$blog->id}}">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Your Name<span>*</span></label>
															<input type="text" name="name" placeholder="" required="required">
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Your Email<span>*</span></label>
															<input type="email" name="email" placeholder="" required="required">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label>Your Message<span>*</span></label>
															<textarea name="message" placeholder=""></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group button">
															<button type="submit" class="btn">Post comment</button>
														</div>
													</div>
												</div>
											</form>
											<!-- End Comment Form -->
										</div>
									</div>			
								</div>			
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="main-sidebar">
							<!-- Single Widget -->
							<div class="single-widget search">
								<form action="{{route('SearchBlog')}}" method="post" class="form">
								@csrf
									<input type="search" name="search_blog" placeholder="Search Here...">
									<button class="button" type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget category">
								<h3 class="title">Blog Categories</h3>
								<ul class="categor-list">
                                    @foreach($category as $cat)
									    <li><a href="{{route('SingleCat', $cat->id)}}">{{$cat->name}}</a></li>
									@endforeach
								</ul>
							</div>
							<!--/ End Single Widget -->
							 <!-- Single Widget -->
							 <div class="single-widget recent-post">
                            <h3 class="title">Recent post</h3>
                            @foreach($recent as $value)
                            <!-- Single Post -->
                            <div class="single-post">
                                <div class="image">
                                    <img src="{{asset('thumbnail/category/'.$value->image)}}" alt="{{$value->title}}">
                                </div>
                                <div class="content">
                                    <h5><a href="{{route('SingleBlog', $value->id)}}">{{$value->title}}</a></h5>
                                    <ul class="comment">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$value->created_at}}</li>
                                        <li><i class="fa fa-commenting-o" aria-hidden="true"></i>{{App\BlogComment::where('blog_id', $value->id)->count()}}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Post -->
                            @endforeach
                        </div>
                        <!--/ End Single Widget -->
							<!-- Single Widget -->
							<!--/ End Single Widget -->
							
						<style>
							.mybtn {
								width: 100%;
							}
                        </style>
                        <!-- Single Widget -->
                        <div class="single-widget newsletter">
                            <h3 class="title">Newslatter</h3>
                            <div class="letter-inner">
                                <h4>Subscribe &amp; get news <br> latest updates.</h4>
                                <form action="{{route('Newsletter')}}" method="post" class="form-inner">
                                    @csrf
                                    <input name="email" placeholder="Your email address" required="" type="email"><br><br>
                                    <button type="submit" class="mybtn btn">Subscribe</button>
                                </form>
                            </div>
                        </div>
                        <!--/ End Single Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Blog Single -->
@endsection
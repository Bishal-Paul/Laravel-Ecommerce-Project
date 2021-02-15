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
                                                <li><a href="">Pages<i class="ti-angle-down"></i></a>
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
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active">Blogs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Breadcrumbs -->
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 col-12">
                <div class="row">
                    @foreach($blogcat as $item)
                        <div class="col-lg-6 col-md-6 col-12">
                            <!-- Start Single Blog  -->
                            <style>
                                .myimg {
                                    height:230px !important;
                                }
                            </style>
                            <div class="shop-single-blog">
                                <img src="{{asset('thumbnail/category/'.$item->image)}}" class="myimg"  alt="{{$item->title}}">
                                <div class="content">
                                    <p class="date">{{$item->created_at}}</p>
                                    <a href="{{route('SingleBlog', $item->id)}}" class="title">{{$item->title}}</a>
                                    <a href="{{route('SingleBlog', $item->id)}}" class="more-btn">Continue Reading</a>
                                </div>
                            </div>
                            <!-- End Single Blog  -->
                        </div>
                    @endforeach
                    
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
@endsection
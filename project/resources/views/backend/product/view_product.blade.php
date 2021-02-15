@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Products</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Regular Price</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col"> Size</th>
                                <th scope="col"> Color</th>
                                <th scope="col"> Category</th>
                                <th scope="col"> Thumbnail</th>
                                <th scope="col">Summary</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $key => $item)
                                <tr>
                                    <th scope="row">{{ $product->firstItem() + $key }}</th>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->discount_price }}</td>
                                    <td>{{ $item->product_size }}</td>
                                    <td>{{ $item->product_color }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td><img src="{{ asset('thumbnail/product/'.$item->product_thumbnail ?? 'N/A')  }}" width="90px" height="90px"></td>
                                    <td>{{ $item->product_summary }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('edit-product')}}/{{$item->slug}} ">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{url('delete-product')}}/{{$item->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $product->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Coupon</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Coupon Name</th>
                                <th scope="col">Coupon Code</th>
                                <th scope="col">Coupon Discount</th>
                                <th scope="col">Coupon Validity</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupon as $key => $item)
                                <tr>
                                    <th scope="row">{{ $coupon->firstItem() + $key }}</th>
                                    <td>{{ $item->coupon_name }}</td>
                                    <td>{{ $item->coupon_code }}</td>
                                    <td>{{ $item->coupon_discount }}</td>
                                    <td>{{ $item->coupon_validity }}</td>
                                    <td>{{ $item->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="{{url('delete-coupon')}}/{{$item->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $coupon->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
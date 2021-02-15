@extends('backend.master')

@section('content')
<div class="content">
    <!-- Start Content-->
    @if(session('order'))
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('order')}}.
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <!-- end col -->
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">Billing Details</h4>
                    @if(session('success'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{session('success')}}.
                    </div>
                    @endif
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $billings->user->name ?? "NULL" }}</td>
                                <td>{{ $billings->product->product_name ?? "NULL" }}</td>
                                @if($billings->product->discount_price == NULL)
                                <td>৳ {{ $billings->product->product_price ?? 'N/A' }}</td>
                                @else
                                <td>৳ {{ $billings->product->discount_price ?? 'N/A' }}</td>
                                @endif
                                <td>{{ $billings->product_quantity ?? 'N/A' }}</td>
                                @if($billings->product->discount_price == NULL)
                                <td>৳ {{ $billings->product_quantity * $billings->product->product_price }}</td>
                                @else
                                <td>৳ {{ $billings->product_quantity * $billings->product->discount_price }}</td>
                                @endif
                                <td>
                                @if($billings->order_status == 1) Processing 
                                    @elseif($billings->order_status == 2) Delivared 
                                    @elseif($billings->order_status == 3) Returned 
                                    @elseif($billings->order_status == 4) Canceled 
                                @endif 
                                </td>
                                <td>{{ $billings->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table> 
                    <hr>
                    <h5 class="text-center" colspan="50"> Total = 
                    @if($billings->product->discount_price == NULL)
                    <td>৳ {{ $billings->product_quantity * $billings->product->product_price }}</td>
                    @else
                    <td>৳ {{ $billings->product_quantity * $billings->product->discount_price }}</td>
                    @endif
                    </h5>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> 
    <!-- end container-fluid -->

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <!-- end col -->
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">Shipping Details</h4>
                    @if(session('success'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{session('success')}}.
                    </div>
                    @endif
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Division</th>
                                <th scope="col">District</th>
                                <th scope="col">Upazilla</th>
                                <th scope="col">Union</th>
                                <th scope="col">Address</th>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $billings->shipping->name ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->phone ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->email ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->division ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->district ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->upazila ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->union ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->address ?? "NULL" }}</td>
                                <td>{{ $billings->shipping->payment_type ?? "NULL" }}</td>
                                <td>@if($billings->shipping->payment_status == 1) Pending  @else Paid @endif</td>
                                
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
        <!-- end row -->
        <style>
        .mybtn {
            background: #5d646e;
            border: none;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
        }
        </style>
        <div class="container">
        <h5>Order Status</h5>
        <form action="{{route('OrderStatus')}}" method="post" style="display: inline-flex;">
        @csrf
            <input type="hidden" name="id" value="{{$billings->id}}">
            <p><input type="radio" name="order_status" value="1"> Processing </p>
            <p style="padding: 0px 50px;"><input type="radio" name="order_status" value="2"> Delivared </p>
            <p style="padding: 0px 50px;"><input type="radio" name="order_status" value="3"> Returned </p>
            <p style="padding: 0px 50px;"><input type="radio" name="order_status" value="4"> Canceled </p>
            <input type="submit" class="mybtn" value="Submit">
        </form>
        </div>
        
    </div> 
    <!-- end container-fluid -->
</div>

@endsection
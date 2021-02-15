@extends('backend.master')

@section('header_css')
 <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')

    @if(isset($processing))
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Orders In Processing</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table" id="myTable">
                            <thead class="thead-light">
                                <tr>

                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                                <th scope="col">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            
                                @forelse($processing as $key => $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->user->name ?? "NULL" }}</td>
                                    <td>{{ $item->product->product_name ?? "NULL" }}</td>
                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product->product_price ?? 'N/A' }}</td>
                                        @else
                                        <td>৳ {{ $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    <td>{{ $item->product_quantity ?? 'N/A' }}</td>

                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product_quantity * $item->product->product_price }}</td>
                                        @else
                                        <td>৳ {{ $item->product_quantity * $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    
                                    <td>
                                        @if($item->order_status == 1) Processing 
                                            @elseif($item->order_status == 2) Delivared 
                                            @elseif($item->order_status == 3) Returned 
                                            @elseif($item->order_status == 4) Canceled 
                                        @endif 
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('view-full-information')}}/{{$item->id}} ">View Full Details</a>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="50">No Orders in Processing</td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table> 
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
    @elseif(isset($delivared))
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Orders Delivared</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table" id="myTable">
                            <thead class="thead-light">
                                <tr>

                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                                <th scope="col">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            
                                @forelse($delivared as $key => $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->user->name ?? "NULL" }}</td>
                                    <td>{{ $item->product->product_name ?? "NULL" }}</td>
                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product->product_price ?? 'N/A' }}</td>
                                        @else
                                        <td>৳ {{ $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    <td>{{ $item->product_quantity ?? 'N/A' }}</td>

                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product_quantity * $item->product->product_price }}</td>
                                        @else
                                        <td>৳ {{ $item->product_quantity * $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    
                                    <td>
                                        @if($item->order_status == 1) Processing 
                                            @elseif($item->order_status == 2) Delivared 
                                            @elseif($item->order_status == 3) Returned 
                                            @elseif($item->order_status == 4) Canceled 
                                        @endif 
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('view-full-information')}}/{{$item->id}} ">View Full Details</a>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="50">No Orders in Delivared</td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table> 
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
    @elseif(isset($returned))
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Orders Returned</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table" id="myTable">
                            <thead class="thead-light">
                                <tr>

                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                                <th scope="col">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            
                                @forelse($returned as $key => $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->user->name ?? "NULL" }}</td>
                                    <td>{{ $item->product->product_name ?? "NULL" }}</td>
                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product->product_price ?? 'N/A' }}</td>
                                        @else
                                        <td>৳ {{ $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    <td>{{ $item->product_quantity ?? 'N/A' }}</td>

                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product_quantity * $item->product->product_price }}</td>
                                        @else
                                        <td>৳ {{ $item->product_quantity * $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    
                                    <td>
                                        @if($item->order_status == 1) Processing 
                                            @elseif($item->order_status == 2) Delivared 
                                            @elseif($item->order_status == 3) Returned 
                                            @elseif($item->order_status == 4) Canceled 
                                        @endif 
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('view-full-information')}}/{{$item->id}} ">View Full Details</a>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="50">No Orders Returned</td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table> 
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
    @elseif(isset($canceled))
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Orders Canceled</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table" id="myTable">
                            <thead class="thead-light">
                                <tr>

                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                                <th scope="col">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            
                                @forelse($canceled as $key => $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->user->name ?? "NULL" }}</td>
                                    <td>{{ $item->product->product_name ?? "NULL" }}</td>
                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product->product_price ?? 'N/A' }}</td>
                                        @else
                                        <td>৳ {{ $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    <td>{{ $item->product_quantity ?? 'N/A' }}</td>

                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product_quantity * $item->product->product_price }}</td>
                                        @else
                                        <td>৳ {{ $item->product_quantity * $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    
                                    <td>
                                        @if($item->order_status == 1) Processing 
                                            @elseif($item->order_status == 2) Delivared 
                                            @elseif($item->order_status == 3) Returned 
                                            @elseif($item->order_status == 4) Canceled 
                                        @endif 
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('view-full-information')}}/{{$item->id}} ">View Full Details</a>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="50">No Orders Canceled</td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table> 
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
    @else
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Orders</h4>
                        @if(session('success'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table" id="myTable">
                            <thead class="thead-light">
                                <tr>

                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Products </th>
                                <th scope="col">Price</th>
                                <th scope="col">Qunatity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered At</th>
                                <th scope="col">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($billings as $key => $item)
                                <tr>
                                    <th scope="row">{{ $billings->firstItem() + $key }}</th>
                                    <td>{{ $item->user->name ?? "NULL" }}</td>
                                    <td>{{ $item->product->product_name ?? "NULL" }}</td>
                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product->product_price ?? 'N/A' }}</td>
                                        @else
                                        <td>৳ {{ $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    <td>{{ $item->product_quantity ?? 'N/A' }}</td>

                                        @if($item->product->discount_price == NULL)
                                        <td>৳ {{ $item->product_quantity * $item->product->product_price }}</td>
                                        @else
                                        <td>৳ {{ $item->product_quantity * $item->product->discount_price ?? 'N/A' }}</td>
                                        @endif
                                    
                                    <td>
                                        @if($item->order_status == 1) Processing 
                                            @elseif($item->order_status == 2) Delivared 
                                            @elseif($item->order_status == 3) Returned 
                                            @elseif($item->order_status == 4) Canceled 
                                        @endif 
                                    </td>
                                    <td>{{ $item->created_at->format('d-M-Y') ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('view-full-information')}}/{{$item->id}} ">View Full Details</a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $billings->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
    @endif

@endsection

@section('footer_js')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
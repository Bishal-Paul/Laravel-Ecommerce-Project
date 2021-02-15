@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Information</h4>
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
                                <th scope="col">Emails</th>
                                <th scope="col">Numbers </th>
                                <th scope="col">Road</th>
                                <th scope="col">City</th>
                                <th scope="col">Country</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($info as $key => $item)
                                <tr>
                                    <th scope="row">{{ $info->firstItem() + $key }}</th>
                                    <td>
                                        1. {{ $item->email1 ?? "NULL" }} <br><br>
                                        2. {{ $item->email2 ?? "NULL" }} 
                                    </td>
                                    <td>1. {{ $item->number1 ?? "NULL" }} <br><br>
                                        2. {{ $item->number2 ?? "NULL" }} <br><br>
                                        3. {{ $item->number3 ?? "NULL" }}
                                    </td>
                                    <td>{{ $item->road_no ?? "NULL" }}</td>
                                    <td>{{ $item->city ?? "NULL" }}</td>
                                    <td>{{ $item->country ?? 'N/A' }}</td>
                                    <td>{{ $item->description ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('edit-info')}}/{{$item->id}} ">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{url('delete-info')}}/{{$item->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $info->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
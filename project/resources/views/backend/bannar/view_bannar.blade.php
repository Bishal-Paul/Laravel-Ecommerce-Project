@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Bannar</h4>
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
                                <th scope="col"> Title</th>
                                <th scope="col"> Offer </th>
                                <th scope="col"> Description </th>
                                <th scope="col"> Image </th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bannar as $key => $item)
                                <tr>
                                    <th scope="row">{{ $bannar->firstItem() + $key }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->offer ?? 'N/A' }}</td>
                                    <td>{{ Illuminate\Support\Str::limit($item->description, 50) }}</td>
                                    <td><img src="{{ asset('thumbnail/bannar/'.$item->image ?? 'N/A')  }}" width="150px"></td>
                                    <td>{{ $item->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="{{url('delete-bannar')}}/{{$item->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $bannar->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
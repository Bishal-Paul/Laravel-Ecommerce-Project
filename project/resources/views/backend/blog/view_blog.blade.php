@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Blog Posts</h4>
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
                                <th scope="col">Blog Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog as $key => $cat)
                                <tr>
                                    <th scope="row">{{ $blog->firstItem() + $key }}</th>
                                    <td>{{ $cat->title }}</td>
                                    <td>{{ $cat->category->name }}</td>
                                    <td><img src="{{ asset('thumbnail/category/'.$cat->image ?? 'N/A')  }}" width="150px"></td>
                                    <td>{{ $cat->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('edit-blog')}}/{{$cat->id}} ">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{url('delete-blog')}}/{{$cat->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $blog->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
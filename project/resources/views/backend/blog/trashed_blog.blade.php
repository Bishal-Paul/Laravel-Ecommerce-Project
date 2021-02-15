@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Trashed Blog Posts</h4>
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
                                @foreach($blog as $key => $item)
                                <tr>
                                    <th scope="row">{{ $blog->firstItem() + $key }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td><img src="{{ asset('thumbnail/category/'.$item->image ?? 'N/A')  }}" width="150px"></td>
                                    <td>{{ $item->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-success" href="{{ url('restore-blog')}}/{{$item->id}} ">Restore</a>
                                        <a class="btn btn-outline-danger" href="{{url('permanent-delete')}}/{{$item->id}}">Premanent Delete</a>
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
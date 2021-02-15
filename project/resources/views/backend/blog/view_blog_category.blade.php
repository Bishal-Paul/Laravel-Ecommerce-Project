@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">View Blog Category</h4>
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
                                <th scope="col">Blog Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogcategory as $key => $cat)
                                <tr>
                                    <th scope="row">{{ $blogcategory->firstItem() + $key }}</th>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="{{url('delete-blogcategory')}}/{{$cat->id}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $blogcategory->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
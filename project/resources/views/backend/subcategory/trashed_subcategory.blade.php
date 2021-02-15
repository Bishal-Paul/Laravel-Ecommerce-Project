@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Trashed Sub Category</h4>
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategory as $key => $subcat)
                                <tr>
                                    <th scope="row">{{ $subcategory->firstItem() + $key }}</th>
                                    <td>{{ $subcat->subcategory_name }}</td>
                                    <td>{{ $subcat->category->category_name }}</td>
                                    <td>{{ $subcat->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <a class="btn btn-outline-success" href="{{url('restore-subcategory')}}/{{$subcat->id}}">Restore</a>
                                        <a class="btn btn-outline-danger" href="{{url('permanent-subcategory')}}/{{$subcat->id}}">Permanent Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table> 
                        {{ $subcategory->links() }}    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>

@endsection
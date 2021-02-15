@extends('backend.master')

@section('content')
    <!-- Start Page content -->
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Update Sub Category</h4>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif

                        <form method="post" action="{{url('update-subcategory')}}" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="subcategory_id" value="{{$subcategory->id}}">
                            <div class="form-group row">
                                <label for="category_name" class="col-3 col-form-label">Category Name</label>
                                <div class="col-9">
                                    
                                    <select name="category_id" id="category_id" class="form-control @error('category_name') is-invalid @enderror">
                                    @foreach($category as $cat)
                                        <option  @if($subcategory->category_id == $cat->id) selected @endif value="{{ $cat->id }}">{{ $cat->category_name}}</option>
                                    @endforeach
                                    </select>
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="subcategory_name" class="col-3 col-form-label">Sub Category Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" name="subcategory_name" value="{{ $subcategory->subcategory_name }}">
                                    @error('subcategory_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection
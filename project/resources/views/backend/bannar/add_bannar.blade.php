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
                        <h4 class="header-title mb-4">Add Top Bannar</h4>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif

                        <form method="post" action="{{url('post-bannar')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="title" class="col-3 col-form-label">Short Title *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Welcome To Our Website">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="offer" class="col-3 col-form-label">Offering Something??</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('offer') is-invalid @enderror" name="offer" placeholder="Get Discount">
                                    @error('offer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">Short Description *</label>
                                <div class="col-9">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-3 col-form-label">Image *</label>
                                <div class="col-9">
                                <input type="file" name="image" class="@error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
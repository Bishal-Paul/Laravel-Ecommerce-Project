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
                        <h4 class="header-title mb-4">Add Your Site Information</h4>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif

                        <form method="post" action="{{url('post-info')}}">
                        @csrf
                            <div class="form-group row">
                                <label for="email1" class="col-3 col-form-label">Add Email Address *</label>
                                <div class="col-9">
                                    <input type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" placeholder="example@gmail.com">
                                    @error('email1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email2" class="col-3 col-form-label">Another Email (optional)</label>
                                <div class="col-9">
                                    <input type="email" class="form-control @error('email2') is-invalid @enderror" name="email2">
                                    @error('email2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number1" class="col-3 col-form-label">Add Phone Number *</label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('number1') is-invalid @enderror" name="number1">
                                    @error('number1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number2" class="col-3 col-form-label">Another Number (Optional) </label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('number2') is-invalid @enderror" name="number2">
                                    @error('number2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number3" class="col-3 col-form-label">Extra Number (Optional) </label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('number3') is-invalid @enderror" name="number3">
                                    @error('number3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="road_no" class="col-3 col-form-label">Road Number *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('road_no') is-invalid @enderror" name="road_no">
                                    @error('road_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-3 col-form-label">Add City *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-3 col-form-label">Add Country *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" name="country">
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">Add Short Description *</label>
                                <div class="col-9">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                    @error('description')
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

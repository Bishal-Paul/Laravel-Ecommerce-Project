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
                        <h4 class="header-title mb-4">Edit Your Site Information</h4>
                        
                        @if(session('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{session('success')}}.
                        </div>
                        @endif

                        <form method="post" action="{{url('update-info')}}">
                        @csrf
                            <input type="hidden" name="info_id" value="{{ $info->id}}">
                            <div class="form-group row">
                                <label for="email1" class="col-3 col-form-label">Edit Email Address *</label>
                                <div class="col-9">
                                    <input type="email" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ $info->email1 ?? ''}}">
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
                                    <input type="email" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ $info->email2 ?? ''}}">
                                    @error('email2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number1" class="col-3 col-form-label">Edit Phone Number *</label>
                                <div class="col-9">
                                    <input type="number" class="form-control @error('number1') is-invalid @enderror" name="number1" value="{{ $info->number1 ?? 'N/A'}}">
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
                                    <input type="number" class="form-control @error('number2') is-invalid @enderror" name="number2" value="{{ $info->number2 ?? 'N/A'}}">
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
                                    <input type="number" class="form-control @error('number3') is-invalid @enderror" name="number3" value="{{ $info->number3 ?? 'N/A'}}">
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
                                    <input type="text" class="form-control @error('road_no') is-invalid @enderror" name="road_no" value="{{ $info->road_no ?? 'N/A'}}">
                                    @error('road_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-3 col-form-label">Edit City *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $info->city ?? 'N/A'}}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-3 col-form-label">Edit Country *</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $info->country ?? 'N/A'}}">
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">Edit Description *</label>
                                <div class="col-9">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ $info->description ?? 'N/A'}}"></textarea>
                                    @error('description')
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

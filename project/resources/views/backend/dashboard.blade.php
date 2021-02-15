@extends('backend.master')

@section('content')
<!-- Start Page content -->
<div class="content">

    <div class="container-fluid">
    
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="fa fa-arrow-down float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                        <h2><span data-plugin="counterup">{{App\Billings::count()}}</span></h2>
                        <div class="text-truncate">
                            <span class="badge badge-primary">{{App\Billings::where('order_status', 1)->count()}} </span> <span class="text-muted">Orders in Processing</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="fa fa-users float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Users</h6>
                        <h2><span data-plugin="counterup">{{App\User::where('status', 1)->count()}}</span></h2>
                        <div class="text-truncate">
                            <span class="badge badge-danger"> {{App\User::where('status', 2)->count()}} </span> <span class="text-muted">Admins</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="fa fa-envelope-o float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Newsletters</h6>
                        <h2><span data-plugin="counterup">{{App\Newsletter::count()}}</span></h2>
                        <div class="text-truncate">
                            <span class="badge badge-primary"> +89% </span> <span class="text-muted">Last year</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br>
        
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <h4 class="header-title mb-3">Users</h4>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-centered table-nowrap m-0">

                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php 
                                                $user = Auth::user()->paginate(10);
                                            @endphp
                                            @foreach($user as $users)
                                            <tr>
                                                <td>@if($users->status == 1){{"User"}} @else {{"Admin"}}  @endif</td>
                                                <td>{{$users->name}}</td>
                                                <td>{{$users->email}}</td>
                                                <td>{{$users->created_at->format("d-M-Y")}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            {{ $user->links() }}    

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- content -->
@endsection
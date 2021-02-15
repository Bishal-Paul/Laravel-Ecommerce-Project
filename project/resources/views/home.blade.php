@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center" style="padding: 50px 0px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding-top: 30px; float: left;">{{ __('Welcome to our Website') }}
               
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="float: right; margin: -8px -18px 5px 0px;">
                        {{Auth::user()->name}} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                
                </div>
                <style>
                .mybtn {
                    background: #f7941d;
                    padding: 15px 20px;
                    margin-left: 25px;
                    font-size: 14px;
                    border-radius: 0px;
                }
                .mybtn:hover {
                    background: #000;
                }
                .mybtn a {
                    color: #fff;
                }
                </style>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <button type="button" class="mybtn"><a href="{{route('Shop')}}">Start Shoping</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('frontend.template.layout')

@section('meta')
    <!-- Title -->
    <title>AB Electronics - Forget your password</title>
@endsection


<style>
    #guest-checkout{
        display: none;
    }
    .auth-section{
        padding: 30px 0;
    }
    .auth-box .form-control:focus{
        border: 1px solid #efef48;
    }
    .do-auth{
        margin: 0 auto;
        padding: 5px 40px;
        border-radius: 5px;
        background: #031b4e;
        color: white;
        border: none;
    }
    .auth-facebook{
        background: #1877f2;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
    }
    .auth-google{
        background: #dd4d42;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
    }
    .auth-box{
        background: #f8f8f8;
        padding: 15px;
        border-radius: 5px;
    }
    .input-group-text{
        border-radius: unset!important;
    }
    .input-group > .form-control:not(:first-child), .input-group > .custom-select:not(:first-child){
        border-radius: unset;
    }
    .alert-success {
        color: white!important;
        background-color: green!important;
        border-color: green!important;
        border-radius: 15px!important;
    }
</style>

@section('body-content')
    <!-- login start -->
    <section class="auth-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="auth-box">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                <p style="color: white">{{ session()->get('success') }}</p>
                            </div>
                        @endif
                        @if(session()->has('failed'))
                            <div class="alert alert-danger">
                                <p>{{ session()->get('failed') }}</p>
                            </div>
                        @endif
                        <h2 class="text-center">Enter you email address</h2>
                        <form action="{{ route('get.code') }}"  method="post">
                            @csrf
                            <div class="input-group mb-4 mt-3">
                                          <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-envelope"></i>
                                          </span>
                                <input type="email" name="email" class="form-control" placeholder="Enter your registered email address " aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group make-auth text-center">
                                <button class="do-auth">Send Password Reset Link</button>
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login start -->
@endsection






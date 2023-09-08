@extends('frontend.template.layout')

@section('meta')
      <!-- Title -->
      <title>AB Electronics - Reset Password</title>
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
            display: block;
            margin: 0 auto;
            padding: 5px 40px;
            border-radius: 5px;
            background: #031b4e;
            color: white;
            border: none;
            width: 100%;
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
                                    <h2 class="text-center">Reset Your Password Here</h2>
                                    <form action="{{ route('change.password', $email) }}" method="post">
                                          @csrf
                                          <div class="input-group mb-4 mt-3">
                                          <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-envelope"></i>
                                          </span>
                                                <input type="email" readonly class="form-control @error('email') is-valid @enderror" placeholder="Email Address" name="email" value="{{ $email }}" aria-label="Username" aria-describedby="basic-addon1">
                                          </div>
                                          <div class="input-group mb-3 mt-3">
                                          <span class="input-group-text" id="basic-addon2">
                                                <i class="fas fa-key"></i>
                                          </span>
                                                <input type="password" name="password" class="form-control" placeholder="Enter your password" aria-label="Password" aria-describedby="basic-addon2">
                                          </div>
                                          <div class="input-group mb-3 mt-3">
                                          <span class="input-group-text" id="basic-addon2">
                                                <i class="fas fa-key"></i>
                                          </span>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter your password again" aria-label="Password" aria-describedby="basic-addon2">
                                          </div>

                                          <div class="form-group make-auth">
                                                <button class="do-auth">Reset</button>
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






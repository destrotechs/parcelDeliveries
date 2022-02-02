@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4 justify-content-center bg-info m-0 p-0">
                        <h4 class="m-5 text-white">Station Login</h4>
                       <center> <span><i class="fab fa-fulcrum fa-4x m-4 text-white"></i></span></center>
                    </div>
                    <div class="col-md-8">
                        <h4>Login Here</h4>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                           @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </form>
                </div>                
            </div>
        </div>
    </div>
        
    </div>
</div>
@endsection

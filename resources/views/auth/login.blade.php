@extends('layouts.app')

<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background: #ffffff;
    }
    .container{
        background: ;
    }
    .container::after {
    content: "";
    display: table;
    clear: both;
}

    img{
        width: 1030px;
        height: 720px;
        float: left;
        margin: 0;
        padding: 0;
        position: absolute;
        left: 0;
    }
    .card-header{
        width: 500px;
        height: 50px;
        left: 600px;
    }
    .card-body {
        background: #313651;
        /* Rectangle 18 */
        position: absolute;
        width: 500px;
        height: 720px;
        left: 690px;
        top: 0;
        right: 0;
        margin-top: 0;
        margin-right: 0;
        background: #313651;
        box-shadow: -5px 0px 10px rgba(0, 0, 0, 0.25);
        float: right    ;
    }
    h2{
        position: absolute;
        width: 150px;
        height: 50px;
        left: 40%;
        top: 100px;
        background: #262B43;
        border-radius: 50px;
        justify-content: center;
        color: white;
        font-family: 'poppins';
        text-align: center;
        align-items: center;
    }
    .form{
        top: 50px;
        margin-top:200px ;
    }
    label{
        color: #ffffff;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <img src="{{ asset('web.png') }}" alt="web.png">
            <div class="card">
                <div class="card-body">
                    <h2>Login</h2>
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

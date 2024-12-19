@extends('layouts.app')
<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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
    form{
        margin-top: 200px;
        
    }
    label{
        color: white;
    }
    button{
        width: 225px;
    }
</style>
@section('content')
<div class="container">
<img src="{{ asset('web.png') }}" alt="web.png">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>Register</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

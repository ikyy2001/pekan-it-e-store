@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #62929A;
        --primary-darker: #4A7278;
        --text-dark: #2C3E50;
        --text-muted: #95A5A6;
        --background-light: #F8FAFC;
    }
    
    body {
        background: linear-gradient(145deg, var(--primary-darker) 0%, var(--primary-color) 100%);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }
    
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 400px;
        padding: 2.5rem;
        transition: transform 0.3s ease;
    }
    
    .login-card:hover {
        transform: translateY(-5px);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    
    .login-header h2 {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .login-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    
    .form-label {
        color: var(--text-dark);
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .form-control {
        border-radius: 12px;
        padding: 0.8rem 1rem;
        border: 2px solid #E2E8F0;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        background-color: var(--background-light);
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(98, 146, 154, 0.15);
        background-color: white;
    }
    
    .form-check {
        padding-left: 1.8rem;
    }
    
    .form-check-input {
        width: 1.1rem;
        height: 1.1rem;
        margin-left: -1.8rem;
        border: 2px solid #CBD5E0;
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .form-check-label {
        color: var(--text-dark);
        font-size: 0.9rem;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-darker);
        transform: translateY(-1px);
    }
    
    .btn-primary:active {
        transform: translateY(1px);
    }
    
    .btn-link {
        color: var(--primary-color);
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .btn-link:hover {
        color: var(--primary-darker);
        text-decoration: underline;
    }
    
    @media (max-width: 576px) {
        .login-card {
            padding: 2rem;
        }
        
        .login-header {
            margin-bottom: 2rem;
        }
        
        .login-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" 
                       required autocomplete="email" autofocus
                       placeholder="Enter your email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="Enter your password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" 
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Sign In') }}
                </button>
                
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection

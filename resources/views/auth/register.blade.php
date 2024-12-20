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
    
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    
    .auth-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 450px;
        padding: 2.5rem;
        transition: transform 0.3s ease;
    }
    
    .auth-card:hover {
        transform: translateY(-5px);
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    
    .auth-title {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        color: var(--text-dark);
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: block;
    }
    
    .form-control {
        border-radius: 12px;
        padding: 0.8rem 1rem;
        border: 2px solid #E2E8F0;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        background-color: var(--background-light);
        width: 100%;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(98, 146, 154, 0.15);
        background-color: white;
    }
    
    .invalid-feedback {
        display: block;
        color: #DC3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
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
        width: 100%;
        color: white;
        cursor: pointer;
        margin-top: 1rem;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-darker);
        transform: translateY(-1px);
    }
    
    .btn-primary:active {
        transform: translateY(1px);
    }
    
    @media (max-width: 576px) {
        .auth-card {
            padding: 2rem;
        }
        
        .auth-header {
            margin-bottom: 2rem;
        }
        
        .auth-title {
            font-size: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2 class="auth-title">Register</h2>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input id="name" type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" 
                       required autocomplete="name" autofocus
                       placeholder="Enter your name">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" 
                       required autocomplete="email"
                       placeholder="Enter your email">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">{{ __('Password') }}</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Create a password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" 
                       class="form-control" name="password_confirmation" 
                       required autocomplete="new-password"
                       placeholder="Confirm your password">
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Create Account') }}
            </button>
        </form>
    </div>
</div>
@endsection

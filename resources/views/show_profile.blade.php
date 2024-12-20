@extends('layouts.app')

<style>
    /* Reset & Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --primary-color: #62929A;
        --dark-bg: #262B43;
        --white: #ffffff;
        --gray-light: #f5f5f5;
        --shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    /* Profile Container Styles */
    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .profile-card {
        background: var(--white);
        border-radius: 15px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .profile-header {
        background: var(--primary-color);
        padding: 2rem;
        text-align: center;
        position: relative;
    }

    .profile-header h3 {
        color: var(--white);
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: var(--gray-light);
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary-color);
        border: 4px solid var(--white);
    }

    .profile-body {
        padding: 2rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #333;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(98, 146, 154, 0.2);
        outline: none;
    }

    .form-control:disabled {
        background-color: var(--gray-light);
        cursor: not-allowed;
    }

    /* Button Styles */
    .btn-update {
        background: var(--primary-color);
        color: var(--white);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        background: #557b82;
        transform: translateY(-2px);
    }

    /* Error Messages */
    .error-message {
        background: #fff2f2;
        color: #ff4444;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-container {
            margin: 1rem auto;
        }

        .profile-header {
            padding: 1.5rem;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }

        .profile-body {
            padding: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .profile-header h3 {
            font-size: 1.5rem;
        }

        .btn-update {
            padding: 0.7rem 1.5rem;
        }
    }
</style>

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <!-- You can replace this with user's initial or profile picture -->
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h3>Profile Settings</h3>
        </div>

        <div class="profile-body">
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('edit_profile') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" 
                           class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" 
                           value="{{ $user->email }}" disabled>
                </div>

                <div class="form-group">
                    <label>Account Type</label>
                    <input type="text" class="form-control"
                           value="{{ $user->is_admin ? 'Admin' : 'Member' }}" disabled>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" 
                           class="form-control" placeholder="Enter new password">
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" 
                           class="form-control" placeholder="Confirm new password">
                </div>

                <button type="submit" class="btn-update">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

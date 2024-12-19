@extends('layouts.app')
<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .card{
        background:  #262B43;
        margin-top: 100px;
        position: absolute;
    }
    .card-body{
        background: #262B43;
    }
    h3{
        font-family: 'poppins';
        color: white;
        background-color: #62929A;
        width:150px ;
        font-size: 50px;
        align-items:center;
        text-align: center;
        border-radius: 30px;
        top: 0;
    }
    label{
        color: #ffffff;
        margin-bottom: 5px;
    }
    form button{
        background: #62929A;
        margin-left: 600px;
        width: 200px;
    }
    
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                        <h3>Your Profile</h3>
                        <form action="{{ route('edit_profile') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="role" class="form-control"
                                    value="{{ $user->is_admin ? 'Admin' : 'Member' }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Change profile details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

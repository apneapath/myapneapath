@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reset Your Password</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" required class="form-control" value="{{ $email }}">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
@endsection

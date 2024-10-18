@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Forgot Your Password?</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" required class="form-control" id="email">
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
    </div>
@endsection

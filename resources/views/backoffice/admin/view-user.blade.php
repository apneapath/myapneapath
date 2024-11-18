@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">User Information</h4>
        </div>

        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card shadow-2-strong" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ $user->photo && Storage::disk('public')->exists($user->photo) ? asset('storage/' . $user->photo) : asset('img/backoffice/avatar/user-default-photo.png') }}"
                                    alt="User Photo" style="width: 100px; height: 100px; border-radius: 100%">
                            </div>
                            <div class="col-10">
                                <h5>Name: {{ $user->first_name }} {{ $user->last_name }}</h5>
                                <p>Email: {{ $user->email }}</p>
                                <p>Role:
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p>Status: {{ $user->status }}</p>
                                <p>Phone: {{ $user->phone_number }}</p>
                                <p>Address: {{ $user->address }}</p>
                                <p>Gender: {{ $user->gender }}</p>
                                <p>Username: {{ $user->username }}</p>
                                <a href="{{ route('users-list') }}" class="btn btn-sm btn-secondary mt-3">Back to Users
                                    List</a>
                                <a href="{{ route('edit-user', $user->id) }}" class="btn btn-sm btn-primary mt-3">Edit
                                    User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

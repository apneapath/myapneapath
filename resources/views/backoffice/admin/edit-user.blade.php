@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Update User Information</h1>
            </div>
            <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-user-plus"></i>
                Create User
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('update-user', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-2">
                                        <div class="position-relative">
                                            @if ($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo"
                                                    style="max-width: 100px; margin-top: 10px;"
                                                    title="Click to change photo">
                                            @endif
                                            <label title="Change photo" for="photo"
                                                class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm rounded-circle"
                                                style="margin-bottom: -90px; margin-left: -30px"><i
                                                    class="fa-solid fa-pen"></i></label>
                                            <input type="file" class="form-control" id="photo" name="photo" hidden>
                                        </div>
                                    </div>
                                    <div class="col-5">


                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="firstName">First Name</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName"
                                                    value="{{ old('first_name', $user->first_name) }}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName"
                                                    value="{{ old('last_name', $user->last_name) }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="gender">Gender</label>
                                                <select id="gender" class="form-control" name="gender" required>
                                                    <option value="" disabled {{ !$user->gender ? 'selected' : '' }}>
                                                        Choose...
                                                    </option>
                                                    <option value="Female"
                                                        {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                        Female
                                                    </option>
                                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>
                                                        Male
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label for="status">Status</label>
                                                <select id="status" class="form-control" name="status" required>
                                                    <option value="Active"
                                                        {{ $user->status == 'Active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="Inactive"
                                                        {{ $user->status == 'Inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    disabled value="{{ old('email', $user->email) }}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="phoneNumber">Phone No.</label>
                                                <input type="tel" class="form-control" id="phoneNumber"
                                                    name="phoneNumber"
                                                    value="{{ old('phone_number', $user->phone_number) }}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="role">Role</label>
                                                <select id="role" class="form-control" name="role" required>
                                                    <option value="" disabled selected>Choose...</option>
                                                    <option value="Super Admin"
                                                        {{ $user->role == 'Super Admin' ? 'selected' : '' }}>Super Admin
                                                    </option>
                                                    <option value="Administrator"
                                                        {{ $user->role == 'Administrator' ? 'selected' : '' }}>
                                                        Administrator
                                                    </option>
                                                    <option value="Virtual Assistance"
                                                        {{ $user->role == 'Virtual Assistance' ? 'selected' : '' }}>Virtual
                                                        Assistance (VA)</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="address">Full Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="userName">Username</label>
                                                <input type="text" class="form-control" id="userName" name="userName"
                                                    value="{{ old('username', $user->username) }}">
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" value="{{ old('password', $user->password) }}"
                                                    disabled>
                                            </div>
                                            <div class="form-group text-right col-12">
                                                <a href="/users-list"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Back</a>
                                                <button type="submit"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Update
                                                    User</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('phoneNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection

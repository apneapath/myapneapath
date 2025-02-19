@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Update User Information</h4>
            </div>
            <a href="/users-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View User List
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('update-user', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row col-9 align-items-start justify-content-start">
                                        <div class="row mb-5">
                                            <!-- Basic Information -->
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                            </div>

                                            <!-- First Name -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="firstName">First Name</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="firstName" value="{{ old('first_name', $user->first_name) }}">
                                                </div>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="lastName">Last Name</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="lastName" value="{{ old('last_name', $user->last_name) }}">
                                                </div>
                                            </div>

                                            <!-- Gender -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="gender">Gender</label>
                                                <div class="col-10">
                                                    <select id="gender" class="form-control" name="gender" required>
                                                        <option value="" disabled
                                                            {{ !$user->gender ? 'selected' : '' }}>
                                                            Choose...</option>
                                                        <option value="Female"
                                                            {{ $user->gender == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="Male"
                                                            {{ $user->gender == 'Male' ? 'selected' : '' }}>
                                                            Male</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="email">Email address</label>
                                                <div class="col-10">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email', $user->email) }}">
                                                </div>
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="phoneNumber">Phone No.</label>
                                                <div class="col-10">
                                                    <input type="tel" class="form-control" id="phoneNumber"
                                                        name="phoneNumber"
                                                        value="{{ old('phone_number', $user->phone_number) }}">
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="address">Full Address</label>
                                                <div class="col-10">
                                                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <!-- User Setting -->
                                            <div>
                                                <h5 class="mb-3 text-gray-800">User Setting</h5>
                                            </div>

                                            <!-- Role -->
                                            <div class="row form-group col-12">
                                                <label class="col-2" for="role">Role</label>
                                                <div class="col-10">
                                                    <select id="role" name="role[]" class="form-control" required>
                                                        <option value="" disabled>Choose...</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ in_array($role->id, old('role', $user->roles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Facility Name Input (Autocomplete) -->
                                            <div class="row form-group col-12" style="position: relative;">
                                                <label class="col-2" for="facilityName">Facility</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="facility_name"
                                                        id="facilityName" autocomplete="off"
                                                        value="{{ old('facility_name', $user->facility_name) }}"
                                                        placeholder="Start typing to search...">
                                                    <ul id="suggestions-list" class="list-group"
                                                        style="display:none; position: absolute; width: 100%; z-index: 1; background-color: white; border: 1px solid #ddd;">
                                                    </ul>
                                                </div>
                                            </div>



                                            <!-- Status -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="status">Status</label>
                                                <div class="col-10">
                                                    <select id="status" class="form-control" name="status" required>
                                                        <option value="Active"
                                                            {{ $user->status == 'Active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="Inactive"
                                                            {{ $user->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Username -->
                                            <div class="row form-group col-12">
                                                <label class="col-2" for="userName">Username</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="userName"
                                                        name="username" value="{{ old('username', $user->username) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Change Password -->
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Chage Password</h5>
                                            </div>

                                            <!-- Current Password -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="current_password">Current Password</label>
                                                <div class="col-10">
                                                    <input type="password" class="form-control" id="current_password"
                                                        name="current_password">
                                                </div>
                                            </div>

                                            <!-- New Password -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="new_password">New Password</label>
                                                <div class="col-10">
                                                    <input type="password" class="form-control" id="new_password"
                                                        name="new_password">
                                                </div>
                                            </div>

                                            <!-- Confirm New Password -->
                                            <div class="row form-group col-12">
                                                <label class="col-2" for="new_password_confirmation">Confirm New
                                                    Password</label>
                                                <div class="col-10">
                                                    <input type="password" class="form-control"
                                                        id="new_password_confirmation" name="new_password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <!-- User Photo -->
                                        <div class="position-relative">
                                            <div class="position-relative">
                                                <img id="photoPreview"
                                                    src="{{ $user->photo && Storage::disk('public')->exists($user->photo) ? asset('storage/' . $user->photo) : asset('img/backoffice/avatar/user-default-photo.png') }}"
                                                    alt="User Photo"
                                                    style="width: 150px; height: 150px; margin-top: 10px; border-radius: 100%"
                                                    title="Click to change photo">

                                                <label title="Change photo" for="photo"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm rounded-circle"
                                                    style="margin-bottom: -90px; margin-left: -30px">
                                                    <i class="fa-solid fa-pen"></i>
                                                </label>
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    hidden onchange="previewPhoto(event)">
                                            </div>
                                        </div>

                                        <!-- User Name and Role -->
                                        <div>
                                            <h4 class="mt-3 text-gray-800">
                                                {{ old('first_name', $user->first_name) }}
                                                {{ old('last_name', $user->last_name) }}
                                            </h4>

                                            <p>{{ $user->roles->pluck('name')->join(', ') }}</p>
                                        </div>

                                        <!-- User Setting -->
                                        <div class="form-group text-center col-12">
                                            <a href="{{ route('view-user', $user->id) }}"
                                                class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>

                                            <button type="submit" id="updateButton"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                disabled>Update</button>
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
@endsection

@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">New User Registration</h4>
            </div>
            <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-user-plus"></i>
                Create User
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('users-list') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="text-gray-800">Basic Information</h5>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                placeholder="ex. Calixto Francis" required>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                placeholder="ex. Mantal" required>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="gender">Gender</label>
                                            <select id="gender" class="form-control" name="gender" required>
                                                <option value="" disabled selected>Choose...</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="phoneNumber">Phone No.</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                                placeholder="ex. (00)0-0000-0000" required>
                                        </div>
                                        <div class="form-group col-9">
                                            <label for="address">Full Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="1"
                                                placeholder="ex. House Block and Lot No., Street, Subdivision/Village, City, Province" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="text-gray-800">User Setting</h5>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="role">Role</label>
                                            <select id="role" class="form-control" name="role" required>
                                                <option value="" disabled selected>Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status" required>
                                                <option selected value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="userName">Username</label>
                                            <input type="text" class="form-control" id="userName" name="userName"
                                                placeholder="ex. calixto_mantal">
                                        </div>

                                        <div class="form-group col-3">
                                            <div class="mb-3">
                                                <label for="formFile">Upload Photo</label>
                                                <input class="form-control" type="file" name="photo" accept="image/*"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="ex. 8 character" required>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Confirm password" required>
                                        </div>
                                    </div>

                                    <div class="row align-items-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="/users-list"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                                <button type="submit" id="submit" name="submit"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
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

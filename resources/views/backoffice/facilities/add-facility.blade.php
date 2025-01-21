@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Create New Facility</h4>
            </div>
            <a href="/facilities-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Facility List
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('facilities-list') }}">
                                @csrf

                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                        </div>

                                        <!-- Facility Name -->
                                        <div class="form-group col-3">
                                            <label for="name">Facility Name</label>
                                            <input type="text" class="form-control" id="name" name="facility_name"
                                                placeholder="e.g. General Hospital" required>
                                        </div>

                                        <!-- Facility Type -->
                                        <div class="form-group col-3">
                                            <label for="facility_type">Facility Type</label>
                                            <input type="text"
                                                class="form-control @error('facility_type') is-invalid @enderror"
                                                id="facility_type" name="facility_type" placeholder="e.g. Hospital"
                                                value="{{ old('facility_type') }}" required>
                                            @error('facility_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Contact Information</h5>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group col-3">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="phone_number" name="phone_number" placeholder="e.g. (00)0-0000-0000"
                                                value="{{ old('phone_number') }}" required>
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="name@example.com"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Address</h5>
                                        </div>

                                        <!-- Street Address -->
                                        <div class="form-group col-4">
                                            <label for="street">Street Address</label>
                                            <input type="text" class="form-control" id="street" name="street"
                                                placeholder="e.g. 123 Main St" required>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group col-2">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                id="city" name="city" placeholder="e.g. New York"
                                                value="{{ old('city') }}" required>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- State -->
                                        <div class="form-group col-2">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                id="state" name="state" placeholder="e.g. NY"
                                                value="{{ old('state') }}" required>
                                            @error('state')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Postal Code -->
                                        <div class="form-group col-2">
                                            <label for="postal_code">Postal Code</label>
                                            <input type="text"
                                                class="form-control @error('postal_code') is-invalid @enderror"
                                                id="postal_code" name="postal_code" placeholder="e.g. 10001"
                                                value="{{ old('postal_code') }}" required>
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Country -->
                                        <div class="form-group col-2">
                                            <label for="country">Country</label>
                                            <input type="text"
                                                class="form-control @error('country') is-invalid @enderror" id="country"
                                                name="country" placeholder="e.g. United States"
                                                value="{{ old('country') }}" required>
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row align-items-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="/facilities-list"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                                <button type="submit"
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
@endsection

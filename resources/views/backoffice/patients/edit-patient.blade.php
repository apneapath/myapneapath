@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Update Patient Information</h4>
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

                            <form method="POST" action="{{ route('patients.update', $patient->id) }}">
                                @csrf

                                <div class="row">
                                    {{-- <div class="col-2">
                                        <div class="position-relative">
                                            <div class="position-relative">
                                                <img id="photoPreview"
                                                    src="{{ $patient->photo && Storage::disk('public')->exists($patient->photo) ? asset('storage/' . $patient->photo) : asset('img/backoffice/avatar/user-default-photo.png') }}"
                                                    alt="Patient Photo"
                                                    style="width: 100px; height: 100px; margin-top: 10px; border-radius: 100%"
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
                                    </div> --}}

                                    <div class="col-5">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name"
                                                    value="{{ old('first_name', $patient->first_name) }}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    value="{{ old('last_name', $patient->last_name) }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="gender">Gender</label>
                                                <select id="gender" class="form-control" name="gender" required>
                                                    <option value="Male"
                                                        {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                    <option value="Other"
                                                        {{ $patient->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" name="dob"
                                                    value="{{ old('dob', $patient->dob) }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="contact_number">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number"
                                                    name="contact_number"
                                                    value="{{ old('contact_number', $patient->contact_number) }}" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="email">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $patient->email) }}">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="insurance_provider">Insurance Provider</label>
                                                <input type="text" class="form-control" id="insurance_provider"
                                                    name="insurance_provider"
                                                    value="{{ old('insurance_provider', $patient->insurance_provider) }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="medical_history">Medical History</label>
                                                <textarea class="form-control" id="medical_history" name="medical_history" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="allergies">Allergies</label>
                                                <textarea class="form-control" id="allergies" name="allergies" rows="3">{{ old('allergies', $patient->allergies) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="row">
                                            <!-- Emergency Contact -->
                                            <div class="form-group col-12">
                                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                                <input type="text" class="form-control" id="emergency_contact_name"
                                                    name="emergency_contact_name"
                                                    value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                                                    required>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                                <input type="text" class="form-control" id="emergency_contact_phone"
                                                    name="emergency_contact_phone"
                                                    value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
                                                    required>
                                            </div>

                                            <!-- Address Section -->
                                            <div class="form-group col-12">
                                                <label for="street_address">Street Address</label>
                                                <input type="text" class="form-control" id="street_address"
                                                    name="street_address"
                                                    value="{{ old('street_address', $patient->street_address) }}"
                                                    required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city"
                                                    value="{{ old('city', $patient->city) }}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" id="state" name="state"
                                                    value="{{ old('state', $patient->state) }}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="postal_code">Postal Code</label>
                                                <input type="text" class="form-control" id="postal_code"
                                                    name="postal_code"
                                                    value="{{ old('postal_code', $patient->postal_code) }}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="country"
                                                    value="{{ old('country', $patient->country) }}">
                                            </div>
                                        </div>

                                        <div class="form-group text-right col-12">
                                            <a href="/patients-list"
                                                class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Back to
                                                Patients List</a>
                                            <button type="submit"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Update
                                                Patient</button>
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

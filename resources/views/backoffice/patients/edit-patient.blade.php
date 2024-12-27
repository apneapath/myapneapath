@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Update Patient Information</h4>
            </div>
            <a href="/patients-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Patient List
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

                                    <div class="col-12">

                                        <div class="row mb-5">
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                            </div>

                                            <!-- First Name -->
                                            <div class=" row form-group col-12">
                                                <label class="col-sm-2" for="first_name">First Name</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="first_name"
                                                        name="first_name"
                                                        value="{{ old('first_name', $patient->first_name) }}" required>
                                                </div>
                                            </div>

                                            <!-- Last Name -->
                                            <div class=" row form-group col-12">
                                                <label class="col-sm-2" for="last_name">Last Name</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="last_name"
                                                        name="last_name" value="{{ old('last_name', $patient->last_name) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Gender -->
                                            <div class=" row form-group col-12">
                                                <label class="col-sm-2" for="gender">Gender</label>
                                                <div class="col-10">
                                                    <select id="gender" class="form-control" name="gender" required>
                                                        <option value="Male"
                                                            {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female"
                                                            {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="Other"
                                                            {{ $patient->gender == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Date of Birth -->
                                            <div class=" row form-group col-12">
                                                <label class="col-sm-2" for="dob">Date of Birth</label>
                                                <div class="col-3">
                                                    <input type="date" class="form-control" id="dob" name="dob"
                                                        value="{{ old('dob', $patient->dob) }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Contact Information</h5>
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="contact_number">Contact Number</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="contact_number"
                                                        name="contact_number"
                                                        value="{{ old('contact_number', $patient->contact_number) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="email">Email Address</label>
                                                <div class="col-10">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email', $patient->email) }}">
                                                </div>
                                            </div>

                                            <!-- Emergency Contact Name -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="emergency_contact_name">Emergency Contact
                                                    Name</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="emergency_contact_name"
                                                        name="emergency_contact_name"
                                                        value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Emergency Contact Number -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="emergency_contact_phone">Emergency Contact
                                                    Phone</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="emergency_contact_phone"
                                                        name="emergency_contact_phone"
                                                        value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Address</h5>
                                            </div>

                                            <!-- Address -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="street_address">Street Address</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="street_address"
                                                        name="street_address"
                                                        value="{{ old('street_address', $patient->street_address) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- City -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="city">City</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="city"
                                                        name="city" value="{{ old('city', $patient->city) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- State -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="state">State</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="state"
                                                        name="state" value="{{ old('state', $patient->state) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Postal Code -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="postal_code">Postal Code</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="postal_code"
                                                        name="postal_code"
                                                        value="{{ old('postal_code', $patient->postal_code) }}" required>
                                                </div>
                                            </div>

                                            <!-- Country -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="country">Country</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="country"
                                                        name="country" value="{{ old('country', $patient->country) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Medical Information</h5>
                                            </div>

                                            <!-- Medical History -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="medical_history">Medical History</label>
                                                <div class="col-10">
                                                    <textarea class="form-control" id="medical_history" name="medical_history" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Allergies -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="allergies">Allergies</label>
                                                <div class="col-10">
                                                    <textarea class="form-control" id="allergies" name="allergies" rows="3">{{ old('allergies', $patient->allergies) }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div>
                                                <h5 class="mb-3 text-gray-800">Insurance Information</h5>
                                            </div>

                                            <!-- Insurance Provider -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="insurance_provider">Insurance
                                                    Provider</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="insurance_provider"
                                                        name="insurance_provider"
                                                        value="{{ old('insurance_provider', $patient->insurance_provider) }}">
                                                </div>
                                            </div>

                                            <!-- Insurance Number -->
                                            <div class="row form-group col-12">
                                                <label class="col-sm-2" for="policyNumber">Insurance
                                                    Number</label>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="policyNumber"
                                                        name="policy_number"
                                                        value="{{ old('policy_number', $patient->policy_number) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group text-right col-12">
                                            <a href="/patients-list"
                                                class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                            <button type="submit"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Update</button>
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

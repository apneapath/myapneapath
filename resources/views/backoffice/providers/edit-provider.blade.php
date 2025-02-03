@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Update Provider Information</h4>
            </div>
            <a href="/providers-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Provider List
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <!-- Form to edit an existing provider -->
                            <form method="POST" action="{{ route('providers.update', $provider->provider_code) }}">
                                @csrf
                                <div class="row">
                                    <div class="row col-12 mb-5 align-items-start justify-content-start">
                                        <!-- First Name -->
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                        </div>

                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="firstName">First Name</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="firstName" name="first_name"
                                                    value="{{ $provider->first_name }}" placeholder="ex. John" required>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="lastName">Last Name</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="lastName" name="last_name"
                                                    value="{{ $provider->last_name }}" placeholder="ex. Doe" required>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="gender">Gender</label>
                                            <div class="col-10">
                                                <select id="gender" class="form-control" name="gender" required>
                                                    <option value="Female"
                                                        {{ $provider->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                    <option value="Male"
                                                        {{ $provider->gender == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="row form-group col-13">
                                            <label class="col-sm-2" for="dob">Date of Birth</label>
                                            <div class="col-3">
                                                <input type="date" class="form-control" id="dob" name="dob"
                                                    value="{{ $provider->dob }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 mb-5 align-items-start justify-content-start">

                                        <div>
                                            <h5 class="mb-3 text-gray-800">Contact Information</h5>
                                        </div>

                                        <!-- Fax Number -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="fax_number">Fax Number</label>
                                            <div class="col-10">
                                                <input type="text" name="fax_number" id="fax_number" class="form-control"
                                                    value="{{ old('fax_number', $provider->fax_number ?? 'N/A') }}">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2"for="email">Email address</label>
                                            <div class="col-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $provider->email }}" placeholder="name@example.com" required>
                                            </div>
                                        </div>

                                        <!-- Contact Number -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="contactNumber">Contact Number</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="contactNumber"
                                                    name="contact_number" value="{{ $provider->contact_number }}"
                                                    placeholder="ex. (00)0-0000-0000" required>
                                            </div>
                                        </div>

                                        <!-- Emergency Contact Name -->
                                        {{-- <div class="row form-group col-12">
                                            <label class="col-sm-2" for="emergencyContactName">Emergency Contact
                                                Name</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="emergencyContactName"
                                                    name="emergency_contact_name"
                                                    value="{{ $provider->emergency_contact_name }}" placeholder="ex. Danilo"
                                                    required>
                                            </div>
                                        </div> --}}

                                        <!-- Emergency Contact Phone -->
                                        {{-- <div class="row form-group col-12">
                                            <label class="col-sm-2" for="emergencyContactPhone">Emergency Contact
                                                Phone</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="emergencyContactPhone"
                                                    name="emergency_contact_phone"
                                                    value="{{ $provider->emergency_contact_phone }}"
                                                    placeholder="ex. (00)0-0000-0000" required>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row col-12 mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class=" mb-3 text-gray-800">Address</h5>
                                        </div>

                                        <!-- Street -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="clinicAddress">Street</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="clinicAddress" name="street"
                                                    value="{{ $provider->street }}"
                                                    placeholder="ex. 142 J. Marzan St. Sampaloc Manila" required>
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="city">City</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="city" name="city"
                                                    value="{{ $provider->city }}" placeholder="ex. Manila" required>
                                            </div>
                                        </div>

                                        <!-- State -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="state">State</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="state" name="state"
                                                    value="{{ $provider->state }}" placeholder="ex. NCR" required>
                                            </div>
                                        </div>

                                        <!-- Postal Code -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="postalCode">Postal Code</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="postalCode"
                                                    name="postal_code" value="{{ $provider->postal_code }}"
                                                    placeholder="ex. 1008" required>
                                            </div>
                                        </div>

                                        <!-- Country -->
                                        {{-- <div class="row form-group col-12">
                                            <label class="col-sm-2" for="country">Country</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="country" name="country"
                                                    value="{{ $provider->country }}" placeholder="ex. Philippines">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row col-12 mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class=" mb-3 text-gray-800">Healthcare Information</h5>
                                        </div>

                                        <!-- Specialization -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="specialization">Specialty</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="specialization"
                                                    name="specialization" value="{{ $provider->specialization }}"
                                                    placeholder="ex. Dermatology">
                                            </div>
                                        </div>

                                        {{-- <!-- License Number -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="licenseNumber">License Number</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="licenseNumber"
                                                    name="license_number" value="{{ $provider->license_number }}"
                                                    placeholder="ex. n089">
                                            </div>
                                        </div> --}}

                                        <!-- NPI -->
                                        {{-- <div class="row form-group col-12">
                                            <label class="col-sm-2" for="npi">NPI</label>
                                            <div class="col-10">
                                                <input type="text" name="npi" id="npi" class="form-control"
                                                    value="{{ old('npi', $provider->npi) }}">
                                            </div>
                                        </div> --}}

                                        <!-- Facility Name Input (Autocomplete) -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2"for="facilityName">Facility</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control" id="facilityName"
                                                    name="facility_name"
                                                    value="{{ old('facility_name', $provider->facility_name) }}"
                                                    placeholder="ex. Glow Smile" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="text-gray-800">Account Setting</h5>
                                        </div>

                                        <!-- Working Hours -->
                                        {{-- <div class="row form-group col-12">
                                            <label class="col-sm-2" for="workingHours">Working Hours</label>
                                            <div class="col-10">
                                                <textarea class="form-control" id="workingHours" name="work_hours" placeholder="ex. Mon. - Fri.: 9:00 AM - 5:00 PM"
                                                    rows="2" required>{{ $provider->work_hours }}</textarea>
                                            </div>
                                        </div> --}}

                                        <!-- Account Status -->
                                        <div class="row form-group col-12">
                                            <label class="col-sm-2" for="accountStatus">Account Status</label>
                                            <div class="col-10">
                                                <select id="accountStatus" class="form-control" name="account_status"
                                                    required>
                                                    <option value="Active"
                                                        {{ $provider->account_status == 'Active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="Suspended"
                                                        {{ $provider->account_status == 'Suspended' ? 'selected' : '' }}>
                                                        Suspended</option>
                                                    <option value="Retired"
                                                        {{ $provider->account_status == 'Retired' ? 'selected' : '' }}>
                                                        Retired</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-start justify-content-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="{{ route('providers-list') }}"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                                <button type="submit" id="submit" name="submit"
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

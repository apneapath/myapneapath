@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Create New Provider</h4>
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
                            <!-- Form to add new provider -->
                            <form method="POST" action="{{ route('providers-list') }}">
                                @csrf
                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">

                                        <div>
                                            <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                        </div>

                                        <!-- First Name -->
                                        <div class="form-group col-3">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="first_name"
                                                placeholder="ex. John" required>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group col-3">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name"
                                                placeholder="ex. Doe" required>
                                        </div>

                                        <!-- Gender -->
                                        <div class="form-group col-3">
                                            <label for="gender">Gender</label>
                                            <select id="gender" class="form-control" name="gender" required>
                                                <option value="" disabled selected>Choose...</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="form-group col-3">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob"
                                                required>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                        </div>

                                        <!-- Contact Number -->
                                        <div class="form-group col-3">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber"
                                                name="contact_number" placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Emergency Contact Name -->
                                        <div class="form-group col-3">
                                            <label for="emergencyContactName">Emergency Contact Name</label>
                                            <input type="text" class="form-control" id="emergencyContactName"
                                                name="emergency_contact_name" placeholder="ex. Danilo" required>
                                        </div>

                                        <!-- Emergency Contact Number -->
                                        <div class="form-group col-3">
                                            <label for="emergencyContactPhone">Emergency Contact Phone</label>
                                            <input type="text" class="form-control" id="emergencyContactPhone"
                                                name="emergency_contact_phone" placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Fax -->
                                        <div class="form-group col-3">
                                            <label for="fax_number">Fax Number</label>
                                            <input type="text" id="fax_number" name="fax_number" class="form-control"
                                                pattern="\d{10}" title="Fax number should be exactly 10 digits">
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class=" mb-3 text-gray-800">Healthcare Information</h5>
                                        </div>

                                        <!-- Specialization -->
                                        <div class="form-group col-3">
                                            <label for="specialization">Specialization</label>
                                            <input type="text" class="form-control" id="specialization"
                                                name="specialization" placeholder="ex. Dermatology" required>
                                        </div>

                                        <!-- License Number -->
                                        <div class="form-group col-3">
                                            <label for="licenseNumber">License Number</label>
                                            <input type="text" class="form-control" id="licenseNumber"
                                                name="license_number" placeholder="ex. n089" required>
                                        </div>

                                        <!-- NPI -->
                                        <div class="form-group col-3">
                                            <label for="npi">NPI (National Provider Identifier)</label>
                                            <input type="text" id="npi" name="npi" class="form-control"
                                                required pattern="\d{10}" title="NPI should be exactly 10 digits">
                                        </div>

                                        <!-- Clinic Name -->
                                        <div class="form-group col-3">
                                            <label for="clinicName">Clinic Name</label>
                                            <input type="text" class="form-control" id="clinicName"
                                                name="clinic_name" placeholder="ex. Glow Smile" required>
                                        </div>

                                        <!-- Clinic Address -->
                                        <div class="form-group col-3">
                                            <label for="clinicAddress">Clinic Address</label>
                                            <input type="text" class="form-control" id="clinicAddress"
                                                name="clinic_address" placeholder="ex. 142 J. Marzan St. Sampaloc Manila"
                                                required>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group col-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="ex. Manila" required>
                                        </div>


                                        <!-- State -->
                                        <div class="form-group col-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="ex. NCR" required>
                                        </div>

                                        <!-- Postal -->
                                        <div class="form-group col-3">
                                            <label for="postalCode">Postal Code</label>
                                            <input type="text" class="form-control" id="postalCode"
                                                name="postal_code" placeholder="ex. 1008" required>
                                        </div>

                                        <!-- Country -->
                                        <div class="form-group col-3">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                placeholder="ex. Philippines" required>
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Availability</h5>
                                        </div>

                                        <!-- Working Hours -->
                                        <div class="form-group col-6">
                                            <label for="workingHours">Working Hours</label>
                                            <textarea class="form-control" id="workingHours" name="work_hours" placeholder="ex. Mon. - Fri.: 9:00 AM - 5:00 PM"
                                                rows="2" required></textarea>
                                        </div>


                                        <!-- Account Status -->
                                        <div class="form-group col-3">
                                            <label for="accountStatus">Account Status</label>
                                            <select id="accountStatus" class="form-control" name="account_status"
                                                required>
                                                <option value="" disabled selected>Choose...</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="{{ route('providers-list') }}"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                                <button type="submit" id="submit" name="submit"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
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

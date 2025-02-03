@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Create New Patient</h4>
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
                            <form method="POST" action="{{ route('patients-list') }}" enctype="multipart/form-data">
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
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Contact Information</h5>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group col-3">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber"
                                                name="contact_number" placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                            <small class="form-text text-muted font-italic">Enter valid email
                                                address.</small>
                                        </div>

                                        <!-- Emergency Contact Name -->
                                        {{-- <div class="form-group col-3">
                                            <label for="emergencyContactName">Emergency Contact Name</label>
                                            <input type="text" class="form-control" id="emergencyContactName"
                                                name="emergency_contact_name" placeholder="ex. Jane Doe" required>
                                        </div> --}}

                                        <!-- Emergency Contact Number -->
                                        {{-- <div class="form-group col-3">
                                            <label for="emergencyContactPhone">Emergency Contact Phone</label>
                                            <input type="text" class="form-control" id="emergencyContactPhone"
                                                name="emergency_contact_phone" placeholder="ex. (00)0-0000-0000" required>
                                        </div> --}}


                                    </div>

                                    <div class="row row mb-5 align-items-start justify-content-start">

                                        <div>
                                            <h5 class="mb-3 text-gray-800">Address</h5>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group col-3">
                                            <label for="streetAddress">Street Address</label>
                                            <input type="text" class="form-control" id="streetAddress"
                                                name="street_address" placeholder="ex. 123 Main St" required>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group col-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="ex. New York" required>
                                        </div>

                                        <!-- State -->
                                        <div class="form-group col-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="ex. NY" required>
                                        </div>

                                        <!-- Postal COde -->
                                        <div class="form-group col-3">
                                            <label for="postalCode">Postal Code</label>
                                            <input type="text" class="form-control" id="postalCode" name="postal_code"
                                                placeholder="ex. 10001" required>
                                        </div>

                                        <!-- Country -->
                                        {{-- <div class="form-group col-2">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                placeholder="ex. United State" required>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Medical Information</h5>
                                        </div>

                                        <!-- Medical History -->
                                        <div class="form-group col-5">
                                            <label for="medicalHistory">Medical History</label>
                                            <textarea class="form-control" id="medicalHistory" name="medical_history" placeholder="Any medical conditions?"
                                                required></textarea>
                                        </div>

                                        <!-- Allergies -->
                                        <div class="form-group col-5">
                                            <label for="allergies">Allergies</label>
                                            <textarea class="form-control" id="allergies" name="allergies" placeholder="List any allergies" required></textarea>
                                        </div>

                                        <!-- PCP -->
                                        <div class="form-group col-2">
                                            <label for="pcp">PCP</label>
                                            <input type="text" name="pcp" id="pcp" class="form-control">
                                        </div>

                                    </div> --}}

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Insurance Information</h5>
                                        </div>

                                        <!-- Insurance Provider -->
                                        <div class="form-group col-3">
                                            <label for="insuranceProvider">Insurance Provider</label>
                                            <input type="text" class="form-control" id="insuranceProvider"
                                                name="insurance_provider" placeholder="ex. Blue Cross" required>
                                        </div>

                                        <!-- Policy Number -->
                                        <div class="form-group col-3">
                                            <label for="policyNumber">Policy Number</label>
                                            <input type="text" class="form-control" id="policyNumber"
                                                name="policy_number" placeholder="ex. 12345XYZ" required>
                                            <small class="form-text text-muted font-italic">Enter valid policy
                                                number.</small>
                                        </div>

                                        <!-- SSN -->
                                        <div class="form-group col-3">
                                            <label for="ssn">SSN</label>
                                            <input type="text" name="ssn" id="ssn" class="form-control">
                                            <small class="form-text text-muted font-italic">Enter 9 digit number.</small>
                                        </div>
                                    </div>

                                    {{-- <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Password</h5>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group col-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>
                                    </div> --}}

                                    <div class="row align-items-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="/patients-list"
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
@endsection

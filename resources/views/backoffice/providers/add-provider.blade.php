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
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">

                                        <div>
                                            <h5 class="mb-3 text-gray-800">Contact Information</h5>
                                        </div>

                                        <!-- Fax -->
                                        <div class="form-group col-3">
                                            <label for="fax_number">Fax Number</label>
                                            <input type="text" id="fax_number" name="fax_number" class="form-control"
                                                pattern="\d{10}">
                                            <small class="form-text text-muted font-italic">Fax number should be exactly 10
                                                digits</small>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                            <small class="form-text text-muted font-italic">Enter valid email
                                                address.</small>
                                        </div>

                                        <!-- Contact Number -->
                                        <div class="form-group col-3">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber"
                                                name="contact_number" placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Emergency Contact Name -->
                                        {{-- <div class="form-group col-3">
                                            <label for="emergencyContactName">Emergency Contact Name</label>
                                            <input type="text" class="form-control" id="emergencyContactName"
                                                name="emergency_contact_name" placeholder="ex. Danilo" required>
                                        </div> --}}

                                        <!-- Emergency Contact Number -->
                                        {{-- <div class="form-group col-3">
                                            <label for="emergencyContactPhone">Emergency Contact Phone</label>
                                            <input type="text" class="form-control" id="emergencyContactPhone"
                                                name="emergency_contact_phone" placeholder="ex. (00)0-0000-0000" required>
                                        </div> --}}
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class=" mb-3 text-gray-800">Address</h5>
                                        </div>

                                        <!-- Street -->
                                        <div class="form-group col-3">
                                            <label for="street">Street Address</label>
                                            <input type="text" class="form-control" id="street" name="street"
                                                placeholder="ex. 142 J. Marzan St." required>
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
                                            <input type="text" class="form-control" id="postalCode" name="postal_code"
                                                placeholder="ex. 1008" required>
                                        </div>

                                        <!-- Country -->
                                        {{-- <div class="form-group col-3">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                placeholder="ex. Philippines" required>
                                        </div> --}}
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class=" mb-3 text-gray-800">Healthcare Information</h5>
                                        </div>

                                        <!-- Specialization -->
                                        <div class="form-group col-3">
                                            <label for="specialization">Specialty</label>
                                            <input type="text" class="form-control" id="specialization"
                                                name="specialization" placeholder="ex. Dermatology" required>
                                        </div>

                                        {{-- <!-- License Number -->
                                        <div class="form-group col-3">
                                            <label for="licenseNumber">License Number</label>
                                            <input type="text" class="form-control" id="licenseNumber"
                                                name="license_number" placeholder="ex. n089" required
                                                title="License Number should be exactly 9 digits">
                                        </div> --}}

                                        <!-- NPI -->
                                        {{-- <div class="form-group col-3">
                                            <label for="npi">NPI (National Provider Identifier)</label>
                                            <input type="text" id="npi" name="npi" class="form-control"
                                                required pattern="\d{10}" title="NPI should be exactly 10 digits"
                                                placeholder="NPI 10 digits">
                                        </div> --}}

                                        <!-- Facility Name Input (Autocomplete) -->
                                        <div class="form-group col-3" style="position: relative;">
                                            <label for="facilityName">Facility</label>
                                            <input type="text" class="form-control" id="facilityName"
                                                name="facility_name" placeholder="Start typing to search..." required
                                                autocomplete="off">
                                            <ul id="suggestions-list" class="list-group"
                                                style="display:none; position: absolute; width: 100%; z-index: 1; background-color: white; border: 1px solid #ddd;">
                                            </ul>
                                            <small class="form-text text-muted font-italic">Type or select
                                                facility.</small>
                                        </div>
                                    </div>

                                    {{-- <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Availability</h5>
                                        </div>

                                        <!-- Working Hours -->
                                        <div class="form-group col-6">
                                            <label for="workingHours">Working Hours</label>
                                            <textarea class="form-control" id="workingHours" name="work_hours" placeholder="ex. Mon. - Fri.: 9:00 AM - 5:00 PM"
                                                rows="2" required></textarea>
                                        </div>
                                    </div> --}}

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Account Setting</h5>
                                        </div>

                                        <!-- Account Status -->
                                        <div class="form-group col-3">
                                            <label for="accountStatus">Account Status</label>
                                            <select id="accountStatus" class="form-control" name="account_status"
                                                required>
                                                {{-- <option value="" disabled selected>Choose...</option> --}}
                                                <option value="Active" selected>Active</option>
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
    <script>
        document.getElementById('facilityName').addEventListener('input', function() {
            let query = this.value;

            if (query.length > 1) {
                // Perform an AJAX request to fetch facility suggestions
                fetch(`/search-facilities?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionsList = document.getElementById('suggestions-list');
                        suggestionsList.innerHTML = ''; // Clear existing suggestions

                        data.forEach(facility => {
                            let li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.textContent = facility.facility_name;
                            li.onclick = function() {
                                document.getElementById('facilityName').value = facility
                                    .facility_name;
                                suggestionsList.style.display = 'none'; // Hide suggestions
                            };
                            suggestionsList.appendChild(li);
                        });

                        suggestionsList.style.display = data.length ? 'block' :
                            'none'; // Show suggestions if any
                    });
            } else {
                document.getElementById('suggestions-list').style.display = 'none';
            }
        });
    </script>
@endsection

{{-- @extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Create New User</h4>
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
                            <form method="POST" action="{{ route('users-list') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                        </div>
                                        <!-- First Name -->
                                        <div class="form-group col-3">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                placeholder="ex. Calixto Francis" required>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group col-3">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                placeholder="ex. Mantal" required>
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

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group col-3">
                                            <label for="phoneNumber">Contact Number</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                                placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Full Address -->
                                        <div class="form-group col-9">
                                            <label for="address">Full Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="1"
                                                placeholder="ex. House Block and Lot No., Street, Subdivision/Village, City, Province" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">User Setting</h5>
                                        </div>

                                        <!-- Role -->
                                        <div class="form-group col-3">
                                            <label for="role">Role</label>
                                            <select id="role" class="form-control" name="role" required>
                                                <option value="" disabled selected>Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Facility Name Input (Autocomplete) -->
                                        <div class="form-group col-3">
                                            <label for="facilityName">Facility</label>
                                            <input type="text" class="form-control" name="facility_name"
                                                id="facilityName" autocomplete="off">
                                            <div id="suggestions" style="display:none;"></div>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group col-3">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status" required>
                                                <option selected value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group col-3">
                                            <label for="userName">Username</label>
                                            <input type="text" class="form-control" id="userName" name="userName"
                                                placeholder="ex. calixto_mantal">
                                        </div>

                                        <!-- Upload User Photo -->
                                        <div class="form-group col-3">
                                            <div class="mb-3">
                                                <label for="formFile">Upload Photo</label>
                                                <input class="form-control" type="file" name="photo" accept="image/*"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group col-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="ex. 8 character" required>
                                        </div>

                                        <!-- Confirm Password -->
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
@endsection --}}

@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Create New User</h4>
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
                            <form method="POST" action="{{ route('users-list') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Basic Information</h5>
                                        </div>
                                        <!-- First Name -->
                                        <div class="form-group col-3">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                placeholder="ex. Calixto Francis" required>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group col-3">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName"
                                                placeholder="ex. Mantal" required>
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

                                        <!-- Email -->
                                        <div class="form-group col-3">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com" required>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group col-3">
                                            <label for="phoneNumber">Contact Number</label>
                                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                                placeholder="ex. (00)0-0000-0000" required>
                                        </div>

                                        <!-- Full Address -->
                                        <div class="form-group col-9">
                                            <label for="address">Full Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="1"
                                                placeholder="ex. House Block and Lot No., Street, Subdivision/Village, City, Province" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">User Setting</h5>
                                        </div>

                                        <!-- Role -->
                                        <div class="form-group col-3">
                                            <label for="role">Role</label>
                                            <select id="role" class="form-control" name="role" required>
                                                <option value="" disabled selected>Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Facility Name Input (Autocomplete) -->
                                        <div class="form-group col-3" style="position: relative;">
                                            <label for="facilityName">Facility</label>
                                            <input type="text" class="form-control" name="facility_name"
                                                id="facilityName" autocomplete="off"
                                                placeholder="Start typing to search...">
                                            <ul id="suggestions-list" class="list-group"
                                                style="display:none; position: absolute; width: 100%; z-index: 1; background-color: white; border: 1px solid #ddd;">
                                            </ul>
                                        </div>



                                        <!-- Status -->
                                        <div class="form-group col-3">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status" required>
                                                <option selected value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group col-3">
                                            <label for="userName">Username</label>
                                            <input type="text" class="form-control" id="userName" name="userName"
                                                placeholder="ex. calixto_mantal">
                                        </div>

                                        <!-- Upload User Photo -->
                                        <div class="form-group col-3">
                                            <div class="mb-3">
                                                <label for="formFile">Upload Photo</label>
                                                <input class="form-control" type="file" name="photo" accept="image/*"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group col-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="ex. 8 character" required>
                                        </div>

                                        <!-- Confirm Password -->
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
        // Handle the input field for facility name
        document.getElementById('facilityName').addEventListener('input', function() {
            const query = this.value; // Capture the query as the user types
            const suggestionsList = document.getElementById('suggestions-list');

            if (!query) {
                suggestionsList.style.display = 'none'; // Hide the suggestions when input is empty
                return;
            }

            // Log the query being sent for debugging
            console.log('Query:', query);

            fetch(`/search-facilities?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Log the fetched data for debugging
                    console.log('Facilities:', data);

                    suggestionsList.innerHTML = ''; // Clear previous suggestions
                    if (data.length > 0) {
                        suggestionsList.style.display = 'block';
                        data.forEach(facility => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.textContent = facility.facility_name; // Display the facility name
                            listItem.addEventListener('click', () => {
                                document.getElementById('facilityName').value = facility
                                    .facility_name;
                                suggestionsList.style.display =
                                    'none'; // Hide suggestions on selection
                            });
                            suggestionsList.appendChild(listItem);
                        });
                    } else {
                        suggestionsList.style.display = 'none'; // Hide suggestions if no match found
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error); // Handle any errors
                });
        });


        // Close suggestions when clicking outside
        document.addEventListener('click', function(event) {
            const suggestionsList = document.getElementById('suggestions-list');
            const inputField = document.getElementById('facilityName');

            if (!inputField.contains(event.target) && !suggestionsList.contains(event.target)) {
                suggestionsList.style.display = 'none';
            }
        });

        // Format the phone number input
        document.getElementById('phoneNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection

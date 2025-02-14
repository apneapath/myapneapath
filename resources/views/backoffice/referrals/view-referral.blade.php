@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Order ID: {{ $referral->referral_code ?? 'N/A' }} </h4>
            </div>
            <a href="/referrals-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Order List
            </a>
        </div>

        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card shadow-2-strong" style="border-radius: 5px;">
                    <div class="card-body p-4 p-md-5">
                        <!-- Referral Information (Full width row) -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Order Information</h5>
                                <br>
                                <div class="row">

                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            <li><strong>Order Type</strong></li>
                                            <!-- Display the name or description of the order type -->
                                            <li>{{ $referral->orderType->name ?? 'N/A' }}</li>
                                        </ul>
                                    </div>

                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li><strong>Urgency</strong></li>
                                            <li>{{ $referral->urgency }}</li>
                                        </ul>
                                    </div>

                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li><strong>Date Created</strong></li>
                                            <li>{{ $referral->created_at }}</li>
                                        </ul>
                                    </div>

                                    <!-- Status Section -->
                                    {{-- <div class="col">
                                        <label for="status"><strong>Status</strong></label>
                                        <select id="status" name="status" class="form-control" required>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->name }}"
                                                    {{ $referral->status->name == $status->name ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    {{-- <div class="col">
                                        <label for="status"><strong>Status</strong></label>
                                        <select id="status" name="status" class="form-control text-light"
                                            style="{{ $statusesWithColors[$referral->status->name] ?? 'background-color: gray;' }}"
                                            required>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->name }}"
                                                    {{ $referral->status->name == $status->name ? 'selected' : '' }}
                                                    style="{{ $statusesWithColors[$status->name] ?? 'background-color: gray;' }}"
                                                    class="text-light">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}


                                    <div class="col">
                                        <label for="status"><strong>Status</strong></label>
                                        <select id="status" name="status" class="form-control text-light"
                                            style="{{ $statusesWithColors[$referral->status->name] ?? 'background-color: gray;' }}"
                                            required>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $referral->status->name == $status->name ? 'selected' : '' }}
                                                    style="{{ $statusesWithColors[$status->name] ?? 'background-color: gray;' }}"
                                                    class="text-light">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Debugging: Display the current status -->
                                    {{-- <p>Current Status: {{ $referral->status }}</p> --}}
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            <li><strong>Referring Provider</strong></li>
                                            <li>{{ $referral->referringProvider->facility_name }}</li>
                                        </ul>
                                    </div>

                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            <li><strong>Email</strong></li>
                                            <li><a title="Email {{ $referral->referringProvider->email }}"
                                                    href="mailto:{{ $referral->referringProvider->email }}">{{ $referral->referringProvider->email }}</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            <li><strong>Phone Number</strong></li>
                                            <li>{{ $referral->referringProvider->phone_number ?? 'N/A' }}</li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <hr>

                        <!-- Second Row: Referring Provider Information + Referred Provider Information -->
                        {{-- <div class="row mt-4">
                            <!-- Referring Provider Information (Full Width Row) -->
                            <div class="col-12">
                                <h5>Referring Provider</h5>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <p><strong>Name:</strong> {{ $referral->referringProvider->name }}</p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Role:</strong> {{ $referral->referringProvider->role ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Email:</strong>
                                            {{ $referral->referringProvider->email ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Third Row: Patient Information + Referred Provider Information -->
                        <div class="row mt-4">
                            <!-- Patient Information -->
                            <div class="col-md-6">
                                <h5>Patient Information</h5>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>First Name:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->first_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->last_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->gender }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->dob }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->contact_number }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->email }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->address }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Insurance Provider:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->insurance_provider ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Subscriber ID:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->subscriber_id ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Group Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->group_number ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Referred Provider Information -->
                            <div class="col-md-6">
                                <h5>Provider Information</h5>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Facility:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->facility_name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Provider:</td>
                                            <td class="text-end"><strong>{{ $referral->referredProvider->name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fax Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->fax_number }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->email }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->contact_number }}</strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Specialty:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->specialization }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Street Address:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->street }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->city }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>State:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->state }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Postal Code::</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->postal_code }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <!-- Fourth Row: Referral Notes Section + Attachments Section -->
                        <div class="row mt-4">
                            <!-- Referral Notes Section -->
                            <div class="col-md-6">
                                <h5>Referral Notes</h5>
                                <ul>
                                    @if ($referral->notes)
                                        <p>{{ $referral->notes }}</p>
                                    @else
                                        <p>No notes available.</p>
                                    @endif
                                </ul>
                                {{-- <textarea placeholder="Add a note..." class="form-control" rows="3"></textarea>
                                <button class="btn btn-sm btn-success mt-2">Add Note</button> --}}
                            </div>

                            <!-- Attachments Section -->
                            <div class="col-md-6">
                                <h5>Attachments</h5>
                                <ul>
                                    @if ($referral->attachments && $referral->attachments->count())
                                        <ul>
                                            @foreach ($referral->attachments as $attachment)
                                                <li>
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                        target="_blank">
                                                        {{ $attachment->filename }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No attachments available.</p>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <hr>

                        <!-- Actions Section -->
                        <div class="row align-items-start justify-content-between">
                            <div class="col-12 d-flex flex-row-reverse">
                                <div class="form-group">
                                    @if (auth()->user()->can('edit posts'))
                                        <a href="{{ route('edit-referral', $referral->referral_code) }}"
                                            class="btn btn-sm btn-secondary">Edit
                                            Referral</a>
                                    @endif
                                    <button type="submit" id="submit" name="submit"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-labelledby="statusUpdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusUpdateModalLabel">Status Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage">Referral status with the ID <strong id="referralCode"></strong> is updated
                        successfully!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var status = $(this).val();
                var referralId = "{{ $referral->id }}"; // Ensure this is the referral ID
                var referralCode = "{{ $referral->referral_code }}"; // Get the referral code

                // Construct the URL
                var url = "{{ route('referral.updateStatus', ['referral' => $referral->id]) }}";

                // Log the URL to the console
                console.log("Request URL: " + url);

                $.ajax({
                    url: url,
                    method: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token
                        status: status
                    },
                    success: function(response) {
                        // Update the modal content with referral code
                        $('#referralCode').text(referralCode);
                        $('#statusUpdateModal').modal('show'); // Show the modal on success
                    },
                    error: function(xhr) {
                        alert('Something went wrong!');
                        console.log(xhr.responseText); // Print the error response
                    }
                });
            });
        });
    </script>


@endsection

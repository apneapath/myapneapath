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

                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            @if ($referral->status_id == 5 || $referral->status_id == 6)
                                                <li><strong>Reason</strong></li>
                                                <!-- Check if status is 5 or 6, and display the reason if available -->
                                                <li>{{ $referral->status_reason ?? 'N/A' }}</li>
                                            @else
                                                {{-- <li>N/A</li> --}}
                                            @endif
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
                        <!-- Referral Details -->
                        <div class="row mt-4">
                            <h5>Comments</h5>
                            <div id="comments-section" class="p-3 rounded"
                                style="max-height: 300px; overflow-y: auto; background-color: white;">
                                <!-- Display existing comments -->
                                @foreach ($referral->comments as $index => $comment)
                                    <div class="comment mb-2"
                                        style="background-color: {{ $index % 2 == 0 ? '#f8f9fa' : '#e9ecef' }}; padding: 10px; border-radius: 8px;">
                                        <div class="row mb-2">
                                            <div class="d-flex align-items-start">
                                                <!-- User Photo -->
                                                <div class="me-3">
                                                    <img src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : asset('default-avatar.png') }}"
                                                        alt="{{ $comment->user->name }}'s Photo" class="rounded-circle"
                                                        style="width: 35px; height: 35px; object-fit: cover;">
                                                </div>
                                                <!-- Comment Text -->
                                                <div>
                                                    <strong>{{ $comment->user->name }}</strong> commented:
                                                    <p>{{ $comment->content }}</p>
                                                    <small class="text-muted">Posted on:
                                                        {{ $comment->created_at->format('M d, Y h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Form to add a new comment -->
                            <!-- comments/create.blade.php -->

                            <!-- Use the correct route name for the POST request -->
                            <form action="{{ route('referral.addComment', $referral->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    {{-- <label for="content">Comment:</label> --}}
                                    <textarea id="content" name="content" class="form-control mt-4" rows="2" placeholder="Write a comment..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Comment</button>
                            </form>


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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Status Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the status?
                    <div id="statusReasonDiv" class="mt-3" style="display: none;">
                        <label for="status_reason"><strong>Reason:</strong></label>
                        <!-- Insert Error message here -->
                        <div id="errorMessage" style="color: red; font-size: 14px;"></div>
                        <textarea id="status_reason" class="form-control" rows="4" placeholder="Enter reason..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-primary" id="confirmUpdate">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var statusId = $(this).val();

                // Show the reason field if the status is 5 or 6
                if (statusId == 5 || statusId == 6) {
                    $('#statusReasonDiv').show(); // Show reason input
                } else {
                    $('#statusReasonDiv').hide(); // Hide reason input
                    $('#status_reason').val(''); // Clear any previously entered reason
                }

                // Show the confirmation modal when status changes
                $('#confirmationModal').modal('show');

                // Clear any previous error message
                $('#errorMessage').text('');

                // If the user confirms the change, proceed with the update
                $('#confirmUpdate').click(function() {
                    var reason = $('#status_reason').val(); // Get the reason value (if any)

                    // Check if reason is required for status 5 or 6
                    if ((statusId == 5 || statusId == 6) && !reason) {
                        // Display error message in red inside the modal
                        $('#errorMessage').text('Please provide a reason before confirming.').css(
                            'color', 'red');
                        return; // Stop the form submission if reason is not provided
                    }

                    // Show the loading spinner before sending the request
                    $('#loadingSpinner').show();

                    // Send the AJAX request to update the status
                    $.ajax({
                        url: "{{ route('referral.updateStatus', ['referral' => $referral->id]) }}",
                        method: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: statusId,
                            status_reason: reason // Include the status_reason (if any)
                        },
                        success: function(response) {
                            // Refresh the page after status is updated
                            location.reload(); // Refresh the page
                        },
                        error: function(xhr) {
                            alert('Something went wrong!');
                            console.log(xhr.responseText); // Print the error response
                        }
                    });

                    // Close the confirmation modal after confirming
                    $('#confirmationModal').modal('hide');
                });

                // If the user cancels, do nothing (just close the modal)
                $('#confirmationModal').on('hidden.bs.modal', function() {
                    // Clear the reason input and any error message if modal is closed
                    $('#status_reason').val('');
                    $('#errorMessage').text('');
                });
            });


            $('#comment-form').submit(function(e) {
                e.preventDefault();

                var content = $('#content').val();

                $.ajax({
                    url: "{{ route('referral.addComment', $referral->id) }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: content,
                    },
                    success: function(response) {
                        $('#comments-section').append('<div class="comment"><strong>' + response
                            .user_name + '</strong> commented:<p>' + content + '</p></div>');
                        $('#content').val(''); // Clear the textarea
                    },
                    error: function(xhr) {
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>


@endsection

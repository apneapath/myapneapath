@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Referrals List</h4>
            </div>

            <!-- Check if the user has permission to create a new referral -->
            @if (auth()->user()->can('create posts'))
                <a href="/create-referral" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    Create New Referral
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('success-alert').style.display = 'none';
                }, 5000);
            </script>
        @endif

        <table id="referrals-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Referring Provider</th>
                    <th>Referred Provider</th>
                    <th>Reason</th>
                    <th>Urgency</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="referral-list"></tbody>
        </table>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this referral? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteReferralForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- External JS and DataTable Initialization -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            fetchReferrals();
        });

        function fetchReferrals() {
            $.ajax({
                url: '{{ route('referrals.index') }}', // Adjust the route for referrals
                method: 'GET',
                success: function(response) {
                    console.log(response); // Check the response structure
                    console.log(response); // Check the response structure
                    console.log('canEdit:', response.canEdit); // Check if canEdit is true or false
                    console.log('canView:', response.canView); // Check if canView is true or false
                    console.log('canDelete:', response.canDelete); // Check if canDelete is true or false

                    $('#referral-list').empty(); // Clear the current list

                    const {
                        canEdit,
                        canView,
                        canDelete,
                        referrals
                    } = response;

                    if (!Array.isArray(referrals)) {
                        console.error('Unexpected response format:', response);
                        alert('Error: Invalid response format.');
                        return;
                    }

                    referrals.forEach(function(referral) {
                        console.log(referral
                            .referring_provider); // Check if referring_provider is defined
                        console.log(referral
                            .referred_provider); // Check if referred_provider is defined

                        $('#referral-list').append(`
                            <tr>
                                <td>${referral.patient.first_name} ${referral.patient.last_name}</td>
                                <td>${referral.referring_provider ? referral.referring_provider.name : 'N/A'}</td>
                                <td>${referral.referred_provider ? referral.referred_provider.name : 'N/A'}</td>
                                <td>${referral.reason}</td>
                                <td>${referral.urgency}</td>
                                <td>${referral.status}</td>
                                <td>
                                    ${canEdit ? `<a title="Edit referral" href="/edit-referral/${referral.id}" class="btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-file-pen"></i></span></a>` : ''}
                                    ${canView ? `<a title="View referral details" href="/view-referral/${referral.id}" class="btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-eye"></i></span></a>` : ''}
                                    ${canDelete ? `<button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteReferralId(${referral.id});"><span style="color: Dodgerblue;"><i class="fa-solid fa-trash"></i></span></button>` : ''}
                                </td>
                            </tr>
                        `);
                    });

                    $('#referrals-table').DataTable();
                },



                error: function(xhr, status, error) {
                    console.error('AJAX error:', xhr.responseText);
                    alert('Error fetching referrals. Please check the console for details.');
                }
            });
        }

        function setDeleteReferralId(id) {
            const form = document.getElementById('deleteReferralForm');
            form.action = `/delete-referral/${id}`;
        }
    </script>
@endsection

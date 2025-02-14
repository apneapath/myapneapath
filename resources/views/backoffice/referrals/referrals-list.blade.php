@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Orders List</h4>
            </div>

            <!-- Check if the user has permission to create a new referral -->
            @if (auth()->user()->can('create posts'))
                <a href="/create-referral" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    Create New Order
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
                    <th>Order ID</th>
                    <th>Order Type</th>
                    <th>Patient Name</th>
                    {{-- <th>Referring Provider</th> --}}
                    <th>Referred Provider</th>
                    {{-- <th>Reason</th> --}}

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
                        let statusClass = '';
                        let statusText = referral.status ? referral.status.name : 'No Status';

                        // Apply color coding based on the status
                        switch (statusText) {
                            case 'Pending':
                                statusClass = 'badge-warning'; // Yellow
                                break;
                            case 'Scheduled':
                                statusClass = 'badge-info'; // Orange
                                break;
                            case 'Reviewed':
                                statusClass = 'badge-primary'; // Light Blue
                                break;
                            case 'Accepted':
                                statusClass = 'badge-success'; // Green
                                break;
                            case 'Not Accepted':
                                statusClass = 'badge-danger'; // Red
                                break;
                            case 'Patient Declined':
                                statusClass = 'badge-dark'; // Dark Red
                                break;
                            case 'Completed':
                                statusClass = 'badge-dark'; // Dark Green
                                break;
                            case 'Cancelled':
                                statusClass = 'badge-secondary'; // Gray
                                break;
                            default:
                                statusClass = 'badge-secondary'; // Default to Gray if unknown
                                break;
                        }

                        $('#referral-list').append(`
                    <tr>
                        <td>${referral.referral_code}</td>
                        <td>${referral.order_type ? referral.order_type.name : 'N/A'}</td>  <!-- Change to order type -->
                        <td>${referral.patient.first_name} ${referral.patient.last_name}</td>
                        <td>${referral.referred_provider ? referral.referred_provider.name : 'N/A'}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>
                            ${canView ? `<a title="View referral details" href="/view-referral/${referral.referral_code}" class="btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-eye"></i></span></a>` : ''}
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

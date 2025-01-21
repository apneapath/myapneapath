@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Facilities List</h4>
            </div>
            <!-- Check if the user has the 'create facilities' permission -->
            @if (auth()->user()->can('create posts'))
                <a href="/add-facility" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-plus-circle"></i>
                    Create New Facility
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

        <table id="facility-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Facility Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Facility Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="facility-list"></tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this facility? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteFacilityForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            fetchFacilities();
        });

        function fetchFacilities() {
            $.ajax({
                url: '{{ route('facilities.index') }}', // Adjust this route to match your correct route name
                method: 'GET',
                success: function(response) {
                    $('#facility-list').empty(); // Clear the current list

                    // Get permissions from response
                    const canEdit = response.canEdit;
                    const canView = response.canView;
                    const canDelete = response.canDelete;

                    response.facilities.forEach(function(facility) {
                        $('#facility-list').append(
                            `<tr>
                            <td>${facility.facility_name}</td>
                            <td>${facility.address}</td>
                            <td>${facility.phone_number}</td>
                            <td>${facility.email}</td>
                            <td>${facility.facility_type}</td>
                            <td>
                                ${canEdit ? `<a title="Edit" href="/edit-facility/${facility.id}" class="d-none d-sm-inline-block btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-file-pen"></i></span></a>` : ''}
                                ${canView ? `<a title="View" href="/view-facility/${facility.id}" class="d-none d-sm-inline-block btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-eye"></i></span></a>` : ''}
                                ${canDelete ? `<button title="Delete" type="button" class="d-none d-sm-inline-block btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteFacilityId(${facility.id});"><span style="color: Dodgerblue;"><i class="fa-solid fa-trash"></i></span></button>` : ''}
                            </td>
                        </tr>`
                        );
                    });

                    // Initialize DataTable after populating
                    $('#facility-table').DataTable();
                },
                error: function() {
                    alert('Error fetching facilities.');
                }
            });
        }

        function setDeleteFacilityId(id) {
            const form = document.getElementById('deleteFacilityForm');
            form.action = `/delete-facility/${id}`;
        }
    </script>
@endsection

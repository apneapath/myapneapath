@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Patients List</h4>
            </div>

            <!-- Check if the user has permission to create a new patient -->
            {{-- @if (auth()->user()->can('create patients'))
                <a href="{{ route('patients.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    Add Patient
                </a>
            @endif --}}
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

        <table id="patients-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patient-list"></tbody>
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
                    Are you sure you want to delete this patient? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deletePatientForm" action="" method="POST">
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
            fetchPatients();
        });

        function fetchPatients() {
            $.ajax({
                url: '{{ route('patients.index') }}', // Fetch the list of patients from your backend
                method: 'GET',
                success: function(response) {
                    $('#patient-list').empty(); // Clear the current list

                    // Get permissions from the response
                    const {
                        canEdit,
                        canView,
                        canDelete,
                        patients
                    } = response;

                    // Loop through the patients and append them to the table
                    patients.forEach(function(patient) {
                        $('#patient-list').append(`
                    <tr>
                        <td>${patient.first_name} ${patient.last_name}</td>
                        <td>${patient.contact_number}</td>
                        <td>${patient.dob}</td> <!-- dob is formatted in the backend -->
                        <td>${patient.address}</td>
                        <td>
                            ${canEdit ? `<a title="Edit patient details" href="/edit-patient/${patient.id}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa-solid fa-pen-to-square"></i></a>` : ''}
                            ${canView ? `<a title="View patient details" href="/view-patient/${patient.id}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-eye"></i></a>` : ''}
                            ${canDelete ? `<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeletePatientId(${patient.id});"><i class="fa-solid fa-trash"></i></button>` : ''}
                        </td>
                    </tr>
                `);
                    });

                    // Initialize DataTable after populating the table
                    $('#patients-table').DataTable();
                },
                error: function() {
                    alert('Error fetching patients.');
                }
            });
        }

        function setDeletePatientId(id) {
            const form = document.getElementById('deletePatientForm');
            form.action = `/delete-patient/${id}`;
        }
    </script>
@endsection

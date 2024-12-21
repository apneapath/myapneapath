@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Providers List</h4>
            </div>

            <!-- Check if the user has permission to create a new provider -->
            @if (auth()->user()->can('create posts'))
                <a href="/add-provider" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    Add Provider
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

        <table id="providers-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Specialization</th>
                    <th>Name</th>
                    <th>Clinic Name</th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="provider-list"></tbody>
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
                    Are you sure you want to delete this provider? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteProviderForm" action="" method="POST">
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
            fetchProviders();
        });

        function fetchProviders() {
            $.ajax({
                url: '{{ route('providers.index') }}', // Adjust the route for providers
                method: 'GET',
                success: function(response) {
                    $('#provider-list').empty(); // Clear the current list

                    // Get permissions and provider list from the response
                    const {
                        canEdit,
                        canView,
                        canDelete,
                        providers
                    } = response;

                    // Loop through the providers and append them to the table
                    providers.forEach(function(provider) {
                        $('#provider-list').append(`
                    <tr>
                        <td>${provider.specialization}</td> <!-- Add specialization here -->
                        <td>${provider.name}</td>
                        <td>${provider.clinic_name}</td>
                        <td>${provider.address}</td>
                        <td>${provider.contact_number}</td>
                        <td>${provider.account_status}</td>
                        <td>
                            ${canEdit ? `<a title="Edit provider details" href="/edit-provider/${provider.id}" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></a>` : ''}
                            ${canView ? `<a title="View provider details" href="/provider-dashboard/${provider.id}" class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i></a>` : ''}
                            ${canDelete ? `<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteProviderId(${provider.id});"><i class="fa-solid fa-trash"></i></button>` : ''}
                        </td>
                    </tr>
                `);
                    });

                    // Initialize DataTable after populating the table
                    $('#providers-table').DataTable();
                },
                error: function() {
                    alert('Error fetching providers.');
                }
            });
        }

        function setDeleteProviderId(id) {
            const form = document.getElementById('deleteProviderForm');
            form.action = `/delete-provider/${id}`;
        }
    </script>
@endsection

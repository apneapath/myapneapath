@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Users List</h4>
            </div>
            <!-- Check if the user has the 'create posts' permission -->
            @if (auth()->user()->can('create posts'))
                <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-user-plus"></i>
                    Create New User
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

        <table id="user-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Facility</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-list"></tbody>
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
                    Are you sure you want to delete this user? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteUserForm" action="" method="POST">
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
            fetchUsers();
        });

        function fetchUsers() {
            $.ajax({
                url: '{{ route('users.index') }}', // Adjust this route to match your correct route name
                method: 'GET',
                success: function(response) {
                    $('#user-list').empty(); // Clear the current list

                    // Get permissions from response
                    const canEdit = response.canEdit;
                    const canView = response.canView;
                    const canDelete = response.canDelete;

                    response.users.forEach(function(user) {
                        $('#user-list').append(
                            `<tr>
                                <td><img style="border-radius: 100%; width: 35px; height: 35px" src="${user.photo}" alt="${user.name}'s Photo" style="max-width: 33px; max-height: 33px;"> ${user.name}</td>
                                <td>${user.role}</td> <!-- Display roles -->
                                <td>${user.facility_name}</td>
                                <td>${user.email}</td>
                                <td>${user.status}</td>
                                <td>
                                    <!--${canEdit ? `<a title="Edit" href="/edit-user/${user.id}" class="d-none d-sm-inline-block btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-file-pen"></i></span></a>` : ''}-->
                                    ${canView ? `<a title="View" href="/view-user/${user.id}" class="d-none d-sm-inline-block btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-eye"></i></span></a>` : ''}
                                    ${canDelete ? `<button title="Delete" type="button" class="d-none d-sm-inline-block btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteUserId(${user.id});"><span style="color: Dodgerblue;"><i class="fa-solid fa-trash"></i></span></button>` : ''}
                                </td>
                            </tr>`
                        );
                    });

                    // Initialize DataTable after populating
                    $('#user-table').DataTable();
                },
                error: function() {
                    alert('Error fetching users.');
                }
            });
        }

        function setDeleteUserId(id) {
            const form = document.getElementById('deleteUserForm');
            form.action = `/delete-user/${id}`;
        }
    </script>
@endsection

@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
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

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Users List</h1>
            </div>
            <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-user-plus"></i>
                Create User</a>
        </div>

        <table id="user-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="user-list"></tbody>
        </table>
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
                url: '{{ route('users.index') }}',
                method: 'GET',
                success: function(users) {
                    $('#user-list').empty(); // Clear the current list
                    users.forEach(function(user) {
                        $('#user-list').append(
                            `<tr>
                        
                        <td><img src="${user.photo}" alt="${user.name}'s Photo" style="max-width: 33px; max-height: 33px;"> ${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>${user.status}</td>
                        <td>
                            <a title="Edit user profile" href="/edit-user/${user.id}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a title="View user profile" href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-regular fa-eye"></i></a>
                            <a title="Delete user profile" href="/delete-user" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fa-solid fa-trash"></i></a>   
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
    </script>
@endsection

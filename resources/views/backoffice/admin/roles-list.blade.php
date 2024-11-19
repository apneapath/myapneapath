@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Roles List</h4>
            <a href="{{ route('roles.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New
                Role</a>
        </div>

        <!-- Display success message if it exists -->
        @if (session('success'))
            <div id="successMessage" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge badge-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{-- <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}

                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                            onclick="return confirm('Are you sure you want to delete this role?')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Check if the success message exists
        window.onload = function() {
            var successMessage = document.getElementById("successMessage");

            // If the success message is present, hide it after 5 seconds
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        }
    </script>
@endsection

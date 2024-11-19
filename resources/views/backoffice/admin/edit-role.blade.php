@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Edit Role</h4>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="roleName">Role Name</label>
                                    <input type="text" id="roleName" name="name" class="form-control"
                                        value="{{ old('name', $role->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <select name="permissions[]" id="permissions" class="form-control" required>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group text-right">
                                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Back to Roles
                                        List</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Update Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

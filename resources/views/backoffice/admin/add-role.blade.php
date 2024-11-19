@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Create New Role</h4>
            <a href="{{ route('roles.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Back to
                Roles List</a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <select name="permissions[]" id="permissions" class="form-control">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create
                        Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection

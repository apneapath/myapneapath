@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container">
        <h1>Roles and Permissions</h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Role</a>

        <h2>Roles</h2>
        <ul>
            @foreach ($roles as $role)
                <li>
                    {{ $role->name }}
                    <a href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2>Permissions</h2>
        <ul>
            @foreach ($permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection

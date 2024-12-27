@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Create New Role</h4>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <select name="permissions[]" id="permissions" class="form-control" multiple="multiple">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('roles.index') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>

                                    <button type="submit"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Select2 Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 on the permissions select element
            $('#permissions').select2({
                placeholder: "Select permissions",
                width: '100%',
                allowClear: true
            });
        });
    </script>
@endsection

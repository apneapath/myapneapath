@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Update Order Type</h4>
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
                            <form action="{{ route('orderTypes.update', $orderType->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->

                                <div class="form-group">
                                    <label for="orderTypeName">Order Type Name</label>
                                    <input type="text" id="orderTypeName" name="name" class="form-control"
                                        value="{{ old('name', $orderType->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $orderType->description) }}</textarea>
                                </div>

                                <div class="form-group text-right">
                                    <a href="{{ route('orderTypes.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Update Order Type</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Select2 Scripts (optional, if you want to add Select2 for enhanced UI) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Apply Select2 if needed (e.g., for a select box)
            // $('#permissions-edit').select2({
            //     placeholder: "Select permissions",
            //     allowClear: true,
            //     width: '100%',
            // });
        });
    </script>
@endsection

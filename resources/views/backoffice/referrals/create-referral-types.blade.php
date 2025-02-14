@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Create New Order Type</h4>
            </div>
            <a href="/order-types" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Order Types List
            </a>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('orderTypes.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="row mb-5 align-items-start justify-content-start">
                                        <div>
                                            <h5 class="mb-3 text-gray-800">Order Information</h5>
                                        </div>

                                        <!-- Order Type Name -->
                                        <div class="form-group col-3">
                                            <label for="name">Order Type Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="e.g. Standard Order" required>
                                        </div>

                                        <!-- Order Type Description -->
                                        <div class="form-group col-3">
                                            <label for="description">Order Type Description</label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                id="description" name="description" placeholder="e.g. A standard order type"
                                                value="{{ old('description') }}">
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row align-items-start justify-content-between">
                                        <div class="col-12 d-flex flex-row-reverse">
                                            <div class="form-group">
                                                <a href="/order-types"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                                <button type="submit"
                                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

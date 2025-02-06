@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Order Types List</h4>
            </div>
            <!-- Check if the user has the 'create order types' permission -->
            @if (auth()->user()->can('create posts'))
                <a href="{{ route('orderTypes.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fa-solid fa-plus-circle"></i>
                    Create New Order Type
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

        <table id="order-type-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>Order Type Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="order-type-list"></tbody>
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
                    Are you sure you want to delete this order type? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteOrderTypeForm" action="" method="POST">
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
            fetchOrderTypes();
        });

        function fetchOrderTypes() {
            $.ajax({
                url: '{{ route('orderTypes.index') }}', // Adjust this route to match your correct route name
                method: 'GET',
                success: function(response) {
                    $('#order-type-list').empty(); // Clear the current list

                    // Get permissions from response
                    const canEdit = response.canEdit;
                    const canDelete = response.canDelete;

                    response.orderTypes.forEach(function(orderType) {
                        $('#order-type-list').append(
                            `<tr>
                            <td>${orderType.name}</td>
                            <td>${orderType.description || 'No description available'}</td>
                            <td>
                                ${canEdit ? `<a title="Edit" href="/orderTypes/${orderType.id}/edit" class="d-none d-sm-inline-block btn btn-sm"><span style="color: Dodgerblue;"><i class="fa-solid fa-file-pen"></i></span></a>` : ''}
                                ${canDelete ? `<button title="Delete" type="button" class="d-none d-sm-inline-block btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteOrderTypeId(${orderType.id});"><span style="color: Dodgerblue;"><i class="fa-solid fa-trash"></i></span></button>` : ''}
                            </td>
                        </tr>`
                        );
                    });

                    // Initialize DataTable after populating
                    $('#order-type-table').DataTable();
                },
                error: function() {
                    alert('Error fetching order types.');
                }
            });
        }

        function setDeleteOrderTypeId(id) {
            const form = document.getElementById('deleteOrderTypeForm');
            form.action = `/orderTypes/${id}`;
        }
    </script>
@endsection

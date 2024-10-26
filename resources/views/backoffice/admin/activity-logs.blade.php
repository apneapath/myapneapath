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
                <h4 class=" mb-0 text-gray-800">Activity Logs</h4>
            </div>
        </div>

        <table id="activity-log-table" class="row-border stripe hover">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Action</th>
                    <th>Action Detail</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody id="activity-log-list">
                @if ($logs->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No activity logs available.</td>
                    </tr>
                @else
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->user_id }}</td>
                            <td>{{ $log->user_name }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{!! $log->action_detail !!}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#activity-log-table').DataTable();
        });
    </script>
@endsection

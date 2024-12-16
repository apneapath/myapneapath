@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class=" mb-0 text-gray-800">Patient Dashboard</h4>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Patient Details -->
                <h5 class="text-primary">Patient Details</h5>
                <div class="row">
                    <div class="col-6">
                        <strong>Name:</strong> {{ $patient->first_name }} {{ $patient->last_name }}<br>
                        <strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($patient->dob)->format('d M, Y') }}<br>
                        <strong>Gender:</strong> {{ $patient->gender }}<br>
                        <strong>Contact Number:</strong> {{ $patient->contact_number }}<br>
                        <strong>Email:</strong> {{ $patient->email }}<br>
                    </div>
                    <div class="col-6">
                        <strong>Street Address:</strong> {{ $patient->street_address }}<br>
                        <strong>City:</strong> {{ $patient->city }}<br>
                        <strong>State:</strong> {{ $patient->state }}<br>
                        <strong>Postal Code:</strong> {{ $patient->postal_code }}<br>
                        <strong>Country:</strong> {{ $patient->country }}<br>
                    </div>
                </div>
                <hr>

                <!-- Emergency Contact -->
                <h5 class="text-primary">Emergency Contact</h5>
                <p><strong>Name:</strong> {{ $patient->emergency_contact_name }}</p>
                <p><strong>Phone:</strong> {{ $patient->emergency_contact_phone }}</p>
                <hr>

                <!-- Referral History -->
                <h5 class="text-primary">Referral History</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Referral ID</th>
                            <th>Referral Date</th>
                            <th>Doctor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient->referrals as $referral)
                            <tr>
                                <td>{{ $referral->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($referral->referral_date)->format('d M, Y') }}</td>
                                <td>{{ $referral->doctor->name }}</td>
                                <td>{{ $referral->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>

                <div class="form-group text-right">
                    <a href="{{ route('patients-list') }}" class="btn btn-secondary">Back to Patient List</a>
                </div>
            </div>
        </div>
    </div>
@endsection

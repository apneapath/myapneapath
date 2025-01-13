@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Referral Details</h4>
        </div>

        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="card shadow-2-strong" style="border-radius: 5px;">
                    <div class="card-body p-4 p-md-5">
                        <!-- First Row -->
                        <div class="row">
                            <!-- Referral Information (Column 1) -->
                            <div class="col-md-6">
                                <h5>Referral Information</h5>
                                <p><strong>Reason for Referral:</strong> {{ $referral->reason }}</p>
                                <p><strong>Urgency:</strong> {{ $referral->urgency }}</p>
                                <p><strong>Status:</strong> {{ $referral->status }}</p>
                                <p><strong>Created At:</strong> {{ $referral->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $referral->updated_at }}</p>
                            </div>

                            <!-- Referring Provider (Column 2) -->
                            <div class="col-md-6">
                                <h5>Referring Provider</h5>
                                <p><strong>Name:</strong> {{ $referral->referringProvider->name }}</p>
                                <p><strong>Role:</strong> {{ $referral->referringProvider->role ?? 'N/A' }}</p>
                                <p><strong>Contact:</strong> {{ $referral->referringProvider->contact_number ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row mt-4">
                            <!-- Patient Information (Column 1) -->
                            <div class="col-md-6">
                                <h5>Patient Information</h5>
                                <p><strong>Name:</strong> {{ $referral->patient->first_name }}
                                    {{ $referral->patient->last_name }}</p>
                                <p><strong>Gender:</strong> {{ $referral->patient->gender }}</p>
                                <p><strong>Date of Birth:</strong> {{ $referral->patient->dob }}</p>
                                <p><strong>Contact:</strong> {{ $referral->patient->contact_number ?? 'N/A' }}</p>
                            </div>

                            <!-- Referred Provider (Column 2) -->
                            <div class="col-md-6">
                                <h5>Referred Provider</h5>
                                <p><strong>Name:</strong> {{ $referral->referredProvider->name ?? 'N/A' }}</p>
                                <p><strong>Role:</strong> {{ $referral->referredProvider->role ?? 'N/A' }}</p>
                                <p><strong>Contact:</strong> {{ $referral->referredProvider->contact_number ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Third Row -->
                        <div class="row mt-4">
                            <!-- Referral Notes (Column 1) -->
                            <div class="col-md-6">
                                <h5>Referral Notes</h5>
                                @if ($referral->notes)
                                    <p>{{ $referral->notes }}</p>
                                @else
                                    <p>No notes available.</p>
                                @endif
                                <textarea placeholder="Add a note..." class="form-control" rows="3"></textarea>
                                <button class="btn btn-sm btn-success mt-2">Add Note</button>
                            </div>

                            <!-- Attachments (Column 2) -->
                            <div class="col-md-6">
                                <h5>Attachments</h5>
                                @if ($referral->attachments && $referral->attachments->count())
                                    <ul>
                                        @foreach ($referral->attachments as $attachment)
                                            <li>
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                                                    {{ $attachment->filename }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No attachments available.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Actions Section (if needed) -->
                        <div class="mt-4">
                            <a href="{{ route('referrals-list') }}" class="btn btn-sm btn-secondary">Back to Referrals
                                List</a>
                            @if (auth()->user()->can('edit posts'))
                                <a href="{{ route('edit-referral', $referral->id) }}" class="btn btn-sm btn-primary">Edit
                                    Referral</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

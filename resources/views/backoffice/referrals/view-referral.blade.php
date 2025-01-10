@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800">Referral Details</h4>
        </div>

        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card shadow-2-strong" style="border-radius: 5px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <!-- Patient Information -->
                            <div class="col-md-6">
                                <h5>Patient Information</h5>
                                <p><strong>Name:</strong> {{ $referral->patient->first_name }}
                                    {{ $referral->patient->last_name }}</p>
                                <p><strong>Gender:</strong> {{ $referral->patient->gender }}</p>
                                <p><strong>Date of Birth:</strong> {{ $referral->patient->dob }}</p>
                                <p><strong>Contact:</strong> {{ $referral->patient->contact_number ?? 'N/A' }}</p>
                            </div>

                            <!-- Referral Details -->
                            <div class="col-md-6">
                                <h5>Referral Information</h5>
                                <p><strong>Reason for Referral:</strong> {{ $referral->reason }}</p>
                                <p><strong>Urgency:</strong> {{ $referral->urgency }}</p>
                                <p><strong>Status:</strong> {{ $referral->status }}</p>
                                <p><strong>Created At:</strong> {{ $referral->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $referral->updated_at }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Referring Provider Information -->
                            <div class="col-md-6">
                                <h5>Referring Provider</h5>
                                <p><strong>Name:</strong> {{ $referral->referringProvider->name }}</p>
                                <p><strong>Role:</strong> {{ $referral->referringProvider->role ?? 'N/A' }}</p>
                                <p><strong>Contact:</strong> {{ $referral->referringProvider->contact_number ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Referred Provider Information -->
                            <div class="col-md-6">
                                <h5>Referred Provider</h5>
                                <p><strong>Name:</strong> {{ $referral->referredProvider->name }}</p>
                                <p><strong>Role:</strong> {{ $referral->referredProvider->role ?? 'N/A' }}</p>
                                <p><strong>Contact:</strong> {{ $referral->referredProvider->contact_number ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Actions Section -->
                        {{-- <div class="mt-4">
                            <h5>Actions</h5>
                            <a href="{{ route('edit-referral', $referral->id) }}" class="btn btn-sm btn-primary">Edit
                                Referral</a>
                            <a href="{{ route('delete-referral', $referral->id) }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this referral?')">Delete
                                Referral</a>
                        </div> --}}

                        <!-- Notes Section -->
                        {{-- <div class="mt-4">
                            <h5>Referral Notes</h5>
                            <ul>
                                @foreach ($referral->notes as $note)
                                    <li><strong>{{ $note->created_at }}:</strong> {{ $note->content }}</li>
                                @endforeach
                            </ul>
                            <textarea placeholder="Add a note..." class="form-control" rows="3"></textarea>
                            <button class="btn btn-sm btn-success mt-2">Add Note</button>
                        </div> --}}

                        <!-- Attachments Section -->
                        {{-- <div class="mt-4">
                            <h5>Attachments</h5>
                            <ul>
                                @foreach ($referral->attachments as $attachment)
                                    <li><a href="{{ asset('storage/' . $attachment->file_path) }}"
                                            download>{{ $attachment->filename }}</a></li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

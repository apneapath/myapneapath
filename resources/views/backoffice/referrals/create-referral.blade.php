@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Create New Referral</h4>
            </div>
            {{-- <a href="/referral-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View All Referral List
            </a> --}}
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <!-- Form to add new referral -->
                            <form action="{{ route('referrals-list') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="patient_id"><strong>Patient</strong></label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="referred_provider_id"><strong>Referred Provider</strong></label>
                                    <select name="referred_provider_id" id="referred_provider_id" class="form-control"
                                        required>
                                        <option value="">Select Provider</option>
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="reason"><strong>Reason for Referral</strong></label>
                                    <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="urgency"><strong>Urgency</strong></label>
                                    <select name="urgency" id="urgency" class="form-control" required>
                                        <option value="routine">Routine</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="notes"><strong>Referral Notes</strong></label>
                                    <textarea id="notes" name="notes" class="form-control" placeholder="Add any notes for the referral..."
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="attachments"><strong>Upload Attachments</strong></label>
                                    <input type="file" id="attachments" name="attachments[]" class="form-control"
                                        multiple>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Referral</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

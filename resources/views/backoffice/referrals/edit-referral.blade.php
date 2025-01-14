@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container">
        <h2>Edit Referral</h2>

        <form action="{{ route('update-referral', $referral->referral_code) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') <!-- Using POST method for form submission -->

            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select name="patient_id" id="patient_id" class="form-control" required>
                    <option value="">Select Patient</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $referral->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="referred_provider_id">Referred Provider</label>
                <select name="referred_provider_id" id="referred_provider_id" class="form-control" required>
                    <option value="">Select Provider</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}"
                            {{ $referral->referred_provider_id == $provider->id ? 'selected' : '' }}>
                            {{ $provider->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Referral</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ old('reason', $referral->reason) }}</textarea>
            </div>

            <div class="form-group">
                <label for="urgency">Urgency</label>
                <select name="urgency" id="urgency" class="form-control" required>
                    <option value="routine" {{ $referral->urgency == 'routine' ? 'selected' : '' }}>Routine</option>
                    <option value="urgent" {{ $referral->urgency == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control"
                    value="{{ old('status', $referral->status) }}" required>
            </div>

            <div class="form-group">
                <label for="notes">Referral Notes</label>
                <textarea id="notes" name="notes" class="form-control" placeholder="Add any notes for the referral..."
                    rows="3">{{ old('notes', $referral->notes) }}</textarea>
            </div>

            <div class="form-group">
                <label for="attachments">Upload Attachments</label>
                <input type="file" id="attachments" name="attachments[]" class="form-control" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection

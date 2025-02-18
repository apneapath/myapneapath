@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container">
        <h2>Edit Referral</h2>

        <form action="{{ route('update-referral', $referral->referral_code) }}" method="POST" enctype="multipart/form-data"
            id="editReferralForm">
            @csrf
            @method('POST') <!-- Using POST method for form submission -->

            <!-- Order Type Dropdown -->
            <div class="form-group">
                <label for="order_type_id">Order Type</label>
                <select name="order_type_id" id="order_type_id" class="form-control" required>
                    <option value="">Select Order Type</option>
                    @foreach ($orderTypes as $orderType)
                        <option value="{{ $orderType->id }}"
                            {{ $referral->order_type_id == $orderType->id ? 'selected' : '' }}>
                            {{ $orderType->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Patient Dropdown -->
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

            <!-- Referred Provider Dropdown -->
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

            <!-- Reason for Referral -->
            {{-- <div class="form-group">
                <label for="reason">Reason for Referral</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required>{{ old('reason', $referral->reason) }}</textarea>
            </div> --}}

            <!-- Urgency Dropdown -->
            <div class="form-group">
                <label for="urgency">Urgency</label>
                <select name="urgency" id="urgency" class="form-control" required>
                    <option value="routine" {{ $referral->urgency == 'routine' ? 'selected' : '' }}>Routine</option>
                    <option value="urgent" {{ $referral->urgency == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>

            <!-- Referral Notes -->
            <div class="form-group">
                <label for="notes">Referral Notes</label>
                <textarea id="notes" name="notes" class="form-control" placeholder="Add any notes for the referral..."
                    rows="3">{{ old('notes', $referral->notes) }}</textarea>
            </div>

            <!-- File Attachments -->
            <div class="form-group">
                <label for="attachments">Upload Attachments</label>
                <input type="file" id="attachments" name="attachments[]" class="form-control" multiple>
            </div>

            <div class="form-group">
                <!-- Cancel Button -->
                <a href="{{ route('view-referral', $referral->referral_code) }}"
                    class="btn btn-sm btn-secondary">Cancel</a>
                <!-- Save Changes Button -->
                <button type="submit" class="btn btn-sm btn-primary" id="saveButton" disabled>Save Changes</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("editReferralForm");
            const saveButton = document.getElementById("saveButton");

            let formData = new FormData(form); // Get the initial form data

            // Monitor any form input for changes
            form.addEventListener("input", function() {
                let hasChanges = false;

                // Check if any field has changed
                form.querySelectorAll("input, select, textarea").forEach(function(input) {
                    // Exclude the submit button
                    if (input.type !== "submit" && input.value !== formData.get(input.name)) {
                        hasChanges = true;
                    }
                });

                // Enable or disable the Save button based on whether there are changes
                saveButton.disabled = !hasChanges;
            });
        });
    </script>
@endsection

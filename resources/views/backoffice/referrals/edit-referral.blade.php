@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class=" mb-0 text-gray-800">Edit Referral</h4>
            </div>
        </div>

        <div>
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 5px;">
                        <div class="card-body p-4 p-md-5">
                            <!-- Edit Referral Form -->
                            <form id="editReferralForm" action="{{ route('update-referral', $referral->referral_code) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST') <!-- Using POST method for form submission -->

                                <!-- Order Type Dropdown -->
                                <div class="form-group">
                                    <label for="order_type_id"><strong>Order Type</strong></label>
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
                                    <label for="patient_id"><strong>Patient</strong></label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}"
                                                {{ $referral->patient_id == $patient->id ? 'selected' : '' }}>
                                                {{ $patient->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Referred Provider Dropdown -->
                                <div class="form-group">
                                    <label for="referred_provider_id"><strong>Referred Provider</strong></label>
                                    <select name="referred_provider_id" id="referred_provider_id" class="form-control"
                                        required>
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
                                    <label for="urgency"><strong>Urgency</strong></label>
                                    <select name="urgency" id="urgency" class="form-control" required>
                                        <option value="routine" {{ $referral->urgency == 'routine' ? 'selected' : '' }}>
                                            Routine</option>
                                        <option value="urgent" {{ $referral->urgency == 'urgent' ? 'selected' : '' }}>
                                            Urgent</option>
                                    </select>
                                </div>

                                <!-- Referral Notes -->
                                <div class="form-group">
                                    <label for="notes"><strong>Referral Notes</strong></label>
                                    <textarea id="notes" name="notes" class="form-control" placeholder="Add any notes for the referral..."
                                        rows="3">{{ old('notes', $referral->notes) }}</textarea>
                                </div>

                                <!-- File Attachments -->
                                <div class="form-group">
                                    <label for="attachments"><strong>Upload Attachments</strong></label>
                                    <input type="file" id="attachments" name="attachments[]" class="form-control"
                                        multiple>
                                </div>

                                <div class="form-group">
                                    <!-- Cancel Button -->
                                    <a href="{{ route('view-referral', $referral->referral_code) }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cancel</a>
                                    <!-- Submit Button -->
                                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        id="saveButton" disabled>Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("editReferralForm");
            const saveButton = document.getElementById("saveButton");

            // Store the initial form data as an object
            let originalData = {};
            form.querySelectorAll("input, select, textarea").forEach(function(input) {
                originalData[input.name] = input.value;
            });

            // Monitor any form input for changes
            form.addEventListener("input", function() {
                let hasChanges = false;

                // Check if any field has changed from the original value
                form.querySelectorAll("input, select, textarea").forEach(function(input) {
                    if (input.value !== originalData[input.name]) {
                        hasChanges = true;
                    }
                });

                // Enable or disable the Save button based on whether there are changes
                saveButton.disabled = !hasChanges;
            });
        });
    </script>
@endsection

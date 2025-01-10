<!-- resources/views/referrals/create.blade.php -->

@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container">
        <h2>Create Referral</h2>

        <form action="{{ route('referrals-list') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select name="patient_id" id="patient_id" class="form-control" required>
                    <option value="">Select Patient</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="referred_provider_id">Referred Provider</label>
                <select name="referred_provider_id" id="referred_provider_id" class="form-control" required>
                    <option value="">Select Provider</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Referral</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="urgency">Urgency</label>
                <select name="urgency" id="urgency" class="form-control" required>
                    <option value="routine">Routine</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Referral</button>
        </form>
    </div>
@endsection

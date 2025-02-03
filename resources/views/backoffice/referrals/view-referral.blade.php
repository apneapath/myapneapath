@extends('layouts.backoffice.super-admin-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-0 text-gray-800">Order ID: {{ $referral->referral_code ?? 'N/A' }} </h4>
            </div>
            <a href="/referrals-list" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-list"></i> View Order List
            </a>
        </div>

        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card shadow-2-strong" style="border-radius: 5px;">
                    <div class="card-body p-4 p-md-5">
                        <!-- Referral Information (Full width row) -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Order Information</h5>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <ul class="list-unstyled">
                                            <li><strong>Reason</strong></li>
                                            <li>{{ $referral->reason }}</li>
                                        </ul>
                                    </div>

                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li><strong>Urgency</strong></li>
                                            <li>{{ $referral->urgency }}</li>
                                        </ul>
                                    </div>

                                    <div class="col">
                                        <ul class="list-unstyled">
                                            <li><strong>Date Created</strong></li>
                                            <li>{{ $referral->created_at }}</li>
                                        </ul>
                                    </div>

                                    <div class="col">
                                        <label for="role"><strong>Status</strong></label>
                                        <select id="role" class="form-control" name="role" required>
                                            <option width="20px" value="" disabled selected><span
                                                    class="badge badge-warning">{{ $referral->status }}</span></option>
                                            {{-- @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach --}}

                                            <option>Scheduled</option>
                                            <option>Reviewed</option>
                                            <option>Accepted</option>
                                            <option>Not Accepted</option>
                                            <option>Patient Declined</option>
                                            <option>Completed</option>
                                            <option>Cancelled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <ul class="list-unstyled">
                                            <li><strong>Referring Provider</strong></li>
                                            <li>{{ $referral->referringProvider->facility_name }}</li>
                                        </ul>
                                    </div>
                                    {{-- <div class="col">
                                        <ul class="list-unstyled">
                                            <li><strong>Created By</strong></li>
                                            <li>{{ $referral->referringProvider->role ?? 'N/A' }}</li>
                                        </ul>
                                    </div> --}}


                                    <div class="col-3">
                                        <ul class="list-unstyled">
                                            <li><strong>Email</strong></li>
                                            <li><a title="Email {{ $referral->referringProvider->email }}"
                                                    href="mailto:{{ $referral->referringProvider->email }}">{{ $referral->referringProvider->email }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5">
                                        <ul class="list-unstyled">
                                            <li><strong>Phone Number</strong></li>
                                            <li>{{ $referral->referringProvider->phone_number ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <!-- Second Row: Referring Provider Information + Referred Provider Information -->
                        {{-- <div class="row mt-4">
                            <!-- Referring Provider Information (Full Width Row) -->
                            <div class="col-12">
                                <h5>Referring Provider</h5>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <p><strong>Name:</strong> {{ $referral->referringProvider->name }}</p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Role:</strong> {{ $referral->referringProvider->role ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col">
                                        <p><strong>Email:</strong>
                                            {{ $referral->referringProvider->email ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Third Row: Patient Information + Referred Provider Information -->
                        <div class="row mt-4">
                            <!-- Patient Information -->
                            <div class="col-md-6">
                                <h5>Patient Information</h5>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>First Name:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->first_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->last_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->gender }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->dob }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->contact_number }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="text-end"><strong>{{ $referral->patient->email }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->address }}</strong>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Medical History:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->medical_history ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Allergies:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->allergies ?? 'N/A' }}</strong>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>Insurance Provider:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->insurance_provider ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Policy Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->policy_number ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Social Security Number (SSN):</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->ssn ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td>Emergency Contact Name:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->emergency_contact_name ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Emergency Contact Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->patient->emergency_contact_phone ?? 'N/A' }}</strong>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>




                            <!-- Referred Provider Information -->
                            <div class="col-md-6">
                                <h5>Provider Information</h5>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Facility:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->facility_name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Provider:</td>
                                            <td class="text-end"><strong>{{ $referral->referredProvider->name }}</strong>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Role:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->role ?? 'N/A' }}</strong>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>Fax Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->fax_number }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->email }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->contact_number }}</strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Specialty:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->specialization }}</strong>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>License Number:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->license_number ?? 'N/A' }}</strong>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>Street Address:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->street }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->city }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>State:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->state }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Postal Code::</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->postal_code }}</strong>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Working Hours:</td>
                                            <td class="text-end">
                                                <strong>{{ $referral->referredProvider->work_hours }}</strong>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <hr>
                        <!-- Fourth Row: Referral Notes Section + Attachments Section -->
                        <div class="row mt-4">
                            <!-- Referral Notes Section -->
                            <div class="col-md-6">
                                <h5>Referral Notes</h5>
                                <ul>
                                    @if ($referral->notes)
                                        <p>{{ $referral->notes }}</p>
                                    @else
                                        <p>No notes available.</p>
                                    @endif
                                </ul>
                                {{-- <textarea placeholder="Add a note..." class="form-control" rows="3"></textarea>
                                <button class="btn btn-sm btn-success mt-2">Add Note</button> --}}
                            </div>

                            <!-- Attachments Section -->
                            <div class="col-md-6">
                                <h5>Attachments</h5>
                                <ul>
                                    @if ($referral->attachments && $referral->attachments->count())
                                        <ul>
                                            @foreach ($referral->attachments as $attachment)
                                                <li>
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                        target="_blank">
                                                        {{ $attachment->filename }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No attachments available.</p>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <hr>

                        <!-- Actions Section -->
                        <div class="row align-items-start justify-content-between">
                            <div class="col-12 d-flex flex-row-reverse">
                                <div class="form-group">
                                    @if (auth()->user()->can('edit posts'))
                                        <a href="{{ route('edit-referral', $referral->referral_code) }}"
                                            class="btn btn-sm btn-secondary">Edit
                                            Referral</a>
                                    @endif
                                    <button type="submit" id="submit" name="submit"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

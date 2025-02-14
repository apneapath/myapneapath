<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  // Ensure you're importing the correct Controller class
use App\Models\Referral;
use App\Models\Attachment;  // Import the Attachment model
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Provider;
use App\Models\OrderType;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;  // <-- Add this import

class ReferralController extends Controller
{
    // public function __construct()
    // {
    //     // Only allow access to this feature for providers or admins
    //     $this->middleware(['auth', 'role:provider|admin']);
    // }

    // public function index()
    // {
    //     // Get all referrals with eager loading for patient, providers, and status
    //     $referrals = Referral::with(['patient', 'referringProvider', 'referredProvider', 'status'])
    //         ->orderBy('created_at', 'desc')  // Sorting by created_at (most recent first)
    //         ->get();

    //     // Log each referral with referring and referred provider
    //     \Log::info('Referrals:', $referrals->toArray());
    //     $referrals->each(function ($referral) {
    //         \Log::info('Referral', [
    //             'Referring Provider' => $referral->referringProvider,
    //             'Referred Provider' => $referral->referredProvider,
    //             'Status' => $referral->status // Log the status too
    //         ]);
    //     });

    //     // Check permissions for edit, view, and delete
    //     $canEdit = auth()->user()->can('edit posts');
    //     $canView = auth()->user()->can('view posts');
    //     $canDelete = auth()->user()->can('delete posts');

    //     // Return the response with the ordered referrals and other data
    //     return response()->json([
    //         'canEdit' => $canEdit,
    //         'canView' => $canView,
    //         'canDelete' => $canDelete,
    //         'referrals' => $referrals
    //     ]);
    // }


    public function index()
    {
        // Get all referrals with eager loading for patient, providers, status, and order type
        $referrals = Referral::with(['patient', 'referringProvider', 'referredProvider', 'status', 'orderType'])
            ->orderBy('created_at', 'desc')  // Sorting by created_at (most recent first)
            ->get();

        // Log each referral with referring and referred provider
        \Log::info('Referrals:', $referrals->toArray());
        $referrals->each(function ($referral) {
            \Log::info('Referral', [
                'Referring Provider' => $referral->referringProvider,
                'Referred Provider' => $referral->referredProvider,
                'Status' => $referral->status, // Log the status too
                'Order Type' => $referral->orderType // Log the order type
            ]);
        });

        // Check permissions for edit, view, and delete
        $canEdit = auth()->user()->can('edit posts');
        $canView = auth()->user()->can('view posts');
        $canDelete = auth()->user()->can('delete posts');

        // Return the response with the ordered referrals and other data
        return response()->json([
            'canEdit' => $canEdit,
            'canView' => $canView,
            'canDelete' => $canDelete,
            'referrals' => $referrals
        ]);
    }




    // Show the referral creation form
    public function showForm()
    {
        // Get all patients
        $patients = Patient::all();

        // Get all providers
        $providers = Provider::all();

        // Get all order types
        $orderTypes = OrderType::all(); // Fetch all order types

        // Pass patients, providers, and order types to the view
        return view('backoffice.referrals.create-referral', compact('patients', 'providers', 'orderTypes'));
    }

    public function add(Request $request)
    {
        // Add 'order_type_id' to the validation rules
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referred_provider_id' => 'required|exists:providers,id', // Ensure referred_provider_id is valid
            // 'reason' => 'required|string',
            'urgency' => 'required|in:routine,urgent',
            'notes' => 'nullable|string',  // Make sure notes is nullable and validated
            'order_type_id' => 'required|exists:order_types,id', // Validate that order_type_id exists in order_types table
            'attachments' => 'nullable|array', // Ensure attachments are an array
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048' // Validate file types and sizes
        ]);

        // Fetch the status_id for the "Pending" status from the statuses table
        $pendingStatusId = \App\Models\Status::where('name', 'pending')->first()->id;

        // Create referral and store the notes, also include order_type_id
        $referral = Referral::create([
            'patient_id' => $request->patient_id,
            'referring_provider_id' => Auth::id(),
            'referred_provider_id' => $request->referred_provider_id,
            // 'reason' => $request->reason,
            'urgency' => $request->urgency,
            'status_id' => $pendingStatusId, // Use status_id instead of status
            'notes' => $request->notes,
            'order_type_id' => $request->order_type_id, // Save the order_type_id
        ]);

        // Generate the referral code: 'MAP-<ID>-<3 random characters>'
        $randomCharacters = strtoupper(Str::random(3)); // 3 random characters in uppercase
        $referralCode = 'MAP-REF' . $referral->id . $randomCharacters;

        // Assign the generated referral code
        $referral->referral_code = $referralCode;
        $referral->save(); // Save the referral with the referral code

        // Handling file upload for attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Store the file and get the stored path
                $path = $file->store('attachments', 'public');  // Store in public disk

                // Get the original filename
                $filename = $file->getClientOriginalName();

                // Save the attachment in the database
                Attachment::create([
                    'referral_id' => $referral->id,
                    'file_path' => $path,
                    'filename' => $filename,  // Save the original filename
                ]);
            }
        }

        return redirect()->route('referrals-list')->with('success', 'Referral created successfully!');
    }


    // public function view($referral_code)
    // {
    //     // Retrieve the referral with related data using referral_code instead of id
    //     $referral = Referral::with(['patient', 'referringProvider', 'referredProvider', 'attachments'])
    //         ->where('referral_code', $referral_code)
    //         ->firstOrFail();

    //     // Retrieve all status options from the 'statuses' table
    //     $statuses = Status::all(); // Get all statuses

    //     // Return the view with referral data and the statuses
    //     return view('backoffice.referrals.view-referral', compact('referral', 'statuses'));
    // }

    public function view($referral_code)
    {
        // Retrieve the referral with related data using referral_code instead of id
        $referral = Referral::with(['patient', 'referringProvider', 'referredProvider', 'attachments'])
            ->where('referral_code', $referral_code)
            ->firstOrFail();

        // Retrieve all status options from the 'statuses' table
        $statuses = Status::all(); // Get all statuses

        // Statuses with background color styles for the dropdown
        $statusesWithColors = [
            'Pending' => 'background-color: #f6c23e;',    // Yellow for pending
            'Scheduled' => 'background-color: #36b9cc;', // Orange for scheduled
            'Reviewed' => 'background-color: #4e73df;',   // Light Blue for reviewed
            'Accepted' => 'background-color: #1cc88a;',   // Green for accepted
            'Not Accepted' => 'background-color: #e74a3b;', // Red for not accepted
            'Patient Declined' => 'background-color: #5a5c69;', // Dark Red for patient declined
            'Completed' => 'background-color: #5a5c69;',      // Dark Green for completed
            'Cancelled' => 'background-color: #858796;', // Gray for cancelled
        ];

        // Return the view with referral data, statuses, and status color mappings
        return view('backoffice.referrals.view-referral', compact('referral', 'statuses', 'statusesWithColors'));
    }


    public function edit($referral_code)
    {
        // Find the referral by referral_code
        $referral = Referral::where('referral_code', $referral_code)->firstOrFail();

        // Retrieve patients, providers, order types, and statuses
        $patients = Patient::all(); // Fetch all patients
        $providers = Provider::all(); // Fetch all providers
        $orderTypes = OrderType::all(); // Fetch all order types
        $statuses = Status::all(); // Fetch all statuses

        // Return the edit form with the referral data, list of patients, providers, order types, and statuses
        return view('backoffice.referrals.edit-referral', compact('referral', 'patients', 'providers', 'orderTypes', 'statuses'));
    }

    public function update(Request $request, $referral_code)
    {
        // Validate the incoming request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referred_provider_id' => 'required|exists:providers,id', // Ensure referred_provider_id is valid
            // 'reason' => 'required|string',
            'urgency' => 'required|in:routine,urgent',
            // 'status' => 'required|string',  // Assuming 'status' is a string, adjust if it's an enum
            'notes' => 'nullable|string',
            'attachments' => 'nullable|array', // Ensure attachments are an array
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048', // Validate file types and sizes
            'order_type_id' => 'nullable|exists:order_types,id', // Validate order_type_id
        ]);

        // Find the referral by referral_code
        $referral = Referral::where('referral_code', $referral_code)->firstOrFail();

        // Update the referral with the new data, including the order_type_id
        $referral->update([
            'patient_id' => $request->patient_id,
            'referred_provider_id' => $request->referred_provider_id,
            // 'reason' => $request->reason,
            'urgency' => $request->urgency,
            // 'status' => $request->status,
            'notes' => $request->notes,
            'order_type_id' => $request->order_type_id, // Adding order_type_id to the update
        ]);

        // Handling file upload for attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Store the file and get the stored path
                $path = $file->store('attachments', 'public');  // Store in public disk

                // Get the original filename
                $filename = $file->getClientOriginalName();

                // Save the attachment in the database
                Attachment::create([
                    'referral_id' => $referral->id,
                    'file_path' => $path,
                    'filename' => $filename,  // Save the original filename
                ]);
            }
        }

        // Redirect to the referrals list with a success message
        return redirect()->route('referrals-list')->with('success', 'Referral updated successfully!');
    }


    // public function updateStatus(Request $request, Referral $referral)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'status' => 'required|integer', // status should now be an integer (status_id)
    //     ]);

    //     try {
    //         // Update the status_id of the referral
    //         $referral->status_id = $request->input('status');
    //         $referral->save();

    //         return response()->json(['message' => 'Referral status updated!']);
    //     } catch (\Exception $e) {
    //         // Log the exception if something goes wrong
    //         \Log::error('Error updating referral status: ' . $e->getMessage());
    //         return response()->json(['message' => 'Something went wrong!'], 500);
    //     }
    // }

    public function updateStatus(Request $request, Referral $referral)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|integer', // status should now be an integer (status_id)
            'reason' => 'nullable|string',  // Reason is optional initially
        ]);

        // Check if the status is 5 or 6, and if a reason is provided
        if (in_array($request->input('status'), [5, 6]) && !$request->input('reason')) {
            return response()->json(['message' => 'Please provide a reason for changing to this status.'], 400);
        }

        try {
            // Update the status_id of the referral
            $referral->status_id = $request->input('status');

            // If a reason is provided, update the reason field as well
            if ($request->filled('reason')) {
                $referral->reason = $request->input('reason');
            }

            // Save the referral
            $referral->save();

            return response()->json(['message' => 'Referral status updated!']);
        } catch (\Exception $e) {
            // Log the exception if something goes wrong
            \Log::error('Error updating referral status: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }







}



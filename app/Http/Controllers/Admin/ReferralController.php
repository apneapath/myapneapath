<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  // Ensure you're importing the correct Controller class
use App\Models\Referral;
use App\Models\Attachment;  // Import the Attachment model
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Provider;
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
    //     // Get all referrals with eager loading
    //     $referrals = Referral::with(['patient', 'referringProvider', 'referredProvider'])->get();

    //     // Log each referral with referring and referred provider
    //     \Log::info('Referrals:', $referrals->toArray());
    //     $referrals->each(function ($referral) {
    //         \Log::info('Referral', [
    //             'Referring Provider' => $referral->referringProvider,
    //             'Referred Provider' => $referral->referredProvider
    //         ]);
    //     });

    //     $canEdit = auth()->user()->can('edit posts');
    //     $canView = auth()->user()->can('view posts');
    //     $canDelete = auth()->user()->can('delete posts');

    //     return response()->json([
    //         'canEdit' => $canEdit,
    //         'canView' => $canView,
    //         'canDelete' => $canDelete,
    //         'referrals' => $referrals
    //     ]);
    // }

    public function index()
    {
        // Get all referrals with eager loading, ordered by created_at in descending order
        $referrals = Referral::with(['patient', 'referringProvider', 'referredProvider'])
            ->orderBy('created_at', 'desc')  // Sorting by created_at (most recent first)
            ->get();

        // Log each referral with referring and referred provider
        \Log::info('Referrals:', $referrals->toArray());
        $referrals->each(function ($referral) {
            \Log::info('Referral', [
                'Referring Provider' => $referral->referringProvider,
                'Referred Provider' => $referral->referredProvider
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
        // $patients = Patient::all(); // Get all patients
        // $providers = User::where('role', 'provider')->get(); // Get all providers
        // return view('referrals.create', compact('patients', 'providers'));


        $patients = Patient::all(); // Get all patients
        $providers = Provider::all(); // Get all providers

        return view('backoffice.referrals.create-referral', compact('patients', 'providers'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referred_provider_id' => 'required|exists:providers,id', // Ensure referred_provider_id is valid
            'reason' => 'required|string',
            'urgency' => 'required|in:routine,urgent',
            'notes' => 'nullable|string',  // Make sure notes is nullable and validated
            'attachments' => 'nullable|array', // Ensure attachments are an array
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048' // Validate file types and sizes
        ]);

        // Create referral and store the notes
        $referral = Referral::create([
            'patient_id' => $request->patient_id,
            'referring_provider_id' => Auth::id(),
            'referred_provider_id' => $request->referred_provider_id,
            'reason' => $request->reason,
            'urgency' => $request->urgency,
            'status' => 'pending',
            'notes' => $request->notes,  // Make sure the notes are being passed here
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

    public function view($referral_code)
    {
        // Retrieve the referral with related data using referral_code instead of id
        $referral = Referral::with(['patient', 'referringProvider', 'referredProvider', 'attachments'])
            ->where('referral_code', $referral_code)
            ->firstOrFail();

        // Return the view with referral data
        return view('backoffice.referrals.view-referral', compact('referral'));
    }

    public function edit($referral_code)
    {
        // Find the referral by referral_code
        $referral = Referral::where('referral_code', $referral_code)->firstOrFail();

        // Retrieve patients and providers to populate the select options
        $patients = Patient::all(); // Fetch all patients
        $providers = Provider::all(); // Fetch all providers

        // Return the edit form with the referral data and the list of patients and providers
        return view('backoffice.referrals.edit-referral', compact('referral', 'patients', 'providers'));
    }


    public function update(Request $request, $referral_code)
    {
        // Validate the incoming request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referred_provider_id' => 'required|exists:providers,id', // Ensure referred_provider_id is valid
            'reason' => 'required|string',
            'urgency' => 'required|in:routine,urgent',
            'status' => 'required|string',  // Assuming 'status' is a string, adjust if it's an enum
            'notes' => 'nullable|string',
            'attachments' => 'nullable|array', // Ensure attachments are an array
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx,txt|max:2048' // Validate file types and sizes
        ]);

        // Find the referral by referral_code
        $referral = Referral::where('referral_code', $referral_code)->firstOrFail();

        // Update the referral with the new data
        $referral->update([
            'patient_id' => $request->patient_id,
            'referred_provider_id' => $request->referred_provider_id,
            'reason' => $request->reason,
            'urgency' => $request->urgency,
            'status' => $request->status,
            'notes' => $request->notes,
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




}



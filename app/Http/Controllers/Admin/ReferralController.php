<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;  // Ensure you're importing the correct Controller class
use App\Models\Referral;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    // public function __construct()
    // {
    //     // Only allow access to this feature for providers or admins
    //     $this->middleware(['auth', 'role:provider|admin']);
    // }

    public function index()
    {
        // Get all referrals with eager loading
        $referrals = Referral::with(['patient', 'referringProvider', 'referredProvider'])->get();

        // Log each referral with referring and referred provider
        \Log::info('Referrals:', $referrals->toArray());
        $referrals->each(function ($referral) {
            \Log::info('Referral', [
                'Referring Provider' => $referral->referringProvider,
                'Referred Provider' => $referral->referredProvider
            ]);
        });

        $canEdit = auth()->user()->can('edit posts');
        $canView = auth()->user()->can('view posts');
        $canDelete = auth()->user()->can('delete posts');

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

    // // Handle the referral creation
    public function add(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referred_provider_id' => 'required|exists:providers,id',
            'reason' => 'required|string',
            'urgency' => 'required|in:routine,urgent',
        ]);

        Referral::create([
            'patient_id' => $request->patient_id,
            'referring_provider_id' => Auth::id(), // Use logged-in provider
            'referred_provider_id' => $request->referred_provider_id,
            'reason' => $request->reason,
            'urgency' => $request->urgency,
            'status' => 'pending',
        ]);

        // return redirect()->route('referrals-list')->with('success', 'Referral created successfully!');
        return redirect()->route('referrals-list')->with('success', 'User registered successfully!');
    }
}


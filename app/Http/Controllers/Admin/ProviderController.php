<?php

namespace App\Http\Controllers\Admin;


use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProviderController extends Controller
{
    // Display a listing of all providers
    public function index()
    {
        try {
            // Fetch providers with specific columns, including 'clinic_name' and 'account_status'
            $providers = Provider::select(
                'id',
                'first_name',
                'last_name',
                'contact_number',
                'dob',
                'email',
                'clinic_address',
                'city',
                'state',
                'postal_code',
                'specialization',
                'clinic_name', // Include clinic_name
                'account_status' // Include account_status
            )
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($provider) {
                    // Format the dob as Y-m-d
                    $provider->dob = Carbon::parse($provider->dob)->format('Y-m-d');

                    // Combine name and address into the expected structure
                    $provider->name = $provider->first_name . ' ' . $provider->last_name;
                    $provider->address = $provider->clinic_address . ', ' . $provider->city . ', ' . $provider->state . ' ' . $provider->postal_code;

                    return [
                        'id' => $provider->id,
                        'name' => $provider->name,
                        'contact_number' => $provider->contact_number,
                        'dob' => $provider->dob,
                        'email' => $provider->email,
                        'address' => $provider->address,
                        'specialization' => $provider->specialization,
                        'clinic_name' => $provider->clinic_name, // Include clinic_name
                        'account_status' => $provider->account_status, // Include account_status
                    ];
                });

            // Check if the logged-in user has permissions
            $canEdit = auth()->user()->can('edit posts');
            $canView = auth()->user()->can('view posts');
            $canDelete = auth()->user()->can('delete posts');

            // Return the providers along with permission flags
            return response()->json([
                'providers' => $providers,
                'canEdit' => $canEdit,
                'canView' => $canView,
                'canDelete' => $canDelete,
            ]);
        } catch (\Exception $e) {
            // Optionally log the exception for debugging in production
            // Log::error('Error fetching providers: ' . $e->getMessage());

            // Return an error response with message
            return response()->json([
                'error' => 'Unable to fetch providers.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // Show the form for creating a new provider
    public function showForm()
    {
        return view('backoffice.providers.add-provider');  // Return the view for the create provider form
    }


    // Store a newly created provider in the database
    // public function store(Request $request)
    // {
    //     // Validate input data
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'gender' => 'required|string|max:10',
    //         'dob' => 'required|date',
    //         'contact_number' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'specialization' => 'nullable|string|max:255',
    //         'license_number' => 'nullable|string|max:255',
    //         'clinic_name' => 'nullable|string|max:255',
    //         'street_address' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'postal_code' => 'required|string|max:20',
    //         'country' => 'nullable|string|max:255',
    //         'emergency_contact_name' => 'required|string|max:255',
    //         'emergency_contact_phone' => 'required|string|max:255',
    //         'work_hours' => 'nullable|json', // Make sure to handle as JSON
    //         'account_status' => 'nullable|in:Active,Suspended,Retired',
    //         'login_history' => 'nullable|json',
    //     ]);

    //     // Create a provider and set the dynamic fields (name, address)
    //     $provider = new Provider($request->all());

    //     // The name and address will be set automatically by the model's boot() method
    //     $provider->save();

    //     return redirect()->route('providers.index')->with('success', 'Provider created successfully!');
    // }


    public function add(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'email' => 'required|email|max:255|unique:providers,email',
            'contact_number' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'work_hours' => 'nullable|string',  // Adjust validation for work_hours
            'account_status' => 'nullable|in:Active,Suspended,Retired',
        ]);

        try {
            // Create the provider record
            $provider = Provider::create($validatedData);

            // Check if the provider was created successfully
            if ($provider) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Provider added successfully!',
                        'provider' => $provider
                    ]);
                }

                // If it's not an AJAX request, redirect back to the provider list
                return redirect()->route('providers-list')->with('success', 'Provider added successfully!');
            }

            // If creation failed
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create provider.'
                ], 500);
            }

            return back()->with('error', 'Failed to create provider.');

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error creating provider: ' . $e->getMessage());

            // Handle the error properly
            return back()->with('error', 'An error occurred while saving the provider.');
        }
    }



    // Display the specified provider details
    public function show(Provider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    // Show the form for editing a provider
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    // Update the specified provider in the database
    public function update(Request $request, Provider $provider)
    {
        // Validate input data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'clinic_name' => 'nullable|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'work_hours' => 'nullable|json',
            'account_status' => 'nullable|in:Active,Suspended,Retired',
            'login_history' => 'nullable|json',
        ]);

        // Update provider and set the dynamic fields (name, address)
        $provider->update($request->all());

        // The name and address will be set automatically by the model's boot() method during save/update
        return redirect()->route('providers.index')->with('success', 'Provider updated successfully!');
    }

    // Remove the specified provider from the database
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully!');
    }
}

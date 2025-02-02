<?php

namespace App\Http\Controllers\Admin;


use App\Models\Provider;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProviderController extends Controller
{
    // Display a listing of all providers
    public function index()
    {
        try {
            // Fetch providers with specific columns, including 'clinic_name' and 'account_status'
            $providers = Provider::select(
                'id',
                'provider_code',
                'first_name',
                'last_name',
                'contact_number',
                'dob',
                'email',
                'street',
                'city',
                'state',
                'postal_code',
                'specialization',
                'npi',
                'facility_name',
                'license_number', // Include clinic_name
                'account_status' // Include account_status
            )
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($provider) {
                    // Format the dob as Y-m-d
                    $provider->dob = Carbon::parse($provider->dob)->format('Y-m-d');

                    // Combine name and address into the expected structure
                    $provider->name = $provider->first_name . ' ' . $provider->last_name;
                    $provider->address = $provider->street . ', ' . $provider->city . ', ' . $provider->state . ' ' . $provider->postal_code;

                    return [
                        'id' => $provider->id,
                        'provider_code' => $provider->provider_code,
                        'name' => $provider->name,
                        'contact_number' => $provider->contact_number,
                        'dob' => $provider->dob,
                        'email' => $provider->email,
                        'address' => $provider->address,
                        'specialization' => $provider->specialization,
                        'npi' => $provider->npi,
                        'facility_name' => $provider->facility_name,
                        'license_number' => $provider->license_number, // Include clinic_name
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
            'facility_name' => 'nullable|string|max:255', // Validate facility_name
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'work_hours' => 'nullable|string',  // Adjust validation for work_hours
            'account_status' => 'nullable|in:Active,Suspended,Retired',
            'npi' => 'required|digits:10|unique:providers,npi',  // Ensure it's 10 digits and unique
            'fax_number' => 'nullable|digits:10',  // Ensure fax number is 10 digits long (optional)
        ]);

        try {
            // Check if facility name is provided
            $facilityName = $request->input('facility_name');
            if ($facilityName) {
                // Check if the facility already exists
                $facility = Facility::firstOrCreate(['facility_name' => $facilityName]);
                // Assign the facility_id to the provider record
                $validatedData['facility_name'] = $facility->facility_name; // Save the correct facility name in the provider table
            }

            // Create the provider record
            $provider = Provider::create($validatedData);

            // Generate the provider code in the format 'PROV-<ID>-<3 random characters>'
            $randomCharacters = strtoupper(Str::random(2)); // 3 random characters in uppercase
            $providerCode = 'MAP-PROV' . $provider->id . $randomCharacters;

            // Assign the generated provider code to the provider
            $provider->provider_code = $providerCode;
            $provider->save(); // Save the provider with the generated provider code

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
    public function edit($provider_code)
    {
        // Find the provider by provider_code instead of id
        $provider = Provider::where('provider_code', $provider_code)->first();

        // If provider not found, redirect with an error message
        if (!$provider) {
            return redirect()->route('providers-list')->with('error', 'Provider not found.');
        }

        // Return the edit view with the provider's data
        return view('backoffice.providers.edit-provider', compact('provider'));
    }


    // Update the specified provider in the database
    // public function update(Request $request, $provider_code)
    // {
    //     // Find the provider by provider_code
    //     $provider = Provider::where('provider_code', $provider_code)->first();

    //     // If provider not found, return an error response
    //     if (!$provider) {
    //         return redirect()->route('providers-list')->with('error', 'Provider not found.');
    //     }

    //     // Validate the data
    //     $validatedData = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'gender' => 'required|string|max:10',
    //         'dob' => 'required|date',
    //         'contact_number' => 'required|string|max:255',
    //         'emergency_contact_name' => 'required|string|max:255',
    //         'emergency_contact_phone' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'specialization' => 'nullable|string|max:255',
    //         'license_number' => 'nullable|string|max:255',
    //         'facility_name' => 'nullable|string|max:255',
    //         'street' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'postal_code' => 'required|string|max:20',
    //         'country' => 'nullable|string|max:255',
    //         'work_hours' => 'nullable|string',
    //         'account_status' => 'nullable|in:Active,Suspended,Retired',
    //         'npi' => 'nullable|string|max:10',
    //         'fax_number' => 'nullable|string|max:10',
    //     ]);

    //     // Update provider data
    //     $provider->update($validatedData);

    //     // Respond to AJAX request (if applicable)
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Provider updated successfully!',
    //             'provider' => $provider
    //         ]);
    //     }

    //     // If not an AJAX request, redirect back
    //     return redirect()->route('providers-list')->with('success', 'Provider updated successfully!');
    // }

    public function update(Request $request, $provider_code)
    {
        // Find the provider by provider_code
        $provider = Provider::where('provider_code', $provider_code)->first();

        // If provider not found, return an error response
        if (!$provider) {
            return redirect()->route('providers-list')->with('error', 'Provider not found.');
        }

        // Validate the data
        $validatedData = $request->validate([
            // Your validation rules
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'facility_name' => 'nullable|string|max:255', // Facility name validation
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'work_hours' => 'nullable|string',
            'account_status' => 'nullable|in:Active,Suspended,Retired',
            'npi' => 'nullable|string|max:10',
            'fax_number' => 'nullable|string|max:10',
        ]);

        // Check if the facility name is provided
        $facilityName = $request->input('facility_name');
        if ($facilityName) {
            // Find the facility or create a new one
            $facility = Facility::firstOrCreate(['facility_name' => $facilityName]);

            // Assign the facility_id to the provider
            $validatedData['facility_id'] = $facility->id;
        }

        // Update the provider data
        $updateResult = $provider->update($validatedData);

        // Check if the update was successful
        \Log::debug('Updated provider: ' . json_encode($provider));

        // If update was successful, return the response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Provider updated successfully!',
                'provider' => $provider
            ]);
        }

        // If not an AJAX request, redirect back
        return redirect()->route('providers-list')->with('success', 'Provider updated successfully!');
    }




    // Remove the specified provider from the database
    public function destroy($id)
    {
        // Find the patient by id
        $provider = Provider::findOrFail($id);

        // Delete the provider
        $provider->delete();
        return redirect()->route('providers-list')->with('success', 'Provider deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $facilities = Facility::where('facility_name', 'like', '%' . $query . '%')->get();

        return response()->json($facilities);
    }

}

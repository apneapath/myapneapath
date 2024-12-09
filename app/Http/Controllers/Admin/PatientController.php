<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // Ensure you're importing the correct Controller class
use App\Models\Patient;
use Carbon\Carbon;



class PatientController extends Controller
{
    // Display a list of patients
    // public function index()
    // {
    //     try {
    //         // Fetch patients with their associated data, if any (e.g., appointments, doctor, etc.)
    //         // For this example, we won't eager load anything, but you can modify this to include related data.
    //         $patients = Patient::select(
    //             'id',
    //             'first_name',
    //             'last_name',
    //             'contact_number',
    //             'dob',
    //             'email',
    //             'address'
    //             // Add more necessary fields here
    //         )
    //             ->orderBy('created_at', 'desc') // Optional: Order by creation date
    //             ->get()
    //             ->map(function ($patient) {
    //                 // Format the dob as Y-m-d (or any format you prefer)
    //                 $patient->dob = Carbon::parse($patient->dob)->format('Y-m-d');
    //                 // Return the necessary data for each patient
    //                 return [
    //                     'id' => $patient->id,
    //                     'first_name' => $patient->first_name,
    //                     'last_name' => $patient->last_name,
    //                     'contact_number' => $patient->contact_number,
    //                     'dob' => $patient->dob,  // Formatted date
    //                     'email' => $patient->email,
    //                     'address' => $patient->address,
    //                 ];
    //             });

    //         // Check if the logged-in user has permissions
    //         $canEdit = auth()->user()->can('edit patients');
    //         $canView = auth()->user()->can('view patients');
    //         $canDelete = auth()->user()->can('delete patients');

    //         // Return the patients along with permission flags
    //         return response()->json([
    //             'patients' => $patients,
    //             'canEdit' => $canEdit,
    //             'canView' => $canView,
    //             'canDelete' => $canDelete,
    //         ]);
    //     } catch (\Exception $e) {
    //         // Log the exception (optional, you can enable logging in a production environment)
    //         // Log::error('Error fetching patients: ' . $e->getMessage());

    //         // Return an error response
    //         return response()->json([
    //             'error' => 'Unable to fetch patients.',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function index()
    {
        try {
            // Fetch patients with specific columns
            $patients = Patient::select(
                'id',
                'first_name',
                'last_name',
                'contact_number',
                'dob',
                'email',
                'address'
            )
                ->orderBy('created_at', 'desc') // Optional: Order by creation date
                ->get()
                ->map(function ($patient) {
                    // Format the dob as Y-m-d
                    $patient->dob = Carbon::parse($patient->dob)->format('Y-m-d');
                    return [
                        'id' => $patient->id,
                        'first_name' => $patient->first_name,
                        'last_name' => $patient->last_name,
                        'contact_number' => $patient->contact_number,
                        'dob' => $patient->dob,
                        'email' => $patient->email,
                        'address' => $patient->address,
                    ];
                });

            // Check if the logged-in user has permissions
            $canEdit = auth()->user()->can('edit patients');
            $canView = auth()->user()->can('view patients');
            $canDelete = auth()->user()->can('delete patients');

            // Return the patients along with permission flags
            return response()->json([
                'patients' => $patients,
                'canEdit' => $canEdit,
                'canView' => $canView,
                'canDelete' => $canDelete,
            ]);
        } catch (\Exception $e) {
            // Optionally log the exception for debugging in production
            // Log::error('Error fetching patients: ' . $e->getMessage());

            // Return an error response with message
            return response()->json([
                'error' => 'Unable to fetch patients.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    // Show the form to create a new patient
    public function create()
    {
        return view('patients.create');
    }

    // Store a new patient in the database
    public function store(Request $request)
    {
        // Validate individual fields
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:15',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        // Manually create name and address before saving
        $data = $request->all();
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['address'] = $data['street_address'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['postal_code'] . ', ' . $data['country'];

        // Store the patient record with the calculated name and address
        Patient::create($data);

        return redirect()->route('patients.index');
    }

    // Show a specific patient's details
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Show the form to edit a patient's information
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update a patient's information
    public function update(Request $request, Patient $patient)
    {
        // Validate individual fields
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:15',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        // Manually create name and address before updating
        $data = $request->all();
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['address'] = $data['street_address'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['postal_code'] . ', ' . $data['country'];

        // Update the patient record with the calculated name and address
        $patient->update($data);

        return redirect()->route('patients.index');
    }

    // Delete a patient
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }
}

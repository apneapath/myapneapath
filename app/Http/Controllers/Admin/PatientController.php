<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // Ensure you're importing the correct Controller class
use App\Models\Patient;
use Carbon\Carbon;



class PatientController extends Controller
{
    // Display a list of patients
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
            $canEdit = auth()->user()->can('edit posts');
            $canView = auth()->user()->can('view posts');
            $canDelete = auth()->user()->can('delete posts');

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
    public function showForm()
    {
        return view('backoffice.patients.add-patient');  // Pass roles to the view
    }

    // Store a new patient in the database
    public function add(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'insurance_provider' => 'nullable|string|max:255',
            'policy_number' => 'nullable|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
        ]);

        // Create a new patient record
        $patient = Patient::create($validatedData);

        // Check if the patient was created successfully
        if ($patient) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Patient added successfully!',
                    'patient' => $patient
                ]);
            }

            // If not an AJAX request, redirect to patients list
            return redirect()->route('patients-list')->with('success', 'Patient added successfully!');
            // Corrected redirect
            // return redirect()->route('patients.index')->with('success', 'Patient added successfully!');

        }

        // If creation failed
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create patient.'
            ], 500);
        }

        return back()->with('error', 'Failed to create patient.');
    }

    // Show a specific patient's details
    public function view($id)
    {
        // Find the patient by ID
        $patient = Patient::find($id);
        if (!$patient) {
            return redirect()->route('patients.index')->with('error', 'Patient not found.');
        }

        // Return view with the patient data
        return view('patients.view', compact('patient'));
    }

    // Show the form to edit a patient's information
    public function edit($id)
    {
        // Find the patient by id
        $patient = Patient::findOrFail($id);
        // Return the edit view with the patient's data
        return view('backoffice.patients.edit-patient', compact('patient'));
    }

    // Update a patient's information
    public function update(Request $request, $id)
    {
        // Find the patient by ID
        $patient = Patient::find($id);
        if (!$patient) {
            return redirect()->route('patients.index')->with('error', 'Patient not found.');
        }

        // Validate the data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'insurance_provider' => 'nullable|string|max:255',
            'policy_number' => 'nullable|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:255',
        ]);

        // Update patient data
        $patient->update($validatedData);

        // Respond to AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Patient updated successfully!',
                'patient' => $patient
            ]);
        }

        // If not an AJAX request, redirect
        return redirect()->route('patients-list')->with('success', 'Patient updated successfully!');
    }
    // Delete a patient
    public function destroy($id)
    {
        // Find the patient by id
        $patient = Patient::findOrFail($id);

        // Delete the patient
        $patient->delete();

        // Redirect with a success message
        return redirect()->route('patients-list')->with('success', 'Patient deleted successfully.');
    }
}

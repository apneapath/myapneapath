<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    // Method to suggest facilities based on user input
    public function suggest(Request $request)
    {
        $query = $request->input('query');  // Get the user input (search query)

        // Find facilities that match the query
        $facilities = Facility::where('facility_name', 'like', '%' . $query . '%')
            ->limit(5) // Limit to 5 results
            ->get();

        // Return matching facilities as JSON
        return response()->json($facilities);
    }

    // Method to save a new or existing facility
    public function save(Request $request)
    {
        $request->validate([
            'facility_name' => 'required|string',
        ]);

        // Try to find an existing facility or create a new one
        $facility = Facility::firstOrCreate([
            'facility_name' => $request->input('facility_name'),
        ]);

        return response()->json(['success' => 'Facility saved successfully!', 'facility' => $facility]);
    }

    // In your FacilityController.php
    public function index()
    {
        // Fetch all facilities (including any relationships you may want to load)
        $facilities = Facility::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($facility) {
                // Return the necessary data for each facility
                return [
                    'id' => $facility->id,
                    'facility_name' => $facility->facility_name,
                    'address' => $facility->address,
                    'phone_number' => $facility->phone_number,
                    'email' => $facility->email,
                    'facility_type' => $facility->facility_type,
                ];
            });

        // Check if the logged-in user has permissions for editing, viewing, and deleting
        $canEdit = auth()->user()->can('edit posts');
        $canView = auth()->user()->can('view posts');
        $canDelete = auth()->user()->can('delete posts');

        // Return the facilities along with permission flags
        return response()->json([
            'facilities' => $facilities,
            'canEdit' => $canEdit,
            'canView' => $canView,
            'canDelete' => $canDelete,
        ]);
    }

    public function showForm()
    {
        return view('backoffice.facilities.add-facility');  // Pass roles to the view
    }

    public function add(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'facility_name' => 'required|string|max:255',
            'facility_type' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'street' => 'required|string|max:255', // Add validation for street
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        // Concatenate city, state, postal_code, and country to form the address
        $address = $request->street . ', ' . $request->city . ', ' . $request->state . ' ' . $request->postal_code . ', ' . $request->country;

        // Create a new Facility record with all the necessary data
        Facility::create([
            'facility_name' => $request->facility_name,
            'facility_type' => $request->facility_type,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $address,  // Save the concatenated address
            'street' => $request->street, // Save street
            'city' => $request->city,  // Save the individual city value
            'state' => $request->state,  // Save the individual state value
            'postal_code' => $request->postal_code,  // Save the individual postal code value
            'country' => $request->country,  // Save the individual country value
        ]);

        // Redirect with success message
        return redirect()->route('facilities-list')->with('success', 'Facility created successfully!');
    }



}


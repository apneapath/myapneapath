<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Facility;
use App\Models\Role;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function showForm()
    {
        $roles = Role::all();  // Get all available roles
        return view('backoffice.admin.add-user', compact('roles'));  // Pass roles to the view
    }

    // public function add(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validated = $request->validate([
    //         'firstName' => 'required|string|max:255',
    //         'lastName' => 'required|string|max:255',
    //         'gender' => 'required|string',
    //         'email' => 'required|email|unique:users,email',
    //         'address' => 'required|string',
    //         'phoneNumber' => 'required|string',
    //         'role' => 'required|string|exists:roles,name', // Ensure the role exists in the roles table
    //         'status' => 'required|string|in:Active,Inactive',
    //         'username' => 'nullable|string|max:255|unique:users,username',
    //         'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
    //         'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Handle photo upload validation
    //     ]);

    //     // Create the user
    //     $user = new User();
    //     $user->first_name = $request->firstName;
    //     $user->last_name = $request->lastName;
    //     $user->gender = $request->gender;
    //     $user->email = $request->email;
    //     $user->address = $request->address;
    //     $user->phone_number = $request->phoneNumber;
    //     $user->status = $request->status;
    //     $user->username = $request->userName;
    //     $user->password = bcrypt($request->password); // Hash the password

    //     // Handle the photo upload
    //     if ($request->hasFile('photo')) {
    //         // Get the current timestamp
    //         $timestamp = time();
    //         // Create a filename based on first name, last name, and timestamp
    //         $filename = strtolower($user->first_name . '_' . $user->last_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension());
    //         // Store the photo
    //         $photoPath = $request->file('photo')->storeAs('photos', $filename, 'public');
    //         $user->photo = $photoPath; // Store the path in the database
    //     }

    //     // Save the user
    //     $user->name = trim($user->first_name . ' ' . $user->last_name); // Set the name by combining first and last names
    //     $user->save();

    //     // Assign the role to the user via the pivot table
    //     $role = Role::where('name', $request->role)->first(); // Find the role by name
    //     if ($role) {
    //         $user->roles()->attach($role); // Attach the role to the user (many-to-many relationship)
    //     } else {
    //         return redirect()->route('users.add')->with('error', 'Role not found.');
    //     }

    //     // Redirect to the user list with a success message
    //     return redirect()->route('users-list')->with('success', 'User registered successfully!');
    // }

    public function add(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'phoneNumber' => 'required|string',
            'role' => 'required|string|exists:roles,name', // Ensure the role exists in the roles table
            'status' => 'required|string|in:Active,Inactive',
            'username' => 'nullable|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Handle photo upload validation
            'facility_name' => 'nullable|string|max:255', // Facility name is optional, but can be manually entered
        ]);

        // Create the user
        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone_number = $request->phoneNumber;
        $user->status = $request->status;
        $user->username = $request->userName;
        $user->password = bcrypt($request->password); // Hash the password

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            // Get the current timestamp
            $timestamp = time();
            // Create a filename based on first name, last name, and timestamp
            $filename = strtolower($user->first_name . '_' . $user->last_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension());
            // Store the photo
            $photoPath = $request->file('photo')->storeAs('photos', $filename, 'public');
            $user->photo = $photoPath; // Store the path in the database
        }

        // Save the user
        $user->name = trim($user->first_name . ' ' . $user->last_name); // Set the name by combining first and last names

        // Save the facility_name (whether it's selected or manually entered)
        $user->facility_name = $request->facility_name;

        $user->save();

        // Assign the role to the user via the pivot table
        $role = Role::where('name', $request->role)->first(); // Find the role by name
        if ($role) {
            $user->roles()->attach($role); // Attach the role to the user (many-to-many relationship)
        } else {
            return redirect()->route('users.add')->with('error', 'Role not found.');
        }

        // Redirect to the user list with a success message
        return redirect()->route('users-list')->with('success', 'User registered successfully!');
    }


    // public function index()
    // {
    //     // Fetch users with their associated roles
    //     $users = User::with('roles') // Eager load roles
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         ->map(function ($user) {
    //             // Get the roles associated with the user (if any)
    //             $roles = $user->roles->pluck('name')->join(', '); // Join multiple roles with a comma

    //             return [
    //                 'id' => $user->id,
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'role' => $roles, // Display roles as a comma-separated string
    //                 'status' => $user->status,
    //                 'photo' => $user->photo ? asset('storage/' . $user->photo) : asset('img/backoffice/avatar/user-default-photo.png'), // Photo URL
    //             ];
    //         });

    //     return response()->json($users);
    // }


    public function index()
    {
        // Fetch users with their associated roles
        $users = User::with('roles') // Eager load roles
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                // Get the roles associated with the user (if any)
                $roles = $user->roles->pluck('name')->join(', '); // Join multiple roles with a comma
    
                // Return the necessary data for each user
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $roles, // Display roles as a comma-separated string
                    'status' => $user->status,
                    'photo' => $user->photo ? asset('storage/' . $user->photo) : asset('img/backoffice/avatar/user-default-photo.png'), // Photo URL
                ];
            });

        // Check if the logged-in user has permissions
        $canEdit = auth()->user()->can('edit posts');
        $canView = auth()->user()->can('view posts');
        $canDelete = auth()->user()->can('delete posts');

        // Return the users along with permission flags
        return response()->json([
            'users' => $users,
            'canEdit' => $canEdit,
            'canView' => $canView,
            'canDelete' => $canDelete,
        ]);
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all(); // Get all roles from the Role model
        return view('backoffice.admin.edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phoneNumber' => 'nullable|string|max:15',
            'gender' => 'required|string',
            'status' => 'required|string',
            'role' => 'required|array', // Role should be an array (multiple roles can be selected)
            'address' => 'nullable|string',
            'username' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Retrieve the user
        $user = User::findOrFail($id);

        // Store old values for comparison
        $oldValues = [
            'email' => $user->email,
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'status' => $user->status,
            'role' => $user->roles->pluck('name')->toArray(), // Fetch current roles
            'address' => $user->address,
            'username' => $user->username,
        ];

        // Check if current password is provided and valid
        if ($request->filled('current_password') && Hash::check($request->current_password, $user->password)) {
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password); // Hash the new password
            }
        } elseif ($request->filled('current_password')) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Store the old photo path for comparison
        $oldPhoto = $user->photo;

        // Update user properties
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->email = $request->email;
        $user->phone_number = $request->phoneNumber;
        $user->address = $request->address;
        $user->username = $request->username;

        // Update the name by combining first and last names
        $user->name = trim($user->first_name . ' ' . $user->last_name);

        // Prepare action details
        $actionDetails = [];

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                Storage::disk('public')->delete($oldPhoto);
            }

            // Store the new photo
            $timestamp = time();
            $filename = strtolower($user->first_name . '_' . $user->last_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension());
            $photoPath = $request->file('photo')->storeAs('photos', $filename, 'public');
            $user->photo = $photoPath; // Store the path in the database

            // Log photo update
            $actionDetails[] = "Updated profile photo.";
        }

        // Save the user
        $user->save();

        // Sync roles (syncs the role_user pivot table)
        $user->roles()->sync($request->role); // Pass the role IDs as an array to sync the roles

        // Sync the permissions for the user based on their new roles
        // Ensure the user inherits all permissions of the assigned roles
        $permissions = $user->roles->pluck('permissions')->flatten();
        $user->permissions()->sync($permissions->pluck('id'));

        // Check for changes and log them
        foreach ($oldValues as $key => $oldValue) {
            $newValue = $user->$key; // Dynamic property access
            if ($oldValue != $newValue) {
                // Add each change as a list item
                $actionDetails[] = "<li>Changed {$key} from " . implode(', ', (array) $oldValue) . " to " . implode(', ', (array) $newValue) . ".</li>";
            }
        }

        // Log activity with detailed action
        ActivityLog::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'action' => 'Profile Update',
            'action_detail' => '<ul>' . implode('', $actionDetails) . '</ul>', // Combine changes into a list
        ]);

        return redirect()->route('users-list')->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Optionally, delete the user's photo if it exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // Delete the user
        $user->delete();

        return redirect()->route('users-list')->with('success', 'User deleted successfully!');
    }

    public function view($id)
    {
        $user = User::findOrFail($id); // Fetch user by ID
        return view('backoffice.admin.view-user', compact('user')); // Pass the user to the view
    }

    public function viewActivityLogs(Request $request)
    {
        // Fetch all logs, ordering by created_at in descending order
        $logs = ActivityLog::orderBy('created_at', 'desc')->get();

        return view('backoffice.admin.activity-logs', compact('logs'));
    }

    // Suggest facilities based on user input
    // This method will handle the search request from the frontend
    public function search(Request $request)
    {
        // Get the search query from the input
        $query = $request->input('query');

        // Perform a search query on the facilities table to find matching names
        $facilities = Facility::where('facility_name', 'like', '%' . $query . '%')->get();

        // Return the result as a JSON response
        return response()->json($facilities);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function add(Request $request)
    {
        // Create the user
        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone_number = $request->phoneNumber;
        $user->role = $request->role;
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
        $user->name = trim($user->first_name . ' ' . $user->last_name);// Set the name by combining first and last names
        $user->save();

        return redirect()->route('users-list')->with('success', 'User registered successfully!');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id, // Include the user ID if needed
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status,
                'photo' => $user->photo ? asset('storage/' . $user->photo) : asset('img/backoffice/avatar/user-default-photo.png'), // Photo URL
            ];
        });

        return response()->json($users);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id); // Retrieve the user by ID
        return view('backoffice.admin.edit-user', compact('user')); // Update the path
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
            'role' => 'required|string',
            'address' => 'nullable|string',
            'username' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Retrieve the user
        $user = User::findOrFail($id);

        // Check if current password is provided and valid
        if ($request->filled('current_password') && Hash::check($request->current_password, $user->password)) {
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password); // Hash the new password
            }
        } else if ($request->filled('current_password')) {
            // Return an error message if the current password is incorrect
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update user properties
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->gender = $request->gender;
        $user->status = $request->status;
        $user->email = $request->email;
        $user->phone_number = $request->phoneNumber;
        $user->role = $request->role;
        $user->address = $request->address;
        $user->username = $request->username;

        // Update the name by combining first and last names
        $user->name = trim($user->first_name . ' ' . $user->last_name);

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Store the new photo
            $timestamp = time();
            $filename = strtolower($user->first_name . '_' . $user->last_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension());
            $photoPath = $request->file('photo')->storeAs('photos', $filename, 'public');
            $user->photo = $photoPath; // Store the path in the database
        }

        // Save the user
        $user->save();

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




}

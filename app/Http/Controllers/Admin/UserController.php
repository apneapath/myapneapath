<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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



}

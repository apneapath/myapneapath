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
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'phoneNumber' => 'required|string|max:15',
            'role' => 'required|string',
            'status' => 'required|string',
            'userName' => 'nullable|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $user->save();

        return redirect()->route('users.list')->with('success', 'User registered successfully!');
    }
}

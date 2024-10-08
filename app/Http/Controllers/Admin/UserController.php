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
        $user->save();

        return redirect()->route('users-list')->with('success', 'User registered successfully!');
    }
}

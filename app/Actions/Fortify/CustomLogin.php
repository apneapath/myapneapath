<?php

namespace App\Actions\Fortify;

use App\Models\User; // User model
use App\Models\Patient; // Patient model
use App\Models\Provider; // Provider model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\ActivityLog;

class CustomLogin
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(), // Or the relevant user's ID
                'user_name' => Auth::user()->name, // Get the name of the logged-in user
                'action' => 'User logged in',
                'action_detail' => 'User has logged in successfully.', // Customize this if needed
            ]);

            return Auth::user();
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // public function login(Request $request)
    // {
    //     // Validate the credentials
    //     $credentials = $request->only('email', 'password');

    //     // Try authenticating as a User first
    //     if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->filled('remember'))) {
    //         $user = Auth::user();
    //         return response()->json([
    //             'message' => 'User logged in successfully!',
    //             'user' => $user
    //         ]);
    //     }

    //     // Try authenticating as a Patient if User failed
    //     if (Auth::guard('patients')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->filled('remember'))) {
    //         $patient = Auth::guard('patients')->user();
    //         return response()->json([
    //             'message' => 'Patient logged in successfully!',
    //             'patient' => $patient
    //         ]);
    //     }

    //     // Try authenticating as a Provider if both User and Patient failed
    //     if (Auth::guard('providers')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->filled('remember'))) {
    //         $provider = Auth::guard('providers')->user();
    //         return response()->json([
    //             'message' => 'Provider logged in successfully!',
    //             'provider' => $provider
    //         ]);
    //     }

    //     // If none match, throw validation exception
    //     throw ValidationException::withMessages([
    //         'email' => ['The provided credentials do not match our records.'],
    //     ]);
    // }

}

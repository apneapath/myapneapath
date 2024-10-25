<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;
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
}

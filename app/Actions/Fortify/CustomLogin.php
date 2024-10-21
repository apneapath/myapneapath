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
                'user_id' => Auth::id(),
                'action' => 'User logged in',
            ]);

            return Auth::user();
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

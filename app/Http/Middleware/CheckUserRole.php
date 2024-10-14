<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        Log::info('User Role: ' . ($user ? $user->role : 'Guest'));

        // Handle comma-separated roles
        $roles = explode(',', implode(',', $roles));

        if ($user && in_array(trim($user->role), array_map('trim', $roles))) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}



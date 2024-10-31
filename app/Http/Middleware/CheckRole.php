<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ($request->user() && $request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'You do not have access to this resource.');
    }
}

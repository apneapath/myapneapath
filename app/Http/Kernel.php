<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // etc.
    ];

    protected $routeMiddleware = [
        // Other middleware...
        'auth' => \App\Http\Middleware\Authenticate::class,
        'verified' => \Laravel\Jetstream\Http\Middleware\EnsureEmailIsVerified::class,
        'checkRole' => \App\Http\Middleware\CheckUserRole::class, // Ensure this line is present
    ];






}

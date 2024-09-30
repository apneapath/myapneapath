<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('storefront.index');
});

//super-admin
Route::get('/backoffice/super-admin', function () {
    return view('backoffice/super-admin/super-admin-dashboard');
});


//Temporary commented
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard/patient', function () {
//         return view('dashboards.patient');
//     })->name('dashboard.patient');

//     Route::get('/dashboard/doctor', function () {
//         return view('dashboards.doctor');
//     })->name('dashboard.doctor');

//     Route::get('/dashboard/administrator', function () {
//         return view('dashboards.administrator');
//     })->name('dashboard.administrator');

//     Route::get('/dashboard/super-admin', function () {
//         return view('dashboards.superadmin');
//     })->name('dashboard.superadmin');
// });


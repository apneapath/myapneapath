<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('storefront.index');
});

//super-admin
Route::get('/backoffice', function () {
    return view('backoffice.dashboard');
});

//patients-list
Route::get('/patients-list', function () {
    return view('backoffice.patients.patients-list');
});

//doctors-list
Route::get('/doctors-list', function () {
    return view('backoffice.doctors.doctors-list');
});

//specialties-list
Route::get('/specialties-list', function () {
    return view('backoffice.specialties.specialties-list');
});

//facilities-list
Route::get('/facilities-list', function () {
    return view('backoffice.facilities.facilities-list');
});

//referrals-list
Route::get('/referrals-list', function () {
    return view('backoffice.referrals.referrals-list');
});

//referral-types-list
Route::get('/referral-types-list', function () {
    return view('backoffice.referrals.referral-types-list');
});

///medical-records-list
Route::get('/medical-records-list', function () {
    return view('backoffice.records.medical-records-list');
});

//attachments-list
Route::get('/attachments-list', function () {
    return view('backoffice.records.attachments-list');
});

//appointments-list
Route::get('/appointments-list', function () {
    return view('backoffice.appointments.appointments-list');
});

//users-list
Route::get('/users-list', function () {
    return view('backoffice.admin.users-list');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');


//add-user
Route::get('/add-user', function () {
    return view('backoffice.admin.add-user');
});

//post users-list
Route::post('/users-list', [UserController::class, 'add'])->name('users-list');

//users-list
Route::get('/roles-list', function () {
    return view('backoffice.admin.roles-list');
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


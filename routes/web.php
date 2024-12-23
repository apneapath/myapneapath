<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Role;  // Import the Role model

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
Route::get('/providers-list', function () {
    return view('backoffice.providers.providers-list');
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


//USER----------------------------------------------------------------------------------------------------------------------------------
//route for user AJAX
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/add-user', [UserController::class, 'showForm'])->name('users.showForm');

//post users-list
Route::post('/users-list', [UserController::class, 'add'])->name('users-list');

//edit user
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');

//update user
Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');

//delete user
Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->name('delete-user');

//update user
Route::get('/view-user/{id}', [UserController::class, 'view'])->name('view-user');

//activity logs view
Route::get('/activity-logs', [UserController::class, 'viewActivityLogs'])->name('activity-logs');

//ROLES--------------------------------------------------------------------------------------------------------------------------------
//roles-list
Route::get('/roles-list', [RoleController::class, 'index'])->name('roles.index');

// Show form to create a new role
Route::get('/add-role', [RoleController::class, 'create'])->name('roles.create');

// Store new role
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

// Show form to edit an existing role
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');

// Update a role
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');

// Delete a role
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


//PATIENTS--------------------------------------------------------------------------------------------------------------------------------
// Show all patients (AJAX)
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

// // Show the form to create a new patient
Route::get('/add-patient', [PatientController::class, 'showForm'])->name('patients.showForm');

// // Store a new patient (AJAX request for the patient list)
Route::post('/patients-list', [PatientController::class, 'add'])->name('patients-list');

// // Show the form to edit an existing patient
Route::get('/edit-patient/{id}', [PatientController::class, 'edit'])->name('patients.edit');

// // Update the patient
Route::post('/update-patient/{id}', [PatientController::class, 'update'])->name('patients.update');

// // Delete the patient
Route::delete('/delete-patient/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');



// TO BE CONTINUE PATIENT DASHBOARD-----------------------------------------------------------------------------------------------------
// //Patient dashboard
Route::get('/patient-dashboard/{id}', [PatientController::class, 'show'])->name('patient-dashboard');


//PROVIDER------------------------------------------------------------------------------------------------------------------------------
// Show all providers (AJAX)
Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');

// Route to show the create provider form
Route::get('/add-provider', [ProviderController::class, 'showForm'])->name('providers.showForm');

// Route to handle the form submission for adding a new provider
Route::post('/providers-list', [ProviderController::class, 'add'])->name('providers-list');

// Show the form to edit an existing provider
Route::get('/edit-provider/{id}', [ProviderController::class, 'edit'])->name('provider.edit');

// Update the provider
Route::post('/update-provider/{id}', [ProviderController::class, 'update'])->name('providers.update');



















Route::group(['middleware' => ['role:Super Admin']], function () {
    // Admin routes
});

Route::group(['middleware' => ['role:Administrator']], function () {
    // Editor routes
});

Route::group(['middleware' => ['role:Virtual Assistant']], function () {
    // Editor routes
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


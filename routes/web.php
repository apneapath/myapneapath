<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\OrderTypeController;
use App\Models\Role;  // Import the Role model


// Main Routes Used for Sidenavbar --------------------------------------------------------------------------------------------------------------------------------------

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


// USERS --------------------------------------------------------------------------------------------------------------------------------------------------------------

// Route to search for facilities to assign for user
Route::get('/search-facilities', [UserController::class, 'search']);

//route for user AJAX
Route::get('/users', [UserController::class, 'index'])->name('users.index');

//route for showing form to user
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


// ROLES --------------------------------------------------------------------------------------------------------------------------------
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


// FACILITIES ----------------------------------------------------------------------------------------------------------------------------------
// Show all facilities (AJAX)
Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');

// // Show the form to create a new facility
Route::get('/add-facility', [FacilityController::class, 'showForm'])->name('facility.showForm');

// // Store a new facility (AJAX request for the facilities list)
Route::post('/facilities-list', [FacilityController::class, 'add'])->name('facilities-list');


//PATIENTS--------------------------------------------------------------------------------------------------------------------------------
// Show all patients (AJAX)
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

// // Show the form to create a new patient
Route::get('/add-patient', [PatientController::class, 'showForm'])->name('patients.showForm');

// // Store a new patient (AJAX request for the patient list)
Route::post('/patients-list', [PatientController::class, 'add'])->name('patients-list');

// // Show the form to edit an existing patient
Route::get('/edit-patient/{patient_code}', [PatientController::class, 'edit'])->name('patients.edit');

// // Update the patient
Route::post('/update-patient/{patient_code}', [PatientController::class, 'update'])->name('patients.update');

// // Delete the patient
Route::delete('/delete-patient/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');


//PROVIDER------------------------------------------------------------------------------------------------------------------------------
// Route for searching facilities
Route::get('/search-facilities', [ProviderController::class, 'search']);

// Show all providers (AJAX)
Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');

// Route to show the create provider form
Route::get('/add-provider', [ProviderController::class, 'showForm'])->name('providers.showForm');

// Route to handle the form submission for adding a new provider
Route::post('/providers-list', [ProviderController::class, 'add'])->name('providers-list');

// Show the form to edit an existing provider
Route::get('/edit-provider/{provider_code}', [ProviderController::class, 'edit'])->name('provider.edit');

// Update the provider
Route::post('/update-provider/{provider_code}', [ProviderController::class, 'update'])->name('providers.update');

// // Delete the provider
Route::delete('/delete-provider/{id}', [ProviderController::class, 'destroy'])->name('providers.destroy');


//REFERRAL------------------------------------------------------------------------------------------------------------------------------
// Show all referrals (AJAX)
Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');

// Route to show the create referral form
Route::get('/create-referral', [ReferralController::class, 'showForm'])->name('referrals.showForm');

// Route to handle the form submission for adding a new referral
Route::post('/referrals-list', [ReferralController::class, 'add'])->name('referrals-list');

//View referral
Route::get('/view-referral/{referral_code}', [ReferralController::class, 'view'])->name('view-referral');

// Edit referral by referral code
Route::get('/edit-referral/{referral_code}', [ReferralController::class, 'edit'])->name('edit-referral');

// Update referral 
Route::post('/update-referral/{referral_code}', [ReferralController::class, 'update'])->name('update-referral');


// Route for updating the referral status
Route::put('/referrals/{referral_code}/update-status', [ReferralController::class, 'updateStatus'])->name('update-referral-status');



//ORDER TYPES------------------------------------------------------------------------------------------------------------------------------
// Show all Order Types (AJAX)
Route::get('/orderTypes', [OrderTypeController::class, 'index'])->name('orderTypes.index');

// Show form to create a new order type
Route::get('/create-referral-types', action: [OrderTypeController::class, 'create'])->name('orderTypes.create');

// Store new role
Route::post('/referral-types-list', [OrderTypeController::class, 'store'])->name('orderTypes.store');

// // Delete the order type
Route::delete('/delete-referral-types/{id}', [OrderTypeController::class, 'destroy'])->name('orderTypes.destroy');

// Edit Order Type
Route::get('/edit-referral-type/{id}', [OrderTypeController::class, 'edit'])->name('orderTypes.edit');

// Update Order Type
Route::put('/orderTypes/{id}', [OrderTypeController::class, 'update'])->name('orderTypes.update');
















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


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'contact_number',
        'email',
        'medical_history',
        'allergies',
        'insurance_provider',
        'policy_number',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',  // If you want to include the country field
        'emergency_contact_name',
        'emergency_contact_phone',
    ];


    // Automatically set the name and address before creating or updating a patient
    public static function boot()
    {
        parent::boot();

        static::saving(function ($patient) {
            // Concatenate first name and last name to generate full name
            $patient->name = $patient->first_name . ' ' . $patient->last_name;

            // Concatenate address fields to generate full address
            $patient->address = $patient->street_address . ', ' . $patient->city . ', ' . $patient->state . ' ' . $patient->postal_code . ', ' . $patient->country;
        });
    }
}


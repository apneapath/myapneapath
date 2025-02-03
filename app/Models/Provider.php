<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'provider_code',

        'first_name',
        'last_name',
        'gender',
        'dob',

        'fax_number',
        'email',
        'contact_number',
        // 'emergency_contact_name',
        // 'emergency_contact_phone',

        'street',  // changed from street_address to clinic_address
        'city',
        'state',
        'postal_code',
        // 'country',

        'specialization',
        'facility_name',
        // 'npi',
        // 'license_number',

        // 'work_hours',

        'account_status',
    ];

    // If you need to convert the `work_hours` or `login_history` columns to array type
    protected $casts = [
        'work_hours' => 'array',
        'login_history' => 'array',
    ];

    // Automatically set the name and address before creating or updating a provider
    public static function boot()
    {
        parent::boot();

        static::saving(function ($provider) {
            // Concatenate first name and last name to generate full name
            $provider->name = $provider->first_name . ' ' . $provider->last_name;

            // Concatenate address fields to generate full address
            $provider->address = $provider->clinic_address . ', ' . $provider->city . ', ' . $provider->state . ' ' . $provider->postal_code;
        });
    }

    // Optionally, you can define relationships with other models like Patient, User, etc.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If a provider can have many patients
    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referring_provider_id');
    }

}

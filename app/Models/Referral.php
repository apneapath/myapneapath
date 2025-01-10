<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'referring_provider_id',
        'referred_provider_id',
        'reason',
        'urgency',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function referringProvider()
    {
        // This refers to the User model (creator of the referral)
        return $this->belongsTo(User::class, 'referring_provider_id');
    }

    public function referredProvider()
    {
        // This refers to the Provider model (the referred provider)
        return $this->belongsTo(Provider::class, 'referred_provider_id');
    }

}


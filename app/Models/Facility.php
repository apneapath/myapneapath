<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    // Define the table associated with the model (if the table name is different from the plural form of the model)
    protected $table = 'facilities';

    // Specify the columns that are mass assignable
    protected $fillable = [
        'facility_name',
        'facility_type',
        'phone_number',
        'email',
        'address',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
    ];
}

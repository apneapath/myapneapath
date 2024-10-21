<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    //use HasFactory;

    protected $fillable = [
        'user_id', // Add this line
        'action',
        'created_at', // Include other fields as needed
    ];
}

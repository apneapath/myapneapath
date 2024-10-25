<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    //use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'action_detail',
    ];
}

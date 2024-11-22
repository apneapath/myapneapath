<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission; // Import Spatie Permission class

// class Permission extends Model
// {
//     protected $fillable = ['name'];

//     public function roles()
//     {
//         return $this->belongsToMany(Role::class);
//     }
// }

class Permission extends SpatiePermission
{
    // This class can remain as is.
}



<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole; // Import Spatie Role class

// class Role extends Model
// {
//     protected $fillable = ['name'];

//     public function users()
//     {
//         return $this->belongsToMany(User::class);
//     }

//     public function permissions()
//     {
//         return $this->belongsToMany(Permission::class);
//     }
// }

class Role extends SpatieRole
{
    // No need to add methods like 'users()' and 'permissions()' here,
    // these are handled by Spatie package itself.
}


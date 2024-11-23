<?php

// namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles; // Add this import

// class User extends Authenticatable
// {
//     use HasApiTokens;
//     use HasFactory;
//     use HasProfilePhoto;
//     use Notifiable;
//     use TwoFactorAuthenticatable;
//     use HasRoles; // Add this line to enable roles and permissions functionality

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'name',
//         'firstName',
//         'lastName',
//         'gender',
//         'email',
//         'address',
//         'phoneNumber',
//         'role',
//         'status',
//         'userName',
//         'password',
//     ];


//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//         'two_factor_recovery_codes',
//         'two_factor_secret',
//     ];

//     /**
//      * The accessors to append to the model's array form.
//      *
//      * @var array<int, string>
//      */
//     protected $appends = [
//         'profile_photo_url',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }


//     public function roles()
//     {
//         return $this->belongsToMany(Role::class);
//     }

//     public function hasRole($role)
//     {
//         return $this->roles()->where('name', $role)->exists();
//     }

//     public function hasPermission($permission)
//     {
//         return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
//             $query->where('name', $permission);
//         })->exists();
//     }
// }



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Add this import

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles; // Add this line to enable roles and permissions functionality

    protected $fillable = [
        'name',
        'firstName',
        'lastName',
        'gender',
        'email',
        'address',
        'phoneNumber',
        'role',
        'status',
        'userName',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    // New helper methods
    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->permissions->contains('name', $permission);
    }

    public function isAdmin()
    {
        return $this->hasRole('Super Admin');
    }
}


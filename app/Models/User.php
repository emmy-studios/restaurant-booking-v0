<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE = 'ADMIN';
    const SUPERVISOR_ROLE = 'SUPERVISOR';
    const CUSTOMER_ROLE = 'CUSTOMER';
    const EMPLOYEE_ROLE = 'EMPLOYEE';

    const ROLES = [
        self::ADMIN_ROLE => 'admin',
        self::SUPERVISOR_ROLE => 'supervisor',
        self::CUSTOMER_ROLE => 'customer',
        self::EMPLOYEE_ROLE => 'employee',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'country_code',
        'phone_number',
        'country',
        'city',
        'address',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin() || $this->isSupervisor() || $this->isEmployee();
    }

    public function isAdmin(){
        return $this->role === self::ADMIN_ROLE;
    }

    public function isSupervisor(){
        return $this->role === self::SUPERVISOR_ROLE;
    }

    public function isEmployee(){
        return $this->role === self::EMPLOYEE_ROLE;
    }
}


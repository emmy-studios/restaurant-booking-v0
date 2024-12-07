<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Countries;
use App\Models\Notice;
use App\Models\Events\Event;
use App\Models\Orders\Billing;
use App\Models\Orders\Order;
use App\Models\Reports\InventoryReport;
use App\Models\Reports\Report;
use App\Models\Reviews\Review;
use App\Models\Sales\Sale;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Enums\Gender;
use App\Enums\Roles;
use App\Models\Employees\Absence;
use App\Models\Employees\Overtime;
use App\Models\Reservations\Reservation;
use App\Models\UserNotification;
use App\Models\Shoppingcarts\Shoppingcart;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE = 'ADMIN';
    const MANAGER_ROLE = 'MANAGER';
    const CUSTOMER_ROLE = 'CUSTOMER';
    const CHEF_ROLE = 'CHEF';
    const EMPLOYEE_ROLE = 'EMPLOYEE';

    const ROLES = [
        self::ADMIN_ROLE => 'admin',
        self::MANAGER_ROLE => 'manager',
        self::CUSTOMER_ROLE => 'customer',
        self::CHEF_ROLE => 'chef',
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
        'identification_code',
        'identification_number',
        'birth',
        'country_code',
        'phone_number',
        'gender',
        'postal_code',
        'country',
        'city',
        'address',
        'email',
        'image_url',
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
        'gender' => Gender::class,
        //'role' => Roles::class,
        'country' => Countries::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        if ($panelId === 'admin') {
            return $this->isAdmin();
        }

        if ($panelId === 'employee') {
            return $this->isEmployee();
        }

        if ($panelId === 'chef') {
            return $this->isChef();
        }

        if ($panelId === 'customer') {
            return $this->isCustomer();
        }

        if ($panelId === 'manager') {
            return $this->isManager();
        }

        return false;
    }

    public function isAdmin(){
        return $this->role === self::ADMIN_ROLE;
    }

    public function isManager(){
        return $this->role === self::MANAGER_ROLE;
    }

    public function isEmployee(){
        return $this->role === self::EMPLOYEE_ROLE;
    }

    public function isCustomer(){
        return $this->role === self::CUSTOMER_ROLE;
    }

    public function isChef(){
        return $this->role === self::CHEF_ROLE;
    }

    // Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function inventoryReports(): HasMany
    {
        return $this->hasMany(InventoryReport::class);
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function shoppingcarts(): HasOne
    {
        return $this->hasOne(Shoppingcart::class);
    }

    // Overtime Relationships
    public function approvedOvertimes(): HasMany
    {
        return $this->hasMany(Overtime::class, 'approved_by');
    }

    // Absences Relationships
    public function approvedAbsences(): HasMany
    {
        return $this->hasMany(Absence::class, 'approved_by');
    }

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

}


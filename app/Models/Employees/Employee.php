<?php

namespace App\Models\Employees;

use App\Models\Employees\Salary;
use App\Models\Employees\Schedule;
use App\Models\Employees\Attendance;
use App\Models\Employees\Vacation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'postal_code',
        'phone_code',
        'phone_number',
        'country',
        'city',
        'address',
        'date_of_birth',
        'hire_date',
        'social_security_number',
        'job_title',
        'department',
        'contract_type',
        'secondary_email',
        'emergency_contact_name',
        'emergency_contact_phone',
        'id_number',
        'work_permit',
        'tax_id_number',
        'status',
        'supervisor',
        'fire_date',
        'termination_date',
        'last_promotion_date',
        'last_promotion_role',
        'role',
        'bank_name',
        'account_number',
        'account_type',
        'bank_code',
        'routing_number',
        'iban',
    ];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function vacations(): HasMany
    {
        return $this->hasMany(Vacation::class);
    }

    
} 

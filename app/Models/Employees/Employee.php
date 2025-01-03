<?php

namespace App\Models\Employees;

use App\Models\Employees\Salary;
use App\Models\Employees\Schedule;
use App\Models\Employees\Attendance;
use App\Models\Employees\Vacation;
use App\Models\Employees\EmployeeTask;
use App\Models\Employees\Absence;
use App\Models\Employees\Overtime;
use App\Models\Employees\SalaryPayment;
use App\Models\Inventories\InventoryMovement;
use App\Models\Purchases\Purchase;
use App\Models\Returns\ReturnRequest;
use App\Models\Sales\Sale;
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
        'identification_code',
        'id_number',
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

    protected $casts = [
        'account_type',
        'phone_code',
        'country',
        'contract_type',
        'status',
        'role',
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

    public function employeeTasks(): HasMany
    {
        return $this->hasMany(EmployeeTask::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }
    public function aprovedAbsences(): HasMany
    {
        return $this->hasMany(Absence::class, 'approved_by');
    }

    public function overtimes(): HasMany
    {
        return $this->hasMany(Overtime::class, 'approved_by');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'purchase_supervisor');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function inventoryMovements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function returnRequests(): HasMany
    {
        return $this->hasMany(ReturnRequest::class);
    }

    public function supervisedTasks(): HasMany
    {
        return $this->hasMany(EmployeeTask::class, 'supervisor_id');
    }

    public function approvedSalaryPayments(): HasMany
    {
        return $this->hasMany(SalaryPayment::class, 'approved_by');
    }
}

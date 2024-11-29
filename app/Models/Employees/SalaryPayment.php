<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employees\Employee;

class SalaryPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'payment_code',
        'payment_date',
        'salary_type',
        'payment_method',
        'currency',
        'base_salary',
        'overtime_payment',
        'bonus_payment',
        'tax_deductions',
        'insurance_deductions',
        'other_deductions',
        'deductions_total',
        'net_salary',
        'total_overtime_hours',
        'total_absences',
        'total_hours_worked',
        'payment_status',
        'employee_confirmation',
        'approved_by',
        'approver_comment',
    ];

    protected $casts = [
        'salary_type',
        'payment_method',
        'currency',
        'payment_status',
        'employee_confirmation',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

}

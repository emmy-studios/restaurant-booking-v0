<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Employees\Employee;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'overtime_date',
        'start_time',
        'end_time',
        'number_of_hours',
        'reason',
        'status',
        'overtime_type',
        'approved_by',
        'payment_method',
        'payment_currency',
        'hourly_rate',
        'total_payment',
    ];

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

}

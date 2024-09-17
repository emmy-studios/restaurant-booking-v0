<?php

namespace App\Models\Employees;

use App\Models\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'check_in_time',
        'check_out_time',
        'total_work_hours',
        'overtime_hours',
        'overtime_rate',
        'lunch_break_duration',
        'is_holiday',
        'is_weekend',
        'notes',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

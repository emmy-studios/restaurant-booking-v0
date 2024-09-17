<?php

namespace App\Models\Employees;

use App\Models\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'shift_start_time',
        'shift_end_time',
        'work_shift',
        'work_type',
        'total_work_hours',
        'lunch_break_duration',
        'overtime_hours',
        'overtime_rate',
        'schedule_start_date',
        'schedule_end_date',
        'modified_date',
        'notes',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

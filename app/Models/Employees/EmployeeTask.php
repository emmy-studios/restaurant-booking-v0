<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Employees\Employee;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'task_name',
        'description',
        'additional_details',
        'status',
        'due_date',
        'is_read',
        'supervisor_id',
        'supervisor_comment',
        'employee_notes',
    ];

    protected $casts = [
        'status',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

}

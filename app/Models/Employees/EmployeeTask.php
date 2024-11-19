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
    ];

    protected $casts = [
        'status',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

}

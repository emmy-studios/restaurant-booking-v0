<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Employees\Employee;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'start_date', 
        'end_date',
        'justified',
        'reason',
        'details',
        'absence_type',
        'approved_by',
    ];

    protected $casts = [
        'absence_type',
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

<?php

namespace App\Models\Employees;

use App\Models\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'number_of_days',
        'start_date',
        'end_date',
        'notes',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

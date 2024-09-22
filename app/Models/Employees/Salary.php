<?php

namespace App\Models\Employees;

use App\Models\Employees\Employee;
use App\Models\Employees\Bonus;
use App\Models\Employees\Deduction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'currency_code',
        'currency_symbol',
        'base_salary',
        'net_salary',
        'salary_type',
        'effective_date',
        'end_date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    public function deductions(): HasMany
    {
        return $this->hasMany(Deduction::class);
    }
}

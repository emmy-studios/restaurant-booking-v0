<?php

namespace App\Models\Employees;

use App\Models\Employees\Salary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_id',
        'amount',
        'type',
        'description',
        'date_applied',
    ];

    public function salary(): BelongsTo
    {
        return $this->belongsTo(salary::class);
    }
}

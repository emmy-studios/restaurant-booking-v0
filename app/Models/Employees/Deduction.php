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
        'currency_symbol',
        'amount',
        'type',
        'description',
        'date_applied',
    ];

    protected $casts = [
        'currency_symbol',
    ];

    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class);
    }
}

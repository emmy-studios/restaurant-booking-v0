<?php

namespace App\Models\Returns;

use App\Models\Employees\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'product_name',
        'user_id',
        'employee_id',
        'request_date',
        'quantity',
        'reason',
        'status',
    ];

    protected $casts = [
        'status'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

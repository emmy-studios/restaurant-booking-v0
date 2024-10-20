<?php

namespace App\Models\Sales;

use App\Models\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_code',
        'employee_id',
        'customer_name',
        'customer_email',
        'phone_code',
        'customer_phone_number',
        'sale_source',
        'currency_symbol', 
        'subtotal',
        'total',
    ];

    protected $casts = [
        'phone_code',
        'sale_source',
        'currency_symbol',
    ];

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

}

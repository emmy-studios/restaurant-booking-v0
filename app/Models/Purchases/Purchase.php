<?php

namespace App\Models\Purchases;

use App\Models\Employees\Employee;
use App\Models\Purchases\PurchaseItem;
use App\Models\Suppliers\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'currency_symbol',
        'subtotal',
        'total',
        'total_amount', 
        'purchase_datetime',
        'purchase_supervisor',
    ];

    protected $casts = [
        'currency_symbol',
    ];

    public function purchase_items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'purchase_supervisor');
    }
} 

<?php

namespace App\Models\Reports;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'inventory_location',
        'currency_symbol',
        'total_stock_value',
        'total_items_in_stock',
        'total_expired_items',
        'items_expiring_soon',
        'most_used_items', 
        'least_used_items',
        'total_used_items_value',
        'restock_needed_items',
        'stock_wastage',
        'stock_wastage_value',
        'last_audit_date',
        'next_audit_date',
        'user_id',
        'report_notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

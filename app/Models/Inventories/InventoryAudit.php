<?php

namespace App\Models\Inventories;

use App\Models\Inventories\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'audited_value',
        'audited_quantity',
        'audited_by',
        'audit_date',
        'remarks',
        'additional_details',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
} 

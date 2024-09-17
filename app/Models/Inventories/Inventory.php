<?php

namespace App\Models\Inventories;

use App\Models\Inventories\InventoryItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_quantity',
        'last_restocked_at',
        'next_restock_date',
        'inventory_value',
        'warehouse_location',
        'storage_conditions',
        'holding_cost',
        'cost_of_goods_sold',
        'last_audit_date',
        'next_audit_date',
        'inventory_status',
        'inventory_manager',
        'description',
        'notes',
    ];

    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }
}

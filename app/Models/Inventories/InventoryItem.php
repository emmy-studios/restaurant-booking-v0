<?php

namespace App\Models\Inventories;

use App\Models\Recipes\Ingredient;
use App\Models\Inventories\Inventory;
use App\Models\Inventories\InventoryMovement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'inventory_id',
        'barcode',
        'sku',
        'batch_number',
        'expiration_date',
        'unit_of_measurement',
        'quantity',
        'currency',
        'unit_price',
    ];

    protected $casts = [
        'unit_of_measurement',
        'currency',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    public function inventoryMovements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }
}

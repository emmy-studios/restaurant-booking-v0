<?php

namespace App\Models\Inventories;

use App\Models\Recipes\Ingredient;
use App\Models\Inventories\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    use HasFactory; 

    protected $fillable = [
        'ingredient_id',
        'inventory_id',
        'batch_number',
        'expiration_date',
        'unit_of_measurement',
        'quantity',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}

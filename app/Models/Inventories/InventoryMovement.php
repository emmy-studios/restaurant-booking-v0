<?php

namespace App\Models\Inventories;

use App\Models\Employees\Employee;
use App\Models\Inventories\Inventory;
use App\Models\Inventories\InventoryItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryMovement extends Model
{
    use HasFactory; 

    protected $fillable = [
        'inventory_id',
        'inventory_item_id',
        'movement_type',
        'quantity',
        'previous_quantity',
        'new_quantity',
        'reason',
        'employee_id',
    ]; 

    protected $casts = [
        'movement_type',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

}

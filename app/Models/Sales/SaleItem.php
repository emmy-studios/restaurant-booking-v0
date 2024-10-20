<?php

namespace App\Models\Sales;

use App\Models\Products\Product;
use App\Models\Sales\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id', 
        'discount_percentage',
        'unit_of_measurement',
        'quantity',
        'description',
        'notes',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'unit_of_measurement',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

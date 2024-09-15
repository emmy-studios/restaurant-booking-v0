<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Orders\Order;
use App\Models\Products\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'subtotal',
        'total',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    } 

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

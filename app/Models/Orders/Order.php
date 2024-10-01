<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orders\OrderItem;
use App\Models\Orders\Billing;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'order_status',
        'order_currency',
        'currency_symbol',
        'order_source',
        'subtotal',
        'total',
    ];

    // Relationships
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    } 

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }
}

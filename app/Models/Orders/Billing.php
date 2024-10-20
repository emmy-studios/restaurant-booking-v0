<?php

namespace App\Models\Orders;

use App\Models\User;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'order_id',
        'billing_code',
        'payment_method',
        'currency_symbol',
        'status',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'status',
        'payment_method',
        'currency_symbol',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

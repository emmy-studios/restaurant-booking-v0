<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'reason',
        'additional_details',
    ];

    protected $casts = [
        'status',
    ];

}

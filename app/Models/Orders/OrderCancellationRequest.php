<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class OrderCancellationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'reason',
        'additional_details',
    ];

    protected $casts = [
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

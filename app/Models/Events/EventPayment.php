<?php

namespace App\Models\Events;

use App\Models\Events\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPayment extends Model
{
    use HasFactory; 

    protected $fillable = [
        'event_id',
        'payment_method',
        'currency_symbol',
        'payment_amount',
        'payment_status',
    ];

    protected $casts = [
        'currency_symbol',
        'payment_method',
        'payment_status',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}

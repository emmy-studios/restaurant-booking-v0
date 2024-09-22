<?php

namespace App\Models\Events;

use App\Models\Events\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventService extends Model
{
    use HasFactory; 

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'details',
        'additional_details',
        'currency_code',
        'currency_symbol',
        'service_price',
        'additional_cost',
        'additional_cost_details', 
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}

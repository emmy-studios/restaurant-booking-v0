<?php

namespace App\Models\Events;

use App\Models\Events\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EventPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'details',
        'additional_details',
        'notes',
        'currency_code',
        'currency_symbol',
        'subtotal',
        'total',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}

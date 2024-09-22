<?php

namespace App\Models\Events;

use App\Models\User;
use App\Models\Events\EventPayment;
use App\Models\Events\EventPackage;
use App\Models\Events\EventService;
use App\Models\Events\Staff;
use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory; 

    protected $fillable = [
        'event_code',
        'user_id',
        'event_name',
        'event_date',
        'number_of_guests',
        'event_description',
        'event_status',
        'currency_code',
        'currency_symbol',
        'subtotal_cost',
        'total_cost',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eventPayments(): HasMany
    {
        return $this->hasMany(EventPayment::class);
    }

    public function eventPackages(): BelongsToMany
    {
        return $this->belongsToMany(EventPackage::class);
    }

    public function eventServices(): HasMany
    {
        return $this->hasMany(EventService::class);
    }

    public function staffs(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class);
    }

    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class);
    }
}

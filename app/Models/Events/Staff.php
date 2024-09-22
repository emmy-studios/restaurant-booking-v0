<?php

namespace App\Models\Events;

use App\Models\Events\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'emergency_contact',
        'emergency_contact_number',
        'role',
        'shift_start',
        'shift_end',
        'check_in_time',
        'check_out_time',
        'hours_worked',
        'need_uniform',
        'meal_preferences',
        'transport_provided',
        'training_required',
        'training_completed',
        'location_assigned',
        'notes',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
} 

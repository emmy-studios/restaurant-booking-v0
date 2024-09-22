<?php

namespace App\Models\Tables;

use App\Models\Events\Event;
use App\Models\Reservations\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Table extends Model
{
    use HasFactory; 

    protected $fillable = [
        'table_number',
        'capacity',
        'location',
        'is_available',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }
}

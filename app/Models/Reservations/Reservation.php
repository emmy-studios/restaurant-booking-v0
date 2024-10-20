<?php

namespace App\Models\Reservations;

use App\Models\Reservations\ReservationPayment;
use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_date',
        'number_of_guests',
        'special_requests',
        'status',
    ];

    protected $casts = [
        'status',
    ];

    public function reservationPayments(): HasMany
    {
        return $this->hasMany(ReservationPayment::class);
    } 

    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class);
    }
} 

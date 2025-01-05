<?php

namespace App\Models\Reservations;

use App\Models\Reservations\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'payment_method',
        'currency_symbol',
        'payment_amount',
        'payment_status',
        'payment_code',
    ];

    protected $casts = [
        'currency_symbol',
        'payment_status',
        'payment_method',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}

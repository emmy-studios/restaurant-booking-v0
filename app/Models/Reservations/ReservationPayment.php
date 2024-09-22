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
        'currency_code',
        'payment_amount',
        'payment_status',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}

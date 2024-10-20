<?php

namespace App\Models\Currencies;

use App\Models\Products\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_symbol',
        'currency_name',
        'notes',
    ];

    protected $casts = [
        'currency_symbol',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}

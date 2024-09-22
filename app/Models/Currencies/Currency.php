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
        'currency_code',
        'currency_name',
        'notes',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

}

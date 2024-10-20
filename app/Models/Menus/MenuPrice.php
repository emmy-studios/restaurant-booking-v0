<?php

namespace App\Models\Menus;

use App\Models\Menus\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'currency_symbol',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'currency_symbol',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}

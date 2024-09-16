<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menus\Menu;

class MenuSpecial extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'discount_percentage',
        'discount_code',
        'start_at',
        'end_at',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}

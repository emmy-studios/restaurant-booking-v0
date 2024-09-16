<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menus\Menu;

class MenuSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}

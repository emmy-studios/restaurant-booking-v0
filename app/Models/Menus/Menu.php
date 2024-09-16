<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Menus\MenuSchedule;
use App\Models\Menus\MenuItem;
use App\Models\Menus\MenuSpecial;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'menu_code',
        'status',
        'is_recurring',
        'menu_type',
        'initial_date',
        'final_date',
        'menu_availability',
        'price',
    ];

    public function menu_schedules(): HasMany
    {
        return $this->hasMany(MenuSchedule::class);
    }

    public function menu_items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function menu_specials(): HasMany
    {
        return $this->hasMany(MenuSpecial::class);
    }
}

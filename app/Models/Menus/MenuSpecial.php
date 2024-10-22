<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menus\Menu;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuSpecial extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id', 
        'product_id',
        'discount_percentage',
        'discount_code', 
        'start_at',
        'end_at',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}

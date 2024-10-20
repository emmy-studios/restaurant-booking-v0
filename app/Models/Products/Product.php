<?php

namespace App\Models\Products;

use App\Models\Discounts\Discount;
use App\Models\Menus\MenuItem;
use App\Models\Orders\OrderItem;
use App\Models\Products\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Products\Category;
use App\Models\Recipes\Recipe;
use App\Models\Sales\SaleItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'image_url', 
        'portion',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}

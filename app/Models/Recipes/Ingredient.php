<?php

namespace App\Models\Recipes;

use App\Models\Inventories\InventoryItem;
use App\Models\Sections\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Recipes\Recipe;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
    ];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }
}

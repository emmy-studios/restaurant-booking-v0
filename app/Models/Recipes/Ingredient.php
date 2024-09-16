<?php

namespace App\Models\Recipes;

use App\Models\Inventories\Inventory;
use App\Models\Sections\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Recipes\Recipe;

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

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class);
    }
}

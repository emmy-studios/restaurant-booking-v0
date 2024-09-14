<?php

namespace App\Models\Discounts;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_code',
        'discount_percentage',
        'start_at',
        'end_at',
        'banner_text',
        'banner_image',
        'description',
        'additional_details',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

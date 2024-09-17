<?php

namespace App\Models\Suppliers;

use App\Models\Purchases\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'phone_code',
        'phone_number',
        'email',
        'country',
        'city',
        'address',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

}
 
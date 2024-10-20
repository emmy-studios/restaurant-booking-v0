<?php

namespace App\Models\Reports;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailySaleReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'total_orders', 
        'total_sales',
        'sales_currency_symbol',
        'sales_subtotal',
        'sales_discounts_applied',
        'discount_total_amount',
        'total_net_amount',
        'details',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'sales_currency_symbol',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

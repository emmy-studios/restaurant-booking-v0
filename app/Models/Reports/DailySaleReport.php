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
        'total_amount',
        'total_discounts',
        'total_net_amount',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

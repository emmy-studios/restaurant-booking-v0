<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'report_type', 
        'content',
        'details',
        'additional_details',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}

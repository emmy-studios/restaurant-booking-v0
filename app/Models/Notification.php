<?php

namespace App\Models;

use App\Enums\NotificationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'title',
        'message',
        'notification_type',
        'is_read',
        'data',
        'redirect_url',
    ];

    protected $casts = [
        'notification_type' => NotificationType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

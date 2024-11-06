<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum NotificationType: string implements HasLabel, HasColor
{
    case ORDER = 'Order';
    case INFORMATION = 'Information';
    case ADVICE = 'Advice';
    case ADVERTISEMENT = 'Advertisement';
    case PROMOTION = 'Promotion';
    case SYSTEM = 'System';
    case EMPLOYEE = 'Employee';
    case FEEDBACK = 'Feedback';
    case RESERVATION = 'Reservation';
    case REMINDER = 'Reminder';
    case WARNING = 'Warning';

    public function getLabel(): ?string
    {
        return match($this){
            self::ORDER => 'Order',
            self::INFORMATION => 'Information',
            self::ADVICE => 'Advice',
            self::ADVERTISEMENT => 'Advertisement',
            self::PROMOTION => 'Promotion',
            self::SYSTEM => 'System',
            self::EMPLOYEE => 'Employee',
            self::FEEDBACK => 'Feedback',
            self::RESERVATION => 'Reservation',
            self::REMINDER => 'Reminder',
            self::WARNING => 'Warning'
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::ORDER => 'warning',
            self::ADVERTISEMENT => 'warning',
            self::INFORMATION => 'info',
            self::ADVICE => 'success',
            self::PROMOTION => 'info',
            self::SYSTEM => 'danger',
            self::EMPLOYEE => 'success',
            self::FEEDBACK => 'warning',
            self::RESERVATION => 'info',
            self::REMINDER => 'danger',
            self::WARNING => 'danger',
        };
    }
}

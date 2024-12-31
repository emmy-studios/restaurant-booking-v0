<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderCancellationStatus: string implements HasLabel, HasColor, HasIcon
{
    case CANCELED = 'Canceled';
    case PROCESSING = 'Processing';
    case APPROVED = 'Approved';

    public function getLabel(): ?string
    {
        /*return match($this){
            self::CANCELED => 'Canceled',
            self::PROCESSING => 'Processing',
            self::APPROVED => 'Approved',
        };*/
        return __("enums.order_cancellation_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::CANCELED => 'danger',
            self::PROCESSING => 'info',
            self::APPROVED => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::CANCELED => 'heroicon-o-x-circle',
            self::PROCESSING => 'heroicon-o-clock',
            self::APPROVED => 'heroicon-o-hand-thumb-up',
        };
    }

}

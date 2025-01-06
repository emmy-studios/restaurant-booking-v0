<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EventStatus: string implements HasLabel, HasColor, HasIcon
{
    case CONFIRMED = 'Confirmed';
    case CANCELED = 'Canceled';
    case FINISHED = 'Finished';
    case WAITING = 'Waiting';

    public function getLabel(): ?string
    {
        return __("enums.event_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::CONFIRMED => 'info',
            self::CANCELED => 'danger',
            self::FINISHED => 'success',
            self::WAITING => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::CANCELED => 'heroicon-o-x-circle',
            self::FINISHED => 'heroicon-o-hand-thumb-up',
            self::WAITING => 'heroicon-o-ellipsis-horizontal-circle',
        };
    }

}

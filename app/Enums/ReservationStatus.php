<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

use function PHPSTORM_META\map;

enum ReservationStatus: string implements HasLabel, HasColor, HasIcon
{
    case CONFIRMED = 'Confirmed';
    case CANCELED = 'Canceled';
    case FINISHED = 'Finished';
    case WAITING = 'Waiting';
    case PENDING = 'Pending';

    public function getLabel(): ?string
    {
        return match($this){
            self::CONFIRMED => 'Confirmed',
            self::CANCELED => 'Canceled',
            self::FINISHED => 'Finished',
            self::WAITING => 'Waiting',
            self::PENDING => 'Pending',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::CONFIRMED => 'success',
            self::CANCELED => 'danger',
            self::FINISHED => 'info',
            self::WAITING => 'gray',
            self::PENDING => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::CANCELED => 'heroicon-o-x-circle',
            self::FINISHED => 'heroicon-o-hand-thumb-up',
            self::WAITING => 'heroicon-o-clock',
            self::PENDING => 'heroicon-o-ellipsis-horizontal-circle',
        };
    }

}
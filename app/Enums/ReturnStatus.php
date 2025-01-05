<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ReturnStatus: string implements HasLabel, HasColor, HasIcon
{
    case CANCELED = 'Canceled';
    case CONFIRMED = 'Confirmed';
    case PROCESSING = 'Processing';
    case SUCCESSFULLY = 'Successfully';

    public function getLabel(): ?string
    {
        return __("enums.return_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::CANCELED => 'danger',
            self::CONFIRMED => 'info',
            self::PROCESSING => 'gray',
            self::SUCCESSFULLY => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::CANCELED => 'heroicon-o-x-circle',
            self::CONFIRMED => 'heroicon-o-check-circle',
            self::PROCESSING => 'heroicon-o-clock',
            self::SUCCESSFULLY => 'heroicon-o-hand-thumb-up',
        };
    }

}

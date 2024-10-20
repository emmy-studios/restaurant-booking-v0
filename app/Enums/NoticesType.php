<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum NoticesType: string implements HasLabel, HasColor
{
    case WARNING = 'Warning';
    case INFORMATION = 'Information';
    case ADVICE = 'Advice';
    case ADVERTISEMENT = 'Advertisement';

    public function getLabel(): ?string
    {
        return match($this){
            self::WARNING => 'Warning',
            self::INFORMATION => 'Information',
            self::ADVICE => 'Advice',
            self::ADVERTISEMENT => 'Advertisement',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::WARNING => 'danger',
            self::ADVERTISEMENT => 'warning',
            self::INFORMATION => 'info',
            self::ADVICE => 'success',
        };
    }
}
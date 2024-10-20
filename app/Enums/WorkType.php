<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum WorkType: string implements HasLabel, HasIcon, HasColor
{
    case REMOTE = 'Remote';
    case ONSITE = 'On-site';
    case HYBRID = 'Hybrid';                 

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::REMOTE => 'heroicon-o-globe-americas',
            self::ONSITE => 'heroicon-o-building-office',
            self::HYBRID => 'heroicon-o-arrows-pointing-in',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::REMOTE => 'success',
            self::ONSITE => 'danger',
            self::HYBRID => 'warning',
        };
    }

}
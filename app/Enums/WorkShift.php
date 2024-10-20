<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum WorkShift: string implements HasLabel, HasColor, HasIcon
{
    case MORNING = 'Morning';            
    case AFTERNOON = 'Afternoon';
    case NIGHT = 'Night';
    case FLEXIBLE = 'Flexible';       

    public function getLabel(): ?string
    {
        return match($this){
            self::MORNING => 'Morning',
            self::AFTERNOON => 'Afternoon',
            self::NIGHT => 'Night',
            self::FLEXIBLE => 'Flexible',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::MORNING => 'success',
            self::AFTERNOON => 'warning',
            self::NIGHT => 'danger',
            self::FLEXIBLE => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::MORNING => 'heroicon-o-sun',
            self::AFTERNOON => 'heroicon-o-clock',
            self::NIGHT => 'heroicon-o-moon',
            self::FLEXIBLE => 'heroicon-o-calendar-days'
        };
    }

}
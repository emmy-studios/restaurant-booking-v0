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
    case SPLIT = 'Split';
    case ROTATING = 'Rotating';
    case WEEKEND = 'Weekend';
    case ON_CALL = 'On-call';
    case GRAVEYARD = 'Graveyard';
    case HALF_DAY = 'Half-day';
    case CUSTOM = 'Custom';
    case PROJECT_BASED = 'Project-based';
    case SEASONAL = 'Seasonal';

    public function getLabel(): ?string
    {
        return __("enums.work_shift.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::MORNING => 'success',
            self::AFTERNOON => 'warning',
            self::NIGHT => 'danger',
            self::FLEXIBLE => 'info',
            self::SPLIT => 'primary',
            self::ROTATING => 'secondary',
            self::WEEKEND => 'purple',
            self::ON_CALL => 'yellow',
            self::GRAVEYARD => 'gray',
            self::HALF_DAY => 'blue',
            self::CUSTOM => 'cyan',
            self::PROJECT_BASED => 'green',
            self::SEASONAL => 'orange',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::MORNING => 'heroicon-o-sun',
            self::AFTERNOON => 'heroicon-o-clock',
            self::NIGHT => 'heroicon-o-moon',
            self::FLEXIBLE => 'heroicon-o-calendar-days',
            self::SPLIT => 'heroicon-o-adjustments',
            self::ROTATING => 'heroicon-o-refresh',
            self::WEEKEND => 'heroicon-o-sparkles',
            self::ON_CALL => 'heroicon-o-phone',
            self::GRAVEYARD => 'heroicon-o-shield-exclamation',
            self::HALF_DAY => 'heroicon-o-sunrise',
            self::CUSTOM => 'heroicon-o-pencil',
            self::PROJECT_BASED => 'heroicon-o-briefcase',
            self::SEASONAL => 'heroicon-o-cloud-sun',
        };
    }

}

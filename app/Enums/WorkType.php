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
    case FIELD = 'Field Work';             // Trabajo de campo o en sitio específico
    case SHIFT = 'Shift Work';             // Trabajo por turnos
    case FREELANCE = 'Freelance';          // Autónomo o independiente
    case CONTRACT = 'Contract Work';       // Trabajo por contrato temporal
    case INTERN = 'Internship';            // Pasantía o prácticas
    case CONSULTING = 'Consulting';        // Trabajo como consultor
    case PROJECT_BASED = 'Project-based';  // Basado en proyectos específicos
    case PART_TIME = 'Part-time';          // Trabajo de medio tiempo
    case FULL_TIME = 'Full-time';          // Trabajo de tiempo completo
    case TEMPORARY = 'Temporary';          // Trabajo temporal
    case SEASONAL = 'Seasonal';            // Trabajo estacional (ej. vacaciones)
    case VOLUNTEER = 'Volunteer';

    public function getLabel(): ?string
    {
        return __("enums.work_type.{$this->value}");
    }

    public function getIcon(): ?string
    {
        return match($this) {
            self::REMOTE => 'heroicon-o-globe-americas',
            self::ONSITE => 'heroicon-o-building-office',
            self::HYBRID => 'heroicon-o-arrows-pointing-in',
            self::FIELD => 'heroicon-o-map',
            self::SHIFT => 'heroicon-o-clock',
            self::FREELANCE => 'heroicon-o-laptop',
            self::CONTRACT => 'heroicon-o-document',
            self::INTERN => 'heroicon-o-academic-cap',
            self::CONSULTING => 'heroicon-o-light-bulb',
            self::PROJECT_BASED => 'heroicon-o-briefcase',
            self::PART_TIME => 'heroicon-o-clock',
            self::FULL_TIME => 'heroicon-o-check-circle',
            self::TEMPORARY => 'heroicon-o-calendar-days',
            self::SEASONAL => 'heroicon-o-sun',
            self::VOLUNTEER => 'heroicon-o-heart',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this) {
            self::REMOTE => 'success',
            self::ONSITE => 'danger',
            self::HYBRID => 'warning',
            self::FIELD => 'primary',
            self::SHIFT => 'info',
            self::FREELANCE => 'secondary',
            self::CONTRACT => 'gray',
            self::INTERN => 'lime',
            self::CONSULTING => 'teal',
            self::PROJECT_BASED => 'green',
            self::PART_TIME => 'blue',
            self::FULL_TIME => 'cyan',
            self::TEMPORARY => 'orange',
            self::SEASONAL => 'yellow',
            self::VOLUNTEER => 'purple',
        };
    }

}

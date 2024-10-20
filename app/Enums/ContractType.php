<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContractType: string implements HasLabel, HasColor
{
    case PERMANENT = 'Permanent';
    case TEMPORARY = 'Temporary';
    case FREELANCE = 'Freelance';
    case INTERN = 'Intern';
    case CONTRACTOR = 'Contractor';
    case PART_TIME = 'Part-Time';
    case CONSULTANT = 'Consultant';
    case SEASONAL = 'Seasonal';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::PERMANENT => "success",
            self::TEMPORARY => "danger",
            self::FREELANCE => "warning",
            self::INTERN => "warning",
            self::CONTRACTOR => "danger",
            self::PART_TIME => "warning",
            self::CONSULTANT => "danger",
            self::SEASONAL => "warning",
        };
    }

}

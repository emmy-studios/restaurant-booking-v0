<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EmployeeStatus: string implements HasLabel, HasColor
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case TERMINATED = 'Terminated';
    case ONLEAVE = 'OnLeave';
    case ONVACATION = "On Vacation";

    public function getLabel(): ?string
    {
        return __("enums.employee_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
            self::TERMINATED => 'danger',
            self::ONLEAVE => 'info',
            self::ONVACATION => 'warning',
        };
    }

}

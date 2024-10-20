<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OvertimeStatus: string implements HasLabel, HasColor, HasIcon
{
    case APROVED = "Aproved";
    case PENDING = "Pending";
    case REJECTED = "Rejected";

    public function getLabel(): ?string
    {
        return $this->value;
    } 

    public function getColor(): string|array|null
    {
        return match($this){
            self::APROVED => "success",
            self::PENDING => "warning",
            self::REJECTED => "danger",
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::APROVED => 'heroicon-o-check-circle',
            self::PENDING => 'heroicon-o-ellipsis-horizontal-circle',
            self::REJECTED => 'heroicon-o-x-circle'
        };
    }
}
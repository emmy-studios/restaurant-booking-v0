<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OvertimeStatus: string implements HasLabel, HasColor, HasIcon
{
    case APPROVED = "Approved"; // Aprobado
    case PENDING = "Pending"; // Pendiente
    case REJECTED = "Rejected"; // Rechazado
    case IN_REVIEW = "In Review"; // En revisión
    case CANCELLED = "Cancelled"; // Cancelado
    case PAID = "Paid"; // Pagado
    case UNPAID = "Unpaid"; // No pagado
    case EXPIRED = "Expired"; // Caducado

    public function getLabel(): ?string
    {
        return __("enums.overtime_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::APPROVED => "success",
            self::PENDING => "warning",
            self::REJECTED => "danger",
            self::IN_REVIEW => "info",
            self::CANCELLED => "secondary",
            self::PAID => "success",
            self::UNPAID => "warning",
            self::EXPIRED => "danger",
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::APPROVED => 'heroicon-o-check-circle',
            self::PENDING => 'heroicon-o-ellipsis-horizontal-circle',
            self::REJECTED => 'heroicon-o-x-circle',
            self::IN_REVIEW => 'heroicon-o-information-circle',
            self::CANCELLED => 'heroicon-o-ban',
            self::PAID => 'heroicon-o-currency-dollar',
            self::UNPAID => 'heroicon-o-currency-dollar-off',
            self::EXPIRED => 'heroicon-o-clock',
        };
    }
}

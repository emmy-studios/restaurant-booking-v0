<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum InventoryStatus: string implements HasLabel, HasColor
{
    case ACTIVE = 'Active';
    case LOW_STOCK = 'Low Stock';
    case OUT_OF_STOCK = 'Out of Stock';
    case RESTOCKING = 'Restocking';
    case DISCONTINUED = 'Discontinued';
    case DAMAGED = 'Damaged';
    case PENDING_AUDIT = 'Pending Audit';
    case UNDER_REVIEW = 'Under Review';
    case RESERVED = 'Reserved';

    public function getLabel(): ?string
    {
        return __("enums.inventory_status.{$this->value}");
    }

    public function getColor(): string | array | null
    {
        return match($this){
            self::ACTIVE => 'success',
            self::LOW_STOCK => 'warning',
            self::OUT_OF_STOCK => 'danger',
            self::RESTOCKING => 'gray',
            self::DISCONTINUED => 'danger',
            self::DAMAGED => 'danger',
            self::PENDING_AUDIT => 'info',
            self::UNDER_REVIEW => 'info',
            self::RESERVED => 'info',
        };
    }
}

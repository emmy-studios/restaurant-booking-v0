<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum InventoryMovementType: string implements HasLabel, HasColor, HasIcon
{
    case ENTRY = 'Entry';
    case EXIT = 'Exit';
    case ADJUSTMENT = 'Adjustment';

    public function getLabel(): ?string
    {
        return match($this){
            self::ENTRY => 'Entry',
            self::EXIT => 'Exit',
            self::ADJUSTMENT => 'Adjustment',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::ENTRY => 'success',
            self::EXIT => 'danger',
            self::ADJUSTMENT => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::ENTRY => 'heroicon-o-arrow-right-end-on-rectangle',
            self::EXIT => 'heroicon-o-arrow-left-start-on-rectangle',
            self::ADJUSTMENT => 'heroicon-o-arrow-path-rounded-square',
        };
    }

}
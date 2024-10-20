<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TaskStatus: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'Pending';
    case IN_PROGRESS = 'In Progress';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';

    public function getLabel(): ?string
    {
        return match($this){
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::PENDING => 'warning',
            self::CANCELLED => 'danger',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::PENDING => 'heroicon-o-ellipsis-horizontal',
            self::IN_PROGRESS => 'heroicon-o-ellipsis-horizontal-circle',
            self::COMPLETED => 'heroicon-o-hand-thumb-up',
            self::CANCELLED => 'heroicon-o-hand-thumb-down',
        };
    }

}
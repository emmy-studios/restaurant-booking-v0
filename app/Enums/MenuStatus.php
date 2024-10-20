<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MenuStatus: string implements HasLabel, HasColor, HasIcon
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case DRAFT = 'Draft';
    case ARCHIVED = 'Archived';
    case UNAVAILABLE = 'Unavailable';

    public function getLabel(): ?string
    {
        return match($this){
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::DRAFT => 'Draft',
            self::ARCHIVED => 'Archived',
            self::UNAVAILABLE => 'Unavailable',
        }; 
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
            self::DRAFT => 'info',
            self::ARCHIVED => 'gray',
            self::UNAVAILABLE => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::ACTIVE => 'heroicon-o-check-circle',
            self::INACTIVE => 'heroicon-o-x-circle',
            self::DRAFT => 'heroicon-o-trash',
            self::ARCHIVED => 'heroicon-o-document-duplicate',
            self::UNAVAILABLE => 'heroicon-o-stop-circle',
        };
    }

}
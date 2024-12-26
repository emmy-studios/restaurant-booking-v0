<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;

enum Gender: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case MALE = "Male";
    case FEMALE = "Female";
    case OTHER = "Other";
    case PREFERNOTTOSAY = "Prefer Not To Say";

    public function getLabel(): ?string
    {

        return match($this){
            self::MALE => "Male",
            self::FEMALE => "Female",
            self::OTHER => "Other",
            self::PREFERNOTTOSAY => 'Prefer Not To Say',
        };
    }

    public function getDescription(): ?string
    {
        return match($this){
            self::MALE => "Masculine Sex Person",
            self::FEMALE => "Female Sex Person",
            self::OTHER => "Other Description",
            self::PREFERNOTTOSAY => "User Prefer Not To Say"
        };
    }

    public function getColor(): string | array | null
    {
        return match($this){
            self::MALE => "success",
            self::FEMALE => "warning",
            self::OTHER => "info",
            self::PREFERNOTTOSAY => "primary",
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::MALE => 'heroicon-o-arrow-left-circle',
            self::FEMALE => 'heroicon-o-arrow-right-circle',
            self::OTHER => 'heroicon-o-arrow-path',
            self::PREFERNOTTOSAY => 'heroicon-o-arrow-path-rounded-square',
        };
    }

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

}

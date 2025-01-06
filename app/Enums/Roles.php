<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use FIlament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;

enum Roles: string implements HasLabel, HasIcon, HasColor
{
    case ADMIN = 'Admin';
    case MANAGER = 'Manager';
    case CHEF = 'Chef';
    case EMPLOYEE = 'Employee';
    case CUSTOMER = 'Customer';

    public function getLabel(): ?string
    {
        /*return match($this){
            self::ADMIN => __('enums.Admin'),
            self::MANAGER => __('enums.Manager'),
            self::CHEF => __('enums.Chef'),
            self::EMPLOYEE => __('enums.Employee'),
            self::CUSTOMER => __('enums.Customer'),
        };*/
        return __("enums.roles.{$this->value}");
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::ADMIN => 'heroicon-o-wrench-screwdriver',
            self::MANAGER => 'heroicon-o-presentation-chart-bar',
            self::CHEF => 'heroicon-o-cake',
            self::EMPLOYEE => 'heroicon-o-identification',
           self::CUSTOMER => 'heroicon-o-user',
        };
    }

    public function getColor(): string | array | null
    {
        return match($this){
            self::ADMIN => 'danger',
            self::MANAGER => 'success',
            self::CHEF => 'warning',
            self::EMPLOYEE => 'gray',
            self::CUSTOMER => 'info',
        };
    }
}

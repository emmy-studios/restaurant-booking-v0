<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AccountType: string implements HasLabel, HasColor, HasIcon
{
    case SAVINGS = 'Savings';
    case CHECKING = 'Checking';
    case JOINT = 'Joint Account';
    case PAYROLL = 'Payroll Account';
    case STUDENT = 'Student Account';
    case BUSINESS = 'Business Checking';
    case MERCHANT = 'Merchant Account';
    case TRUST = 'Trust Account';
    case ESCROW = 'Escrow Account';
    case TREASURY = 'Treasury Account';
    case INVESTMENT = 'Investment Account';
    case RETIREMENT = 'Retirement Account';
    case MONEY_MARKET = 'Money Market Account';
    case CD = 'Certificate of Deposit';

    public function getLabel(): ?string
    {
        return __("enums.account_type.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this) {
            self::SAVINGS => 'success',
            self::CHECKING => 'primary',
            self::JOINT => 'secondary',
            self::PAYROLL => 'info',
            self::STUDENT => 'warning',
            self::BUSINESS => 'gray',
            self::MERCHANT => 'purple',
            self::TRUST => 'green',
            self::ESCROW => 'yellow',
            self::TREASURY => 'blue',
            self::INVESTMENT => 'teal',
            self::RETIREMENT => 'orange',
            self::MONEY_MARKET => 'lime',
            self::CD => 'brown',
        };
    }

    public function getIcon(): string
    {
        return match($this) {
            self::SAVINGS => 'heroicon-o-currency-dollar',
            self::CHECKING => 'heroicon-o-credit-card',
            self::JOINT => 'heroicon-o-user-group',
            self::PAYROLL => 'heroicon-o-banknotes',
            self::STUDENT => 'heroicon-o-academic-cap',
            self::BUSINESS => 'heroicon-o-briefcase',
            self::MERCHANT => 'heroicon-o-shopping-cart',
            self::TRUST => 'heroicon-o-shield-check',
            self::ESCROW => 'heroicon-o-key',
            self::TREASURY => 'heroicon-o-cash',
            self::INVESTMENT => 'heroicon-o-chart-bar',
            self::RETIREMENT => 'heroicon-o-clock',
            self::MONEY_MARKET => 'heroicon-o-globe-alt',
            self::CD => 'heroicon-o-document-text',
        };
    }
}

<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel, HasColor
{
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case SHIPPED = 'Shipped';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';
    case REFUNDED = 'Refunded';
    case FAILED = 'Failed';
    case ON_HOLD = 'On Hold';
    case AWAITING_PAYMENT = 'Awaiting Payment';
    case COMPLETED = 'Completed';

    public function getLabel(): ?string
    {
        /*return match($this){
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::SHIPPED => 'Shipped',
            self::DELIVERED => 'Delivered',
            self::CANCELLED => 'Cancelled',
            self::REFUNDED => 'Failed',
            self::ON_HOLD => 'On Hold',
            self::AWAITING_PAYMENT => 'Awaiting Payment',
            self::COMPLETED => 'Completed',
        }; */

        //return $this->value;
        return __("enums.order_status.{$this->value}");

    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::PENDING => 'info',
            self::PROCESSING => 'info',
            self::SHIPPED => 'success',
            self::DELIVERED => 'success',
            self::CANCELLED => 'danger',
            self::REFUNDED => 'warning',
            self::ON_HOLD => 'info',
            self::FAILED => 'danger',
            self::AWAITING_PAYMENT => 'info',
            self::COMPLETED => 'success',
        };
    }

}

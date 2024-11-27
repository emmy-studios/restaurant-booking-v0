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
    case REVIEW_PENDING = 'Review Pending';
    case REVIEWED = 'Reviewed';
    case APPROVED = 'Approved';
    case UNFINISHED = 'Unfinished';

    public function getLabel(): ?string
    {
        return __("enums.task_status.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::PENDING => 'warning',
            self::CANCELLED => 'danger',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
            self::REVIEW_PENDING => 'info',
            self::REVIEWED => 'success',
            self::APPROVED => 'success',
            self::UNFINISHED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match($this){
            self::PENDING => 'heroicon-o-pause-circle',
            self::IN_PROGRESS => 'heroicon-o-ellipsis-horizontal-circle',
            self::COMPLETED => 'heroicon-o-hand-thumb-up',
            self::CANCELLED => 'heroicon-o-x-circle',
            self::UNFINISHED => 'heroicon-o-face-frown',
            self::APPROVED => 'heroicon-o-hand-thumb-up',
            self::REVIEWED => 'heroicon-o-check-circle',
            self::REVIEW_PENDING => 'heroicon-o-exclamation-circle',
        };
    }

}

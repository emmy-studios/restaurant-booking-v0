<?php

namespace App\Filament\Resources\Discounts\DiscountResource\Pages;

use App\Filament\Resources\Discounts\DiscountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscount extends CreateRecord
{
    protected static string $resource = DiscountResource::class;

    public function getTitle(): string
    {
        return __('models.create_discount');
    }
}
 
<?php

namespace App\Filament\Resources\Currencies\CurrencyResource\Pages;

use App\Filament\Resources\Currencies\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCurrency extends CreateRecord
{
    protected static string $resource = CurrencyResource::class;

    public function getTitle(): string
    {
        return __('models.create_currency');
    }
} 

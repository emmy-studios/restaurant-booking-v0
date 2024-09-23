<?php

namespace App\Filament\Resources\Currencies\CurrencyResource\Pages;

use App\Filament\Resources\Currencies\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurrencies extends ListRecords
{
    protected static string $resource = CurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_currency')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.currencies');
    }
} 

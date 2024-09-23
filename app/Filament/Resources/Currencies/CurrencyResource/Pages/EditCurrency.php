<?php

namespace App\Filament\Resources\Currencies\CurrencyResource\Pages;

use App\Filament\Resources\Currencies\CurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurrency extends EditRecord
{
    protected static string $resource = CurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.edit_currency');
    }
}

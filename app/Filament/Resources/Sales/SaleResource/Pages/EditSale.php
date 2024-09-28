<?php

namespace App\Filament\Resources\Sales\SaleResource\Pages;

use App\Filament\Resources\Sales\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.edit_sale');
    }
}

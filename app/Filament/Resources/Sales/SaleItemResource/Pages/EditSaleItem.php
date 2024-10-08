<?php

namespace App\Filament\Resources\Sales\SaleItemResource\Pages;

use App\Filament\Resources\Sales\SaleItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaleItem extends EditRecord
{
    protected static string $resource = SaleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_item');
    }
} 

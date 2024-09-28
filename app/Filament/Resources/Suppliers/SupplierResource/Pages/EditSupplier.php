<?php

namespace App\Filament\Resources\Suppliers\SupplierResource\Pages;

use App\Filament\Resources\Suppliers\SupplierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupplier extends EditRecord
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.edit_supplier');
    }
}

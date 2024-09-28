<?php

namespace App\Filament\Resources\Suppliers\SupplierResource\Pages;

use App\Filament\Resources\Suppliers\SupplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_supplier')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.suppliers');
    } 
}

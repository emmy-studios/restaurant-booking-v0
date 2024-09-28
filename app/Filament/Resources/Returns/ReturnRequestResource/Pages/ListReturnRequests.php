<?php

namespace App\Filament\Resources\Returns\ReturnRequestResource\Pages;

use App\Filament\Resources\Returns\ReturnRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReturnRequests extends ListRecords
{
    protected static string $resource = ReturnRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_return')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.returns');
    }
}
 
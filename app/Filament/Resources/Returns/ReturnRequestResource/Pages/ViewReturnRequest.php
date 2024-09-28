<?php

namespace App\Filament\Resources\Returns\ReturnRequestResource\Pages;

use App\Filament\Resources\Returns\ReturnRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReturnRequest extends ViewRecord
{
    protected static string $resource = ReturnRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_return');
    }
}
 
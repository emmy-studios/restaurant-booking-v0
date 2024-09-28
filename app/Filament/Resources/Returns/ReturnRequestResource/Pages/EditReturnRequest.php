<?php

namespace App\Filament\Resources\Returns\ReturnRequestResource\Pages;

use App\Filament\Resources\Returns\ReturnRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReturnRequest extends EditRecord
{
    protected static string $resource = ReturnRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_return');
    }
}
  
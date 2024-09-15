<?php

namespace App\Filament\Resources\Orders\BillingResource\Pages;

use App\Filament\Resources\Orders\BillingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBilling extends EditRecord
{
    protected static string $resource = BillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(), 
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_billing');
    }
}

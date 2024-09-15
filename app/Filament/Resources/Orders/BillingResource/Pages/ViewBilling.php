<?php

namespace App\Filament\Resources\Orders\BillingResource\Pages;

use App\Filament\Resources\Orders\BillingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBilling extends ViewRecord
{
    protected static string $resource = BillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_billing');
    }
} 

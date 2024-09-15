<?php

namespace App\Filament\Resources\Orders\BillingResource\Pages;

use App\Filament\Resources\Orders\BillingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBillings extends ListRecords
{
    protected static string $resource = BillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_billing')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.billings');
    }
} 

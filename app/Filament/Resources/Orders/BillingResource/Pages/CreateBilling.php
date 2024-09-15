<?php

namespace App\Filament\Resources\Orders\BillingResource\Pages;

use App\Filament\Resources\Orders\BillingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBilling extends CreateRecord
{
    protected static string $resource = BillingResource::class;

    public function getTitle(): string
    {
        return __('models.create_billing');
    }
}
 
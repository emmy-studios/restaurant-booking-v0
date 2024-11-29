<?php

namespace App\Filament\Resources\Employees\SalaryPaymentResource\Pages;

use App\Filament\Resources\Employees\SalaryPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalaryPayments extends ListRecords
{
    protected static string $resource = SalaryPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_payment')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.payments');
    }

}

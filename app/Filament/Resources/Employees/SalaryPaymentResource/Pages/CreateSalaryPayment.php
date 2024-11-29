<?php

namespace App\Filament\Resources\Employees\SalaryPaymentResource\Pages;

use App\Filament\Resources\Employees\SalaryPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalaryPayment extends CreateRecord
{
    protected static string $resource = SalaryPaymentResource::class;

    public function getTitle(): string
    {
        return __('models.create_payment');
    }

}

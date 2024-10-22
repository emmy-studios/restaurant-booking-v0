<?php

namespace App\Filament\Resources\Employees;

use App\Enums\AccountType;
use App\Enums\ContractType;
use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\EmployeeStatus;
use App\Enums\Roles;
use App\Filament\Resources\Employees\EmployeeResource\Pages;
use App\Filament\Resources\Employees\EmployeeResource\RelationManagers;
use App\Models\Employees\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('models.name')) 
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->label(__('models.first_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255)
                    ->label(__('models.last_name')),
                Forms\Components\TextInput::make('identification_code')
                    ->required()
                    ->label(__('models.identification_code'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('id_number')
                    ->maxLength(255)
                    ->label(__('models.id_number')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label(__('models.email'))
                    ->maxLength(255),
                Forms\Components\Select::make('phone_code')
                    ->options(CountryCode::class)
                    ->searchable()
                    ->required()
                    ->label(__('models.phone_code')),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label(__('models.phone_number'))
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->options(Countries::class)
                    ->searchable()
                    ->label(__('models.country'))
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)
                    ->label(__('models.city')),
                Forms\Components\TextInput::make('postal_code')
                    ->maxLength(255)
                    ->label(__('models.postal_code')), 
                Forms\Components\MarkdownEditor::make('address')
                    ->columnSpanFull()
                    ->label(__('models.address')),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label(__('models.date_of_birth')),
                Forms\Components\DatePicker::make('hire_date')
                    ->label(__('models.hire_date')),
                Forms\Components\TextInput::make('social_security_number')
                    ->maxLength(255)
                    ->label(__('models.social_security_number')),
                Forms\Components\TextInput::make('job_title')
                    ->maxLength(255)
                    ->label(__('models.job_title')),
                Forms\Components\TextInput::make('department')
                    ->maxLength(255)
                    ->label(__('models.department')),
                Forms\Components\Select::make('contract_type')
                    ->options(ContractType::class)
                    ->searchable()
                    ->label(__('models.contract_type'))
                    ->required(),
                Forms\Components\TextInput::make('secondary_email')
                    ->email()
                    ->label(__('models.secondary_email'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('emergency_contact_name')
                    ->maxLength(255)
                    ->label(__('models.emergency_contact_name')),
                Forms\Components\TextInput::make('emergency_contact_phone')
                    ->tel()
                    ->label(__('models.emergency_contact_phone'))
                    ->maxLength(255),
                Forms\Components\Toggle::make('work_permit')
                    ->required()
                    ->label(__('models.work_permit')),
                Forms\Components\TextInput::make('tax_id_number')
                    ->maxLength(255)
                    ->label(__('models.tax_id_number')),
                Forms\Components\Select::make('status')
                    ->label(__('models.status'))
                    ->options(EmployeeStatus::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('supervisor')
                    ->maxLength(255)
                    ->label(__('models.supervisor')),
                Forms\Components\DatePicker::make('fire_date')
                    ->label(__('models.fire_date')),
                Forms\Components\DatePicker::make('termination_date')
                    ->label(__('models.termination_date')),
                Forms\Components\DatePicker::make('last_promotion_date')
                    ->label(__('models.last_promotion_date')),
                Forms\Components\DatePicker::make('last_promotion_role')
                    ->label(__('models.last_promotion_role')),
                Forms\Components\Select::make('role')
                    ->options(Roles::class)
                    ->searchable()
                    ->label(__('models.role'))
                    ->required(),
                Forms\Components\TextInput::make('bank_name')
                    ->maxLength(255)
                    ->label(__('models.bank_name')),
                Forms\Components\Select::make('account_type')
                    ->options(AccountType::class)
                    ->searchable()
                    ->label(__('models.account_type'))
                    ->required(),
                Forms\Components\TextInput::make('account_number')
                    ->maxLength(255)
                    ->label(__('models.account_number')),
                Forms\Components\TextInput::make('bank_code')
                    ->maxLength(255)
                    ->label(__('models.bank_code')),
                Forms\Components\TextInput::make('routing_number')
                    ->maxLength(255)
                    ->label(__('models.routing_number')),
                Forms\Components\TextInput::make('iban')
                    ->maxLength(255)
                    ->label(__('models.iban')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name')),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->label(__('models.first_name')),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->label(__('models.last_name')),
                Tables\Columns\TextColumn::make('identification_code')
                    ->searchable()
                    ->label(__('models.identification_code')),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable()
                    ->label(__('models.id_number')), 
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('models.email')),
                Tables\Columns\TextColumn::make('phone_code')
                    ->badge()
                    ->label(__('models.phone_code')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label(__('models.phone_number')),
                Tables\Columns\TextColumn::make('country')
                    ->label(__('models.country')),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->label(__('models.city')),
                Tables\Columns\TextColumn::make('postal_code')
                    ->searchable()
                    ->label(__('models.postal_code')),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->label(__('models.date_of_birth'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->label(__('models.hire_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('social_security_number')
                    ->searchable()
                    ->label(__('models.social_security_number')),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable()
                    ->label(__('models.job_title')),
                Tables\Columns\TextColumn::make('department')
                    ->searchable()
                    ->label(__('models.department')),
                Tables\Columns\TextColumn::make('contract_type')
                    ->label(__('models.contrat_type')),
                Tables\Columns\TextColumn::make('secondary_email')
                    ->searchable()
                    ->label(__('models.secondary_email')),
                Tables\Columns\TextColumn::make('emergency_contact_name')
                    ->searchable()
                    ->label(__('models.emergency_contact_name')),
                Tables\Columns\TextColumn::make('emergency_contact_phone')
                    ->searchable()
                    ->label(__('models.emergency_contact_phone')),
                Tables\Columns\IconColumn::make('work_permit')
                    ->boolean()
                    ->label(__('models.work_permit')),
                Tables\Columns\TextColumn::make('tax_id_number')
                    ->searchable()
                    ->label(__('models.tax_id_number')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('supervisor')
                    ->searchable()
                    ->label(__('models.supervisor')),
                Tables\Columns\TextColumn::make('fire_date')
                    ->date()
                    ->label(__('models.fire_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('termination_date')
                    ->date()
                    ->label(__('models.termination_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_promotion_date')
                    ->date()
                    ->label(__('models.last_promotion_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_promotion_role')
                    ->date()
                    ->label(__('models.last_promotion_role'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->label(__('models.role')),
                Tables\Columns\TextColumn::make('bank_name')
                    ->searchable()
                    ->label(__('models.bank_name')),
                Tables\Columns\TextColumn::make('account_number')
                    ->searchable()
                    ->label(__('models.account_number')),
                Tables\Columns\TextColumn::make('account_type')
                    ->label(__('models.account_type')),
                Tables\Columns\TextColumn::make('bank_code')
                    ->searchable()
                    ->label(__('models.bank_code')),
                Tables\Columns\TextColumn::make('routing_number')
                    ->searchable()
                    ->label(__('models.routing_number')),
                Tables\Columns\TextColumn::make('iban')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ]; 
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.employees');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }

}

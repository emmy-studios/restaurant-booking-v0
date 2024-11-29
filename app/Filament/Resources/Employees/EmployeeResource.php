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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
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
                Section::make('system_information')
                    ->icon('heroicon-o-computer-desktop')
                    ->label(__('panels.system_information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('models.username'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('identification_code')
                            ->required()
                            ->label(__('models.identification_code'))
                            ->maxLength(255),
                        Select::make('role')
                            ->options(Roles::class)
                            ->searchable()
                            ->label(__('models.role'))
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->label(__('models.email'))
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('personal_information')
                    ->icon('heroicon-o-user-circle')
                    ->label(__('panels.personal_information'))
                    ->schema([
                        TextInput::make('first_name')
                            ->label(__('models.first_name'))
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->maxLength(255)
                            ->label(__('models.last_name')),
                        DatePicker::make('date_of_birth')
                            ->label(__('models.date_of_birth')),
                        TextInput::make('id_number')
                            ->maxLength(255)
                            ->label(__('models.id_number')),
                        TextInput::make('secondary_email')
                            ->email()
                            ->label(__('models.secondary_email'))
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('contact_information')
                    ->icon('heroicon-o-envelope')
                    ->label(__('panels.contact_information'))
                    ->schema([
                        Select::make('phone_code')
                            ->options(CountryCode::class)
                            ->searchable()
                            ->required()
                            ->label(__('models.phone_code')),
                        TextInput::make('phone_number')
                            ->tel()
                            ->label(__('models.phone_number'))
                            ->maxLength(255),
                        Select::make('country')
                            ->options(Countries::class)
                            ->searchable()
                            ->label(__('models.country'))
                            ->required(),
                        TextInput::make('city')
                            ->maxLength(255)
                            ->label(__('models.city')),
                        TextInput::make('postal_code')
                            ->maxLength(255)
                            ->label(__('models.postal_code')),
                        TextInput::make('emergency_contact_name')
                            ->maxLength(255)
                            ->label(__('models.emergency_contact_name')),
                        TextInput::make('emergency_contact_phone')
                            ->tel()
                            ->label(__('models.emergency_contact_phone'))
                            ->maxLength(255),
                        MarkdownEditor::make('address')
                            ->columnSpanFull()
                            ->label(__('models.address')),
                    ])->columns(2),
                Section::make('work_information')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->label(__('panels.work_information'))
                    ->schema([
                        DatePicker::make('hire_date')
                    		->label(__('models.hire_date')),
                		TextInput::make('social_security_number')
                    		->maxLength(255)
                    		->label(__('models.social_security_number')),
                		TextInput::make('job_title')
                    		->maxLength(255)
                    		->label(__('models.job_title')),
                		TextInput::make('department')
                    		->maxLength(255)
                    		->label(__('models.department')),
                		Select::make('contract_type')
                    		->options(ContractType::class)
                    		->searchable()
                    		->label(__('models.contract_type'))
                    		->required(),
                		Toggle::make('work_permit')
                    		->required()
                    		->label(__('models.work_permit')),
                		TextInput::make('tax_id_number')
                    		->maxLength(255)
                    		->label(__('models.tax_id_number')),
                		Select::make('status')
                    		->label(__('models.status'))
                    		->options(EmployeeStatus::class)
                    		->searchable()
                    		->required(),
                		TextInput::make('supervisor')
                    		->maxLength(255)
                    		->label(__('models.supervisor')),
                		DatePicker::make('fire_date')
                    		->label(__('models.fire_date')),
                		DatePicker::make('termination_date')
                    		->label(__('models.termination_date')),
                		DatePicker::make('last_promotion_date')
                    		->label(__('models.last_promotion_date')),
                		DatePicker::make('last_promotion_role')
                    		->label(__('models.last_promotion_role')),
                    ])->columns(2),
                Section::make('bank_information')
                    ->icon('heroicon-o-credit-card')
                    ->label(__('panels.bank_information'))
                    ->schema([
                        TextInput::make('bank_name')
                            ->maxLength(255)
                            ->label(__('models.bank_name')),
                        Select::make('account_type')
                            ->options(AccountType::class)
                            ->searchable()
                            ->label(__('models.account_type'))
                            ->required(),
                        TextInput::make('account_number')
                            ->maxLength(255)
                            ->label(__('models.account_number')),
                        TextInput::make('bank_code')
                            ->maxLength(255)
                            ->label(__('models.bank_code')),
                        TextInput::make('routing_number')
                            ->maxLength(255)
                            ->label(__('models.routing_number')),
                        TextInput::make('iban')
                            ->maxLength(255)
                            ->label(__('models.iban')),
                    ])->columns(2),
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
                    ->icon('heroicon-o-lock-closed')
                    ->iconColor('danger')
                    ->searchable()
                    ->label(__('models.identification_code')),
                Tables\Columns\TextColumn::make('id_number')
                    ->icon('heroicon-o-identification')
                    ->iconColor('warning')
                    ->searchable()
                    ->label(__('models.id_number')),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-o-envelope')
                    ->iconColor('warning')
                    ->searchable()
                    ->label(__('models.email')),
                Tables\Columns\TextColumn::make('phone_code')
                    ->badge()
                    ->label(__('models.phone_code')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->iconColor('warning')
                    ->label(__('models.phone_number')),
                Tables\Columns\TextColumn::make('country')
                    ->label(__('models.country'))
                    ->icon('heroicon-o-globe-americas')
                    ->iconColor('warning'),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->icon('heroicon-o-map-pin')
                    ->iconColor('warning')
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
                    ->badge()
                    ->label(__('models.contract_type')),
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

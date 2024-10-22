<?php

namespace App\Filament\Resources\Employees;

use App\Enums\CurrencySymbol;
use App\Enums\SalaryType;
use App\Filament\Resources\Employees\SalaryResource\Pages;
use App\Filament\Resources\Employees\SalaryResource\RelationManagers;
use App\Models\Employees\Salary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3; 
 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->label(__('models.currency_symbol'))
                    ->default('USD $')
                    ->required(), 
                Forms\Components\TextInput::make('base_salary')
                    ->required()
                    ->label(__('models.base_salary'))
                    ->numeric(),
                Forms\Components\TextInput::make('net_salary')
                    ->required()
                    ->label(__('models.net_salary'))
                    ->numeric(),
                Forms\Components\Select::make('salary_type')
                    ->options(SalaryType::class)
                    ->searchable()
                    ->label(__('models.salary_type'))
                    ->required(),
                Forms\Components\DateTimePicker::make('effective_date')
                    ->label(__('models.effective_date')),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label(__('models.end_date')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->badge()
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('base_salary')
                    ->numeric()
                    ->label(__('models.base_salary'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_salary')
                    ->numeric()
                    ->label(__('models.net_salary'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary_type')
                    ->badge()
                    ->label(__('models.salary_type')),
                Tables\Columns\TextColumn::make('effective_date')
                    ->dateTime()
                    ->label(__('models.effective_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->label(__('models.end_date'))
                    ->sortable(),
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
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalary::route('/create'),
            'view' => Pages\ViewSalary::route('/{record}'),
            'edit' => Pages\EditSalary::route('/{record}/edit'),
        ];
    }
    
    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.salaries');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }

}

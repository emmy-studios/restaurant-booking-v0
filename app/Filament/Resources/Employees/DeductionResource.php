<?php

namespace App\Filament\Resources\Employees;

use App\Enums\CurrencySymbol;
use App\Filament\Resources\Employees\DeductionResource\Pages;
use App\Filament\Resources\Employees\DeductionResource\RelationManagers;
use App\Models\Employees\Deduction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeductionResource extends Resource
{
    protected static ?string $model = Deduction::class;

    protected static ?string $navigationIcon = 'heroicon-o-minus';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('salary_id')
                    ->label(__('models.employee'))
                    ->relationship('salary.employee', 'name')
                    ->required(),
                Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $')
                    ->required()
                    ->label(__('models.currency_symbol')),
                TextInput::make('amount')
                    ->required()
                    ->label(__('models.amount'))
                    ->numeric(),
                TextInput::make('type')
                    ->label(__('models.type'))
                    ->maxLength(255),
                MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                DatePicker::make('date_applied')
                    ->label(__('models.date_applied')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('salary.employee.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('currency_symbol')
                    ->badge()
                    ->color('info')
                    ->label(__('models.currency_symbol')),
                TextColumn::make('amount')
                    ->numeric()
                    ->label(__('models.amount'))
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.type')),
                TextColumn::make('description')
                    ->limit(30)
                    ->label(__('models.description'))
                    ->icon('heroicon-o-document-text')
                    ->iconColor('gray'),
                TextColumn::make('date_applied')
                    ->date()
                    ->icon('heroicon-o-calendar')
                    ->iconColor('gray')
                    ->label(__('models.date_applied'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListDeductions::route('/'),
            'create' => Pages\CreateDeduction::route('/create'),
            'view' => Pages\ViewDeduction::route('/{record}'),
            'edit' => Pages\EditDeduction::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.deductions');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}

<?php

namespace App\Filament\Resources\Employees;

use App\Enums\CurrencySymbol;
use App\Filament\Resources\Employees\DeductionResource\Pages;
use App\Filament\Resources\Employees\DeductionResource\RelationManagers;
use App\Models\Employees\Deduction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\Select::make('salary_id')
                    ->label(__('models.salary'))
                    ->relationship('salary', 'id')
                    ->required(),
                Forms\Components\Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $') 
                    ->required()
                    ->label(__('models.currency_symbol')), 
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->label(__('models.amount'))
                    ->numeric(),
                Forms\Components\TextInput::make('type')
                    ->label(__('models.type'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\DatePicker::make('date_applied')
                    ->label(__('models.date_applied')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('salary.id')
                    ->numeric()
                    ->label(__('models.salary'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->badge()
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->label(__('models.amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->label(__('models.type')),
                Tables\Columns\TextColumn::make('date_applied')
                    ->date()
                    ->label(__('models.date_applied'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
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

<?php

namespace App\Filament\Resources\Suppliers;

use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Filament\Resources\Suppliers\SupplierResource\Pages;
use App\Filament\Resources\Suppliers\SupplierResource\RelationManagers;
use App\Models\Suppliers\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->label(__('models.name')),
                Forms\Components\TextInput::make('company_name')
                    ->maxLength(255)
                    ->label(__('models.company_name')),
                Forms\Components\Select::make('phone_code')
                    ->options(self::getCountryCode())
                    ->searchable()
                    ->default('+506')
                    ->label(__('models.phone_code'))
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label(__('models.phone_number'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label(__('models.email'))
                    ->maxLength(255), 
                Forms\Components\Select::make('country')
                    ->options(self::getCountryOptions())
                    ->searchable()
                    ->default('Costa Rica')
                    ->required()
                    ->label(__('models.country')),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)
                    ->label(__('models.city')),
                Forms\Components\MarkdownEditor::make('address')
                    ->columnSpanFull()
                    ->label(__('models.address')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable()
                    ->label(__('models.company_name')),
                Tables\Columns\TextColumn::make('phone_code')
                    ->label(__('models.phone_code')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label(__('models.phone_number')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('models.email')),
                Tables\Columns\TextColumn::make('country')
                    ->label(__('models.country')),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->label(__('models.city')),
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

    public static function getCountryOptions(): array
    {
        return array_map(fn($case) => $case->value, Countries::cases());
    }

    public static function getCountryCode(): array
    {
        return array_map(fn($case) => $case->value, CountryCode::cases());
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'view' => Pages\ViewSupplier::route('/{record}'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.suppliers');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.suppliers');
    }
}

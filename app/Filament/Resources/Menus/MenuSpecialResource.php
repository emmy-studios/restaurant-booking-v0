<?php

namespace App\Filament\Resources\Menus;

use App\Filament\Resources\Menus\MenuSpecialResource\Pages;
use App\Filament\Resources\Menus\MenuSpecialResource\RelationManagers;
use App\Models\Menus\MenuSpecial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuSpecialResource extends Resource
{
    protected static ?string $model = MenuSpecial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'title')
                    ->label(__('models.menu'))
                    ->required(),
                Forms\Components\TextInput::make('discount_percentage')
                    ->numeric()
                    ->label(__('models.discount_percentage')),
                Forms\Components\TextInput::make('discount_code')
                    ->maxLength(255)
                    ->label(__('models.discount_code')),
                Forms\Components\DateTimePicker::make('start_at')
                    ->label(__('models.start_at')),
                Forms\Components\DateTimePicker::make('end_at')
                    ->label(__('models.end_at')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('menu.title')
                    ->numeric()
                    ->label(__('models.menu'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_percentage')
                    ->numeric()
                    ->label(__('models.discount_percentage'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_code')
                    ->searchable()
                    ->label(__('models.discount_code')),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime()
                    ->label(__('models.start_at'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->label(__('models.end_at'))
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
            'index' => Pages\ListMenuSpecials::route('/'),
            'create' => Pages\CreateMenuSpecial::route('/create'),
            'view' => Pages\ViewMenuSpecial::route('/{record}'),
            'edit' => Pages\EditMenuSpecial::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.menu_specials');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.menus');
    }
}

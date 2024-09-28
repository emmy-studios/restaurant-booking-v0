<?php

namespace App\Filament\Resources\Tables;

use App\Filament\Resources\Tables\TableResource\Pages;
use App\Filament\Resources\Tables\TableResource\RelationManagers;
use App\Models\Tables\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('table_number')
                    ->maxLength(255)
                    ->label(__('models.table_number')),
                Forms\Components\TextInput::make('capacity')
                    ->numeric()
                    ->label(__('models.capacity')),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->label(__('models.location')),
                Forms\Components\Toggle::make('is_available')
                    ->label(__('models.is_available')),
            ]);
    } 

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('table_number')
                    ->searchable()
                    ->label(__('models.table_number')),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->label(__('models.capacity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label(__('models.location')),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label(__('models.is_available')),
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
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'view' => Pages\ViewTable::route('/{record}'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.tables');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.tables');
    }
}

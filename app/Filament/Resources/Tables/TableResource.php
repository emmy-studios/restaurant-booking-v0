<?php

namespace App\Filament\Resources\Tables;

use App\Filament\Resources\Tables\TableResource\Pages;
use App\Filament\Resources\Tables\TableResource\RelationManagers;
use App\Models\Tables\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('models.tables');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('created_at', now()->toDateString())
            ->where('is_available', true)
            ->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('table_number')
                            ->maxLength(255)
                            ->label(__('models.table_number')),
                        TextInput::make('capacity')
                            ->numeric()
                            ->label(__('models.capacity')),
                        TextInput::make('location')
                            ->maxLength(255)
                            ->label(__('models.location')),
                    ]),
                    Section::make([
                        Toggle::make('is_available')
                            ->label(__('models.is_available'))
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                        TextInput::make('floor')
                            ->label(__('models.floor'))
                            ->numeric()
                            ->default(1),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
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
                    ->label(__('models.location'))
                    ->limit(15),
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
                SelectFilter::make('is_available')
                    ->label(__('models.is_available'))
                    ->options([
                        true => __('models.is_available'),
                        false => __('models.is_not_available'),
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
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

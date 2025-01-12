<?php

namespace App\Filament\Resources\Reservations\ReservationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class TablesRelationManager extends RelationManager
{
    protected static string $relationship = 'tables';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('models.tables_related_to_the_reservation');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('table_number')
            ->columns([
                Tables\Columns\TextColumn::make('table_number')
                    ->label(__('models.table_number')),
                Tables\Columns\TextColumn::make('location')
                    ->label(__('models.location'))
                    ->limit(16),
                Tables\Columns\TextColumn::make('capacity')
                    ->label(__('models.capacity')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordSelect(fn (Select $select) => $select->placeholder(__('models.select_a_table/tables')))
                    ->modalHeading(__('models.attach_table')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\ViewAction::make()
                    ->modalHeading(__('models.details'))
                    ->label(__('models.view_table'))
                    ->form([
                        Forms\Components\TextInput::make('table_number')
                            ->label(__('models.table_number'))
                            ->disabled(),
                        Forms\Components\TextInput::make('location')
                            ->label(__('models.location'))
                            ->disabled(),
                        Forms\Components\TextInput::make('capacity')
                            ->label(__('models.capacity'))
                            ->disabled(),
                        Forms\Components\Toggle::make('is_available')
                            ->label(__('models.is_available'))
                            ->disabled()
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                                ->offColor('danger')
                        ])
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Events\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class TablesRelationManager extends RelationManager
{
    protected static string $relationship = 'tables';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('models.tables');
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
                    ->limit(15),
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
                            ]),
                        ]),
                ])->tooltip(__('panels.actions'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}

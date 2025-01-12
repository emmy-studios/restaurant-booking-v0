<?php

namespace App\Filament\Resources\Events\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class EventPackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'eventPackages';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('models.packages');
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
            ->recordTitleAttribute('package_name')
            ->columns([
                Tables\Columns\TextColumn::make('package_name')
                    ->label(__('models.package_name')),
                Tables\Columns\TextColumn::make('details')
                    ->label(__('models.details'))
                    ->limit(20),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordSelect(fn (Select $select) => $select->placeholder(__('models.select_a_package/packages')))
                    ->modalHeading(__('models.attach_package')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\ViewAction::make()
                    ->modalHeading(__('models.details'))
                    ->label(__('models.view_package'))
                    ->form([
                        Split::make([
                            Section::make([
                                TextInput::make('package_name')
                                    ->label(__('models.package_name'))
                                    ->disabled(),
                                TextInput::make('details')
                                    ->label(__('models.details'))
                                    ->disabled()
                                ]),
                            Section::make([
                                    TextInput::make('currency_symbol')
                                        ->label(__('models.currency_symbol'))
                                        ->disabled(),
                                    TextInput::make('subtotal')
                                        ->label(__('models.subtotal'))
                                        ->disabled(),
                                    TextInput::make('total')
                                        ->label(__('models.total'))
                                        ->disabled(),
                                ]),
                            ])->from('md'),
                        Section::make([
                            TextInput::make('additional_details')
                                ->label(__('models.additional_details'))
                                ->disabled(),
                            TextInput::make('notes')
                                ->label(__('models.notes'))
                                ->disabled(),
                            ]),
                        ])
                    ])->tooltip(__('panels.actions')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}

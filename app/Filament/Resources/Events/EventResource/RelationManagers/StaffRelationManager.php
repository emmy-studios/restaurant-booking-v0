<?php

namespace App\Filament\Resources\Events\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class StaffRelationManager extends RelationManager
{
    protected static string $relationship = 'staffs';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('models.staff');
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
            ->recordTitleAttribute('first_name')
            ->columns([
                TextColumn::make('first_name')
                    ->label(__('models.first_name')),
                TextColumn::make('last_name')
                    ->label(__('models.last_name')),
                TextColumn::make('contact_number')
                    ->label(__('models.contact_number')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordSelect(fn (Select $select) => $select->placeholder(__('models.select_staff')))
                    ->modalHeading(__('models.attach_staff')),
            ])
            ->actions([
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\DetachAction::make(),
                        Tables\Actions\ViewAction::make()
                            ->modalHeading(__('models.details'))
                            ->label(__('models.view_staff'))
                            ->form([
                                Split::make([
                                    Section::make([
                                        TextInput::make('first_name')
                                            ->maxLength(255)
                                            ->label(__('models.first_name')),
                                        TextInput::make('last_name')
                                            ->maxLength(255)
                                            ->label(__('models.last_name')),
                                        TextInput::make('contact_number')
                                            ->maxLength(255)
                                            ->label(__('models.contact_number')),
                                    ]),
                                    Section::make([
                                        Toggle::make('transport_provided')
                                            ->required()
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->label(__('models.transport_provided')),
                                        Toggle::make('training_required')
                                            ->required()
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->label(__('models.training_required')),
                                        Toggle::make('training_completed')
                                            ->required()
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->label(__('models.training_completed')),
                                        Toggle::make('need_uniform')
                                            ->required()
                                            ->onIcon('heroicon-o-check')
                                            ->offIcon('heroicon-o-x-mark')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->label(__('models.need_uniform'))
                                    ]),
                                ])->from('md')
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

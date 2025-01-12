<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\StaffResource\Pages;
use App\Filament\Resources\Events\StaffResource\RelationManagers;
use App\Models\Events\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function getBreadcrumb(): string
    {
        return __('models.staff');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                            ->label(__('models.need_uniform')),
                    ]),
                ])
                    ->columnSpanFull()
                    ->from('md'),
                Split::make([
                    Section::make([
                        DateTimePicker::make('shift_start')
                            ->label(__('models.shift_start')),
                        DateTimePicker::make('shift_end')
                            ->label(__('models.shift_end')),
                        DateTimePicker::make('check_in_time')
                            ->label(__('models.check_in_time')),
                        DateTimePicker::make('check_out_time')
                            ->label(__('models.check_out_time')),
                        TextInput::make('hours_worked')
                            ->numeric()
                            ->label(__('models.hours_worked')),
                    ]),
                    Section::make([
                        TextInput::make('role')
                            ->maxLength(255)
                            ->label(__('models.role')),
                        TextInput::make('emergency_contact')
                            ->maxLength(255)
                            ->label(__('models.emergency_contact')),
                        TextInput::make('emergency_contact_number')
                            ->maxLength(255)
                            ->label(__('models.emergency_contact_number')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('meal_preferences')
                        ->columnSpanFull()
                        ->label(__('models.meal_preferences')),
                    MarkdownEditor::make('location_assigned')
                        ->columnSpanFull()
                        ->label(__('models.location_assigned')),
                    MarkdownEditor::make('notes')
                        ->columnSpanFull()
                        ->label(__('models.notes'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.first_name')),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.last_name')),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable()
                    ->label(__('models.contact_number'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('emergency_contact')
                    ->searchable()
                    ->label(__('models.emergency_contact'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('emergency_contact_number')
                    ->searchable()
                    ->label(__('models.emergency_contact_number'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->label(__('models.role'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('shift_start')
                    ->dateTime()
                    ->label(__('models.shift_start'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('shift_end')
                    ->dateTime()
                    ->label(__('models.shift_end'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('check_in_time')
                    ->dateTime()
                    ->label(__('models.check_in_time'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('check_out_time')
                    ->dateTime()
                    ->label(__('models.check_out_time'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('hours_worked')
                    ->numeric()
                    ->searchable()
                    ->sortable()
                    ->label(__('models.hours_worked'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('need_uniform')
                    ->boolean()
                    ->searchable()
                    ->label(__('models.need_uniform'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('transport_provided')
                    ->boolean()
                    ->searchable()
                    ->label(__('models.transport_provided'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('training_required')
                    ->boolean()
                    ->searchable()
                    ->label(__('models.training_required'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('training_completed')
                    ->boolean()
                    ->searchable()
                    ->label(__('models.training_completed'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('models.start_date')),
                        DatePicker::make('created_until')
                            ->label(__('models.end_date')),
    				])
                    ->query(function (Builder $query, array $data): Builder {
        				return $query
            				->when(
                				$data['created_from'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'view' => Pages\ViewStaff::route('/{record}'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.staff');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.events');
    }
}

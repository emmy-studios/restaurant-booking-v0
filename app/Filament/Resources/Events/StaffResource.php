<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\StaffResource\Pages;
use App\Filament\Resources\Events\StaffResource\RelationManagers;
use App\Models\Events\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{ 
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(255)
                    ->label(__('models.first_name')),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255)
                    ->label(__('models.last_name')),
                Forms\Components\TextInput::make('contact_number')
                    ->maxLength(255)
                    ->label(__('models.contact_number')),
                Forms\Components\TextInput::make('emergency_contact')
                    ->maxLength(255)
                    ->label(__('models.emergency_contact')),
                Forms\Components\TextInput::make('emergency_contact_number')
                    ->maxLength(255)
                    ->label(__('models.emergency_contact_number')),
                Forms\Components\TextInput::make('role')
                    ->maxLength(255)
                    ->label(__('models.role')),
                Forms\Components\DateTimePicker::make('shift_start')
                    ->label(__('models.shift_start')),
                Forms\Components\DateTimePicker::make('shift_end')
                    ->label(__('models.shift_end')),
                Forms\Components\DateTimePicker::make('check_in_time')
                    ->label(__('models.check_in_time')),
                Forms\Components\DateTimePicker::make('check_out_time')
                    ->label(__('models.check_out_time')),
                Forms\Components\TextInput::make('hours_worked')
                    ->numeric()
                    ->label(__('models.hours_worked')),
                Forms\Components\Toggle::make('need_uniform')
                    ->required()
                    ->label(__('models.need_uniform')),
                Forms\Components\MarkdownEditor::make('meal_preferences')
                    ->columnSpanFull()
                    ->label(__('models.meal_preferences')),
                Forms\Components\Toggle::make('transport_provided')
                    ->required()
                    ->label(__('models.transport_provided')),
                Forms\Components\Toggle::make('training_required')
                    ->required()
                    ->label(__('models.training_required')),
                Forms\Components\Toggle::make('training_completed')
                    ->required()
                    ->label(__('models.training_completed')),
                Forms\Components\MarkdownEditor::make('location_assigned')
                    ->columnSpanFull()
                    ->label(__('models.location_assigned')),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->label(__('models.first_name')),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->label(__('models.last_name')),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable()
                    ->label(__('models.contact_number')),
                Tables\Columns\TextColumn::make('emergency_contact')
                    ->searchable()
                    ->label(__('models.emergency_contact')),
                Tables\Columns\TextColumn::make('emergency_contact_number')
                    ->searchable()
                    ->label(__('models.emergency_contact_number')),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->label(__('models.role')),
                Tables\Columns\TextColumn::make('shift_start')
                    ->dateTime()
                    ->label(__('models.shift_start'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('shift_end')
                    ->dateTime()
                    ->label(__('models.shift_end'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in_time')
                    ->dateTime()
                    ->label(__('models.check_in_time'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out_time')
                    ->dateTime()
                    ->label(__('models.check_out_time'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('hours_worked')
                    ->numeric()
                    ->label(__('models.hours_worked'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('need_uniform')
                    ->boolean()
                    ->label(__('models.need_uniform')),
                Tables\Columns\IconColumn::make('transport_provided')
                    ->boolean()
                    ->label(__('models.transport_provided')),
                Tables\Columns\IconColumn::make('training_required')
                    ->boolean()
                    ->label(__('models.training_required')),
                Tables\Columns\IconColumn::make('training_completed')
                    ->boolean()
                    ->label(__('models.training_completed')),
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

<?php

namespace App\Filament\Resources\Employees;

use App\Enums\AbsenceType;
use App\Filament\Resources\Employees\AbsenceResource\Pages;
use App\Filament\Resources\Employees\AbsenceResource\RelationManagers;
use App\Models\Employees\Absence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbsenceResource extends Resource
{
    protected static ?string $model = Absence::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
 
    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 7;  

    public static function form(Form $form): Form
    { 
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label(__('models.start_date')),
                Forms\Components\DatePicker::make('end_date')
                    ->label(__('models.end_date')),
                Forms\Components\Toggle::make('justified')
                    ->required()
                    ->label(__('models.justified')),
                Forms\Components\MarkdownEditor::make('reason')
                    ->columnSpanFull()
                    ->label(__('models.reason')),
                Forms\Components\MarkdownEditor::make('details')
                    ->columnSpanFull()
                    ->label(__('models.details')),
                Forms\Components\Select::make('absence_type')
                    ->options(AbsenceType::class)
                    ->searchable()
                    ->label(__('models.absence_type'))
                    ->required(),
                Forms\Components\Select::make('approved_by')
                    ->relationship('approver', 'name')
                    ->required()
                    ->label(__('models.approved_by')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.employee')),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label(__('models.start_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label(__('models.end_date'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('justified')
                    ->boolean()
                    ->label(__('models.justified')),
                Tables\Columns\TextColumn::make('absence_type')
                    ->label(__('models.absence_type')),
                Tables\Columns\TextColumn::make('approved_by')
                    ->numeric()
                    ->label(__('models.approved_by'))
                    ->sortable(),
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
            'index' => Pages\ListAbsences::route('/'),
            'create' => Pages\CreateAbsence::route('/create'),
            'view' => Pages\ViewAbsence::route('/{record}'),
            'edit' => Pages\EditAbsence::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    { 
        return __('models.absences');
    }
 
    // Translate Navigation Group. 
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}

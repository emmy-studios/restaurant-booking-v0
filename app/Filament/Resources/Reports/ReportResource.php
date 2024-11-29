<?php

namespace App\Filament\Resources\Reports;

use App\Enums\ReportType;
use App\Filament\Resources\Reports\ReportResource\Pages;
use App\Filament\Resources\Reports\ReportResource\RelationManagers;
use App\Models\Reports\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\Select::make('report_type')
                    ->options(ReportType::class)
                    ->searchable()
                    ->required()
                    ->label(__('models.report_type')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->label(__('models.title'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('content')
                    ->columnSpanFull()
                    ->label(__('models.content')),
                Forms\Components\MarkdownEditor::make('details')
                    ->columnSpanFull()
                    ->label(__('models.details')),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.title')),
                Tables\Columns\TextColumn::make('report_type')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->label(__('models.report_type')),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('content'),
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

    public static function getReportType(): array
    {
        return array_map(fn($case) => $case->value, ReportType::cases());
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'view' => Pages\ViewReport::route('/{record}'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.reports');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.reports');
    }
}

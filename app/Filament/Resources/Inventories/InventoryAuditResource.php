<?php

namespace App\Filament\Resources\Inventories;

use App\Filament\Resources\Inventories\InventoryAuditResource\Pages;
use App\Filament\Resources\Inventories\InventoryAuditResource\RelationManagers;
use App\Models\Inventories\InventoryAudit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryAuditResource extends Resource
{
    protected static ?string $model = InventoryAudit::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inventory_id')
                    ->relationship('inventory', 'id')
                    ->label(__('models.inventory'))
                    ->required(),
                Forms\Components\TextInput::make('audited_value')
                    ->numeric()
                    ->label(__('models.audited_value')),
                Forms\Components\TextInput::make('audited_quantity')
                    ->numeric()
                    ->label(__('models.audited_quantity')),
                Forms\Components\TextInput::make('audited_by')
                    ->maxLength(255)
                    ->label(__('models.audited_by')),
                Forms\Components\DateTimePicker::make('audit_date')
                    ->required()
                    ->label(__('models.audit_date')),
                Forms\Components\MarkdownEditor::make('remarks')
                    ->columnSpanFull()
                    ->label(__('models.remarks')),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inventory.id')
                    ->numeric()
                    ->label(__('models.inventory'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('audited_value')
                    ->numeric()
                    ->label(__('models.audited_value'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('audited_quantity')
                    ->numeric()
                    ->label(__('models.audited_quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('audited_by')
                    ->searchable()
                    ->label(__('models.audited_by')),
                Tables\Columns\TextColumn::make('audit_date')
                    ->dateTime()
                    ->label(__('models.audit_date'))
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
            'index' => Pages\ListInventoryAudits::route('/'),
            'create' => Pages\CreateInventoryAudit::route('/create'),
            'view' => Pages\ViewInventoryAudit::route('/{record}'),
            'edit' => Pages\EditInventoryAudit::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.audits');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.inventories');
    }
}

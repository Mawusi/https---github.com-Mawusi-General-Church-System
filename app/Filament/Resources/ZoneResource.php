<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Zone;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ZoneResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ZoneResource\RelationManagers;
use App\Filament\Resources\ZoneResource\RelationManagers\GroupChurchesRelationManager;
use App\Filament\Resources\ZoneResource\Widgets\ZoneStatsOverview;

class ZoneResource extends Resource
{
    protected static ?string $model = Zone::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';
    protected static ?string $navigationGroup = 'Church Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('country_id')
                        ->relationship('country', 'name')->required(),
                    TextInput::make('name')
                    ->label('Zone name')
                    ->required()->maxLength(255)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('country.name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            GroupChurchesRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ZoneStatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZones::route('/'),
            // 'create' => Pages\CreateZone::route('/create'),
            // 'edit' => Pages\EditZone::route('/{record}/edit'),
        ];
    }    
}

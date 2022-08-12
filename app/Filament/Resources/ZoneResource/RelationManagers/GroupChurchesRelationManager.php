<?php

namespace App\Filament\Resources\ZoneResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class GroupChurchesRelationManager extends RelationManager
{
    protected static string $relationship = 'group_churches';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([

                        Select::make('country_id')
                        ->relationship('country', 'name')->required(),
                        
                        Select::make('zone_id')
                        ->label('Zone name')
                        ->relationship('zone', 'name')->required(),

                        TextInput::make('pastor')
                        ->label("Group Pastor's name")
                        ->required()->maxLength(255),
                    
                        TextInput::make('name')
                        ->label("Group Church's name")
                        ->required()->maxLength(255)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('pastor')->sortable()->searchable(),
                TextColumn::make('zone.name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}

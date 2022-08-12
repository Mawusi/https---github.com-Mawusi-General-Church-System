<?php

namespace App\Filament\Resources\GroupChurchResource\RelationManagers;

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

class ChurchesRelationManager extends RelationManager
{
    protected static string $relationship = 'churches';

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
                        ->label("Zone's name")
                        ->relationship('zone', 'name')->required(),

                        Select::make('group_church_id')
                        ->label("Group Church's name")
                        ->relationship('group_church', 'name')->required(),
                    
                        TextInput::make('name')
                        ->label('Church name')
                        ->required()->maxLength(255),

                        TextInput::make('pastor')
                        ->label("Church Pastor's name")
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
                TextColumn::make('group_church.name')->sortable()->searchable(),
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

<?php

namespace App\Filament\Resources\FellowshipResource\RelationManagers;

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

class SoulWinnersRelationManager extends RelationManager
{
    protected static string $relationship = 'soul_winners';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('contact')->required()->maxLength(255),
                        TextInput::make('email')->email()->maxLength(255),

                        Select::make('country_id')
                        ->relationship('country', 'name')->required(),

                        Select::make('zone_id')
                        ->relationship('zone', 'name')->required(),

                        Select::make('group_church_id')
                        ->relationship('group_church', 'name')->required(),
                        
                        Select::make('church_id')
                        ->relationship('church', 'name')->required(),

                        Select::make('fellowship_id')
                        ->relationship('fellowship', 'name')->required(),

                        Select::make('designation_id')
                        ->relationship('designation', 'name')->required(),

                        TextInput::make('cell')
                        ->label('Cell name')
                        ->required()->maxLength(255),
                        
                        TextInput::make('location')
                        ->required()
                        ->label('Cell location')
                        ->maxLength(255)
                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('church.name')->sortable()->searchable(),
                TextColumn::make('fellowship.name')->sortable()->searchable(),
                TextColumn::make('location')
                ->label('Cell location')
                ->sortable()->searchable(),
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

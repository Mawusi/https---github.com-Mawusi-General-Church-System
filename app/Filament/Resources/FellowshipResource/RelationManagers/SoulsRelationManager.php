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

class SoulsRelationManager extends RelationManager
{
    protected static string $relationship = 'souls';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                        ->label("Soul's name")
                        ->required()->maxLength(255),
                        TextInput::make('contact')->required()->maxLength(255),
                        TextInput::make('email')->email()->maxLength(255),
                        TextInput::make('location')->required()->maxLength(255),

                        Select::make('country_id')
                        ->relationship('country', 'name')->required(),

                        Select::make('zone_id')
                        ->label("Soul winner's Zone")
                        ->relationship('zone', 'name')->required(),

                        Select::make('group_church_id')
                        ->label("Soul winner's Group church")
                        ->relationship('group_church', 'name')->required(),

                        Select::make('church_id')
                        ->label("Soul winner's church")
                        ->relationship('church', 'name')->required(),

                        Select::make('fellowship_id')
                        ->label("Soul winner's fellowship")
                        ->relationship('fellowship', 'name')->required(),

                        Select::make('designation_id')
                        ->label("Soul winner's designation")
                        ->relationship('designation', 'name')->required(),

                        Select::make('soul_winner_id')
                        ->label("Soul winner's name")
                        ->relationship('soul_winner', 'name')->required(),
                        
                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('contact')->sortable()->searchable(),
                TextColumn::make('location')->sortable()->searchable(),
                TextColumn::make('soul_winner.name')->sortable()->searchable(),
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

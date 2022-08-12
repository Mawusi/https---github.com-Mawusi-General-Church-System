<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Zone;
use Filament\Tables;
use App\Models\Country;
use App\Models\GroupChurch;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GroupChurchResource\Pages;
use App\Filament\Resources\GroupChurchResource\RelationManagers;
use App\Filament\Resources\GroupChurchResource\RelationManagers\ChurchesRelationManager;
use App\Filament\Resources\GroupChurchResource\Widgets\GroupChurchStatsOverview;

class GroupChurchResource extends Resource
{
    protected static ?string $model = GroupChurch::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';
    protected static ?string $navigationGroup = 'Church Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([

                        // Dependent fields for country->states->cities
                        Select::make('country_id')
                            ->label('Country')
                            ->options(Country::all()->pluck('name', 'id')->toArray())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('zone_id', null)),

                            Select::make('zone_id')
                                ->label("Zone's name")
                                ->required()
                                ->options(function(callable $get){
                                    $country = Country::find($get('country_id'));
                                        if(!$country){
                                            return Zone::all()->pluck('name', 'id');
                                        }
                                    return $country->zones->pluck('name', 'id');
                                })
                                ->reactive(),

                        // Select::make('country_id')
                        // ->relationship('country', 'name')->required(),

                        // Select::make('zone_id')
                        // ->label('Zone name')
                        // ->relationship('zone', 'name')->required(),

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
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('pastor')->sortable()->searchable(),
                TextColumn::make('zone.name')->sortable()->searchable(),
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
            ChurchesRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            GroupChurchStatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroupChurches::route('/'),
            // 'create' => Pages\CreateGroupChurch::route('/create'),
            // 'edit' => Pages\EditGroupChurch::route('/{record}/edit'),
        ];
    }    
}

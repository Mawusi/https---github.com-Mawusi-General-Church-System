<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Zone;
use Filament\Tables;
use App\Models\Church;
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
use App\Filament\Resources\ChurchResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChurchResource\RelationManagers;
use App\Filament\Resources\ChurchResource\Widgets\ChurchStatsOverview;
use App\Filament\Resources\ChurchResource\RelationManagers\FellowshipsRelationManager;

class ChurchResource extends Resource
{
    protected static ?string $model = Church::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';
    protected static ?string $navigationGroup = 'Church Management';
    protected static ?int $navigationSort = 2;

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
                            ->afterStateUpdated(fn (callable $set) => $set('zone_id', null))
                            ->afterStateUpdated(fn (callable $set) => $set('group_church_id', null))
                            ->afterStateUpdated(fn (callable $set) => $set('church_id', null)),

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
                                // ->afterStateUpdated(fn (callable $set) => $set('group_church_id', null)),
                                
                                Select::make('group_church_id')
                                    ->label("Group Church's name")
                                    ->required()
                                    ->options(function(callable $get){
                                        $zone = Zone::find($get('zone_id'));
                                            if(!$zone){
                                                return GroupChurch::all()->pluck('name', 'id');
                                            }
                                        return $zone->group_churches->pluck('name', 'id');
                                    })
                                    ->reactive(),
                                    // ->afterStateUpdated(fn (callable $set) => $set('group_church_id', null)),

                                    

                        // Select::make('country_id')
                        // ->relationship('country', 'name')->required(),

                        // Select::make('zone_id')
                        // ->label("Zone's name")
                        // ->relationship('zone', 'name')->required(),

                        // Select::make('group_church_id')
                        // ->label("Group Church's name")
                        // ->relationship('group_church', 'name')->required(),
                    
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
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('pastor')->sortable()->searchable(),
                TextColumn::make('group_church.name')->sortable()->searchable(),
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
            FellowshipsRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ChurchStatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChurches::route('/'),
            // 'create' => Pages\CreateChurch::route('/create'),
            // 'edit' => Pages\EditChurch::route('/{record}/edit'),
        ];
    }    
}

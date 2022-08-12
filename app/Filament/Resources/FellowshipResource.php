<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Zone;
use Filament\Tables;
use App\Models\Church;
use App\Models\Country;
use App\Models\Fellowship;
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
use App\Filament\Resources\FellowshipResource\Pages;
use App\Filament\Resources\FellowshipResource\RelationManagers;
use App\Filament\Resources\FellowshipResource\RelationManagers\SoulsRelationManager;
use App\Filament\Resources\FellowshipResource\RelationManagers\SoulWinnersRelationManager;
use App\Filament\Resources\FellowshipResource\Widgets\FellowshipStatsOverview;

class FellowshipResource extends Resource
{
    protected static ?string $model = Fellowship::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Church Management';
    protected static ?int $navigationSort = 3;

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

                                    Select::make('church_id')
                                    ->label("Church's name")
                                    ->required()
                                    ->options(function(callable $get){
                                        $group_church = GroupChurch::find($get('group_church_id'));
                                            if(!$group_church){
                                                return Church::all()->pluck('name', 'id');
                                            }
                                        return $group_church->churches->pluck('name', 'id');
                                    })
                                    ->reactive(),

                        // Select::make('country_id')
                        // ->relationship('country', 'name')->required(),

                        // Select::make('zone_id')
                        // ->label("Zone's name")
                        // ->relationship('zone', 'name')->required(),

                        // Select::make('group_church_id')
                        // ->label("Group Church's name")
                        // ->relationship('group_church', 'name')->required(),

                        // Select::make('church_id')
                        // ->label("Church's name")
                        // ->relationship('church', 'name')->required(),

                        TextInput::make('leader')
                        ->label("Fellowship leader's name")
                        ->required()->maxLength(255),
                    
                        TextInput::make('name')
                        ->label('Fellowship name')
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
                TextColumn::make('leader')->sortable()->searchable(),
                TextColumn::make('church.name')->sortable()->searchable(),
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
            SoulWinnersRelationManager::class,
            SoulsRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FellowshipStatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFellowships::route('/'),
            // 'create' => Pages\CreateFellowship::route('/create'),
            // 'edit' => Pages\EditFellowship::route('/{record}/edit'),
        ];
    }    
}

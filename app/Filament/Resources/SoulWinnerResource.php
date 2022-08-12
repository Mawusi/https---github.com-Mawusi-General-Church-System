<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Zone;
use Filament\Tables;
use App\Models\Church;
use App\Models\Country;
use App\Models\Fellowship;
use App\Models\SoulWinner;
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
use App\Filament\Resources\SoulWinnerResource\Pages;
use App\Filament\Resources\SoulWinnerResource\RelationManagers;
use App\Filament\Resources\SoulWinnerResource\RelationManagers\SoulsRelationManager;
use App\Filament\Resources\SoulWinnerResource\Widgets\SoulWinnerStatsOverview;

class SoulWinnerResource extends Resource
{
    protected static ?string $model = SoulWinner::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Information Upload';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('contact')->required()->maxLength(255),
                        TextInput::make('email')->email()->maxLength(255),


                        // Dependent fields for country->states->cities
                        Select::make('country_id')
                            ->label('Country')
                            ->options(Country::all()->pluck('name', 'id')->toArray())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('zone_id', null))
                            ->afterStateUpdated(fn (callable $set) => $set('group_church_id', null))
                            ->afterStateUpdated(fn (callable $set) => $set('church_id', null))
                            ->afterStateUpdated(fn (callable $set) => $set('fellowship_id', null)),

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

                                        Select::make('fellowship_id')
                                        ->label("Fellowhip name")
                                        ->required()
                                        ->options(function(callable $get){
                                            $church = Church::find($get('church_id'));
                                                if(!$church){
                                                    return Fellowship::all()->pluck('name', 'id');
                                                }
                                            return $church->fellowships->pluck('name', 'id');
                                        })
                                        ->reactive(),

                        // Select::make('country_id')
                        // ->relationship('country', 'name')->required(),

                        // Select::make('zone_id')
                        // ->relationship('zone', 'name')->required(),

                        // Select::make('group_church_id')
                        // ->relationship('group_church', 'name')->required(),
                        
                        // Select::make('church_id')
                        // ->relationship('church', 'name')->required(),

                        // Select::make('fellowship_id')
                        // ->relationship('fellowship', 'name')->required(),




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
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('church.name')->sortable()->searchable(),
                TextColumn::make('fellowship.name')->sortable()->searchable(),
                TextColumn::make('designation.name')
                ->label('Designation')
                ->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            SoulsRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            SoulWinnerStatsOverview::class
        ];
    }
    
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSoulWinners::route('/'),
            // 'create' => Pages\CreateSoulWinner::route('/create'),
            'view' => Pages\ViewSoulWinner::route('/{record}'),
            // 'edit' => Pages\EditSoulWinner::route('/{record}/edit'),
        ];
    }    
}

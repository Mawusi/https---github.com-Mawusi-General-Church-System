<?php

namespace App\Filament\Resources\SoulResource\Widgets;

use App\Models\Soul;
use App\Models\Country;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SoulsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $gh = Country::where('name', 'Ghana')->withCount('souls')->first();
        $usa = Country::where('name', 'United States of America')->withCount('souls')->first();
        $fiji = Country::where('name', 'Fiji')->withCount('souls')->first();

        return [
            Card::make('Total Souls', Soul::all()->count()),
            Card::make('Souls Ghana', $gh ? $gh->souls_count : 0),
            Card::make('Souls USA', $usa ? $usa->souls_count : 0),
            Card::make('Souls Fiji', $fiji ? $fiji->souls_count : 0),
            
        ];
    }
}

<?php

namespace App\Filament\Resources\SoulWinnerResource\Widgets;

use App\Models\Country;
use App\Models\SoulWinner;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SoulWinnerStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $gh = Country::where('name', 'Ghana')->withCount('soul_winners')->first();
        $usa = Country::where('name', 'United States of America')->withCount('soul_winners')->first();
        $fiji = Country::where('name', 'Fiji')->withCount('soul_winners')->first();

        return [
            Card::make('Total Soul Winners', SoulWinner::all()->count()),
            Card::make('Souls Winners Ghana', $gh ? $gh->soul_winners_count : 0),
            Card::make('Souls Winners USA', $usa ? $usa->soul_winners_count : 0),
            Card::make('Souls Winners Fiji', $fiji ? $fiji->soul_winners_count : 0),
        ];
    }
}

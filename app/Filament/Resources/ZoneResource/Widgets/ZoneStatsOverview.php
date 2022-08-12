<?php

namespace App\Filament\Resources\ZoneResource\Widgets;

use App\Models\Zone;
use App\Models\Country;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ZoneStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $gh = Country::where('name', 'Ghana')->withCount('zones')->first();
        $usa = Country::where('name', 'United States of America')->withCount('zones')->first();
        $chi = Country::where('name', 'China')->withCount('zones')->first();
        $jpn = Country::where('name', 'Japan')->withCount('zones')->first();
        $sk = Country::where('name', 'South Korea')->withCount('zones')->first();
        $fiji = Country::where('name', 'Fiji')->withCount('zones')->first();


        return [
            Card::make('All Zones', Zone::all()->count()),
            Card::make('Ghana', $gh ? $gh->zones_count : 0),
            Card::make('United States of America', $usa ? $usa->zones_count : 0),
            Card::make('China', $chi ? $chi->zones_count : 0),
            Card::make('Japan', $jpn ? $jpn->zones_count : 0),
            Card::make('South Korea', $sk ? $sk->zones_count : 0),
            Card::make('Fiji', $fiji ? $fiji->zones_count : 0),

        ];
    }
}

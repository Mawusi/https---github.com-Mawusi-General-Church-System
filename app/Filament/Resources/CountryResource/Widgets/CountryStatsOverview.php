<?php

namespace App\Filament\Resources\CountryResource\Widgets;

use App\Models\Country;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CountryStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Countries', Country::all()->count())
        ];
    }
}

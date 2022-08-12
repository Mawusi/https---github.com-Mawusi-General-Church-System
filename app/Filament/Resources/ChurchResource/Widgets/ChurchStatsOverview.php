<?php

namespace App\Filament\Resources\ChurchResource\Widgets;

use App\Models\Church;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ChurchStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Churches', Church::all()->count()),
        ];
    }
}

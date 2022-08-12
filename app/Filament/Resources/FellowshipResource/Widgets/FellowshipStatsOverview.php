<?php

namespace App\Filament\Resources\FellowshipResource\Widgets;

use App\Models\Fellowship;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class FellowshipStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Fellowships', Fellowship::all()->count()),
        ];
    }
}

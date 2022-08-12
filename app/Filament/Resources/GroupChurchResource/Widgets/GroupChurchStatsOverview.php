<?php

namespace App\Filament\Resources\GroupChurchResource\Widgets;

use App\Models\GroupChurch;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class GroupChurchStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Group Churches', GroupChurch::all()->count()),
        ];
    }
}

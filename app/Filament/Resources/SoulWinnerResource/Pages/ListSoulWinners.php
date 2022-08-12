<?php

namespace App\Filament\Resources\SoulWinnerResource\Pages;

use App\Filament\Resources\SoulWinnerResource;
use App\Filament\Resources\SoulWinnerResource\Widgets\SoulWinnerStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoulWinners extends ListRecords
{
    protected static string $resource = SoulWinnerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SoulWinnerStatsOverview::class
        ];
    }
}

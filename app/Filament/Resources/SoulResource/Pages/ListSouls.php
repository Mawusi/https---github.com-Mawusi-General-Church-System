<?php

namespace App\Filament\Resources\SoulResource\Pages;

use App\Filament\Resources\SoulResource;
use App\Filament\Resources\SoulResource\Widgets\SoulsStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSouls extends ListRecords
{
    protected static string $resource = SoulResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SoulsStatsOverview::class
        ];
    }
}

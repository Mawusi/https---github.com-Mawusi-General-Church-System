<?php

namespace App\Filament\Resources\ChurchResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ChurchResource;
use App\Filament\Resources\ChurchResource\Widgets\ChurchStatsOverview;

class ListChurches extends ListRecords
{
    protected static string $resource = ChurchResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ChurchStatsOverview::class
        ];
    }
}

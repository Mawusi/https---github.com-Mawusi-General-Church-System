<?php

namespace App\Filament\Resources\FellowshipResource\Pages;

use App\Filament\Resources\FellowshipResource;
use App\Filament\Resources\FellowshipResource\Widgets\FellowshipStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFellowships extends ListRecords
{
    protected static string $resource = FellowshipResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            FellowshipStatsOverview::class
        ];
    }
}

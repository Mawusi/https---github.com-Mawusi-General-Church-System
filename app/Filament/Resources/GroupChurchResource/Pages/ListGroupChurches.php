<?php

namespace App\Filament\Resources\GroupChurchResource\Pages;

use App\Filament\Resources\GroupChurchResource;
use App\Filament\Resources\GroupChurchResource\Widgets\GroupChurchStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroupChurches extends ListRecords
{
    protected static string $resource = GroupChurchResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GroupChurchStatsOverview::class
        ];
    }
}

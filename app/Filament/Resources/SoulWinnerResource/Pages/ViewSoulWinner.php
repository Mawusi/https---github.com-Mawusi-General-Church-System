<?php

namespace App\Filament\Resources\SoulWinnerResource\Pages;

use App\Filament\Resources\SoulWinnerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSoulWinner extends ViewRecord
{
    protected static string $resource = SoulWinnerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

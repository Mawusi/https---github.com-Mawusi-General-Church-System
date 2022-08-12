<?php

namespace App\Filament\Resources\SoulWinnerResource\Pages;

use App\Filament\Resources\SoulWinnerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSoulWinner extends CreateRecord
{
    protected static string $resource = SoulWinnerResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\SoulWinnerResource\Pages;

use App\Filament\Resources\SoulWinnerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoulWinner extends EditRecord
{
    protected static string $resource = SoulWinnerResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

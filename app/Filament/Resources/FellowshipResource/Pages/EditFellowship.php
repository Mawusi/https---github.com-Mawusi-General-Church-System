<?php

namespace App\Filament\Resources\FellowshipResource\Pages;

use App\Filament\Resources\FellowshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFellowship extends EditRecord
{
    protected static string $resource = FellowshipResource::class;

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

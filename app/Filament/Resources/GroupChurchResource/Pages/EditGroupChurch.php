<?php

namespace App\Filament\Resources\GroupChurchResource\Pages;

use App\Filament\Resources\GroupChurchResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroupChurch extends EditRecord
{
    protected static string $resource = GroupChurchResource::class;

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

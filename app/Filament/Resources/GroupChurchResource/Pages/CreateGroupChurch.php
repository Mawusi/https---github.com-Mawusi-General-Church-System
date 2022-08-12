<?php

namespace App\Filament\Resources\GroupChurchResource\Pages;

use App\Filament\Resources\GroupChurchResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGroupChurch extends CreateRecord
{
    protected static string $resource = GroupChurchResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}

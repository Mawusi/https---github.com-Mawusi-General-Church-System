<?php

namespace App\Filament\Resources\ChurchResource\Pages;

use App\Filament\Resources\ChurchResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChurch extends CreateRecord
{
    protected static string $resource = ChurchResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}

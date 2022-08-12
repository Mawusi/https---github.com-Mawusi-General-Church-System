<?php

namespace App\Filament\Resources\SoulResource\Pages;

use App\Filament\Resources\SoulResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSoul extends CreateRecord
{
    protected static string $resource = SoulResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}

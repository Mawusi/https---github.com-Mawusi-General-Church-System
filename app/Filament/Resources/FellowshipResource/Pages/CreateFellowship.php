<?php

namespace App\Filament\Resources\FellowshipResource\Pages;

use App\Filament\Resources\FellowshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFellowship extends CreateRecord
{
    protected static string $resource = FellowshipResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}
